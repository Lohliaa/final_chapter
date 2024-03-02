<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use App\Models\Proses;
use App\Models\ProsesFa_1A;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReportQTYExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{

    public function collection()
    {
        $user = Auth::id();

        $prosesData = DB::table('proses')
            ->select('kind_size_color', 'cust_part_no')
            ->groupBy('kind_size_color', 'cust_part_no')
            ->where('user_id', $user)
            ->get();

        $prosesFa1aData = DB::table('proses_fa_1a')
            ->select('kind_size_color', 'cust_part_no')
            ->groupBy('kind_size_color', 'cust_part_no')
            ->where('user_id', $user)
            ->get();

        $combinedData = $prosesData->concat($prosesFa1aData)->unique();

        $result = [];

        foreach ($combinedData as $data) {
            $cl_sum_proses = DB::table('proses')
                ->selectRaw('SUM(CASE 
                WHEN kind_size_color LIKE "%=%" THEN (SUBSTRING_INDEX(kind_size_color, "=", -1) * total_qty) / 1000 
                ELSE (cl * total_qty) / 1000 
                END) as total')
                ->where('kind_size_color', $data->kind_size_color)
                ->where('cust_part_no', $data->cust_part_no)
                ->first();

            $total_fa = $cl_sum_proses->total;

            $cl_sum_proses_fa1a = DB::table('proses_fa_1a')
                ->selectRaw('SUM(CASE 
                WHEN kind_size_color LIKE "%=%" THEN (SUBSTRING_INDEX(kind_size_color, "=", -1) * total_qty) / 1000 
                ELSE (cl * total_qty) / 1000 
                END) as total')
                ->where('kind_size_color', $data->kind_size_color)
                ->where('cust_part_no', $data->cust_part_no)
                ->first();

            $total_pa = $cl_sum_proses_fa1a->total;

            $cl_sum_combined = $total_fa + $total_pa;
            $result[] = [
                'kind_size_color' => $data->kind_size_color,
                'cust_part_no' => $data->cust_part_no,
                'cl_sum' => $cl_sum_combined,
            ];
        }

        $groups = [
            'term_b', 'accb1', 'accb2', 'tubeb',
            'term_a', 'acca1', 'acca2', 'tubea',
        ];

        $results = [];
        function convertMaterialToPartNo($material)
        {
            $formattedMaterial = rtrim(sprintf('%.2f', floatval($material)), '0');
            return $formattedMaterial;
        }

        foreach ($groups as $group) {
            $data = DB::table('proses')
                ->select($group)
                ->groupBy($group)
                ->where('user_id', $user)
                ->get();

            foreach ($data as $item) {
                $key = $item->{$group};

                $numbers = explode('-', $key);

                $isNumeric = true;
                foreach ($numbers as $number) {
                    if (!is_numeric($number)) {
                        $isNumeric = false;
                        break;
                    }
                }
                $containsHyphen = strpos($key, '-') !== false;
                $containsLetter = preg_match('/[a-zA-Z]/', $key);

                if ($isNumeric) {
                    $qtySumProses = DB::table('proses')
                        ->where('user_id', $user)
                        ->where($group, $key)
                        ->sum('total_qty');

                    $qtySumProsesFa1a = DB::table('proses_fa_1a')
                        ->where('user_id', $user)
                        ->where($group, $key)
                        ->sum('total_qty');

                    $qtySumCombined = $qtySumProses + $qtySumProsesFa1a;

                    if (!isset($results[$key])) {
                        $results[$key] = [
                            'material' => $key,
                            'buppin' => $key,
                            'qty_sum_combined' => 0,
                        ];
                    }

                    $results[$key]['qty_sum_combined'] += $qtySumCombined;
                } elseif ($containsHyphen && $containsLetter) {
                    $qtySumProses = DB::table('proses')
                        ->where('user_id', $user)
                        ->where($group, $key)
                        ->sum('total_qty');

                    $qtySumProsesFa1a = DB::table('proses_fa_1a')
                        ->where('user_id', $user)
                        ->where($group, $key)
                        ->sum('total_qty');

                    $qtySumCombined = $qtySumProses + $qtySumProsesFa1a;

                    $itemList = DB::table('item_list')
                        ->where('part_no', 'LIKE', '%' . $key . '%')
                        ->where('user_id', $user)
                        ->first();

                    $material = $key;
                    $buppin = $key;

                    if ($itemList) {
                        $formattedPartNo = convertMaterialToPartNo($itemList->part_no);
                        $buppin = $itemList->cust_pno;

                        if ($formattedPartNo == $material) {
                            $buppin = $itemList->cust_pno;
                        }
                    }

                    if (!isset($results[$key])) {
                        $results[$key] = [
                            'material' => $material,
                            'buppin' => $buppin,
                            'qty_sum_combined' => 0,
                        ];
                    }

                    $results[$key]['qty_sum_combined'] += $qtySumCombined;
                }
            }
        }
        $combinedResults = [
            'result' => $result,
            'results' => $results,
        ];

        return collect($combinedResults);
    }

    public function headings(): array
    {
        return [
            'Material',
            'Item',
            'QTY',
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
