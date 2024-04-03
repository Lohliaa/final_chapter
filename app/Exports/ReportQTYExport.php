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
            ->select('model_ukuran_warna', 'specific_component_number')
            ->groupBy('model_ukuran_warna', 'specific_component_number')
            ->where('user_id', $user)
            ->get();

        $prosesPaData = DB::table('proses_pa')
            ->select('model_ukuran_warna', 'specific_component_number')
            ->groupBy('model_ukuran_warna', 'specific_component_number')
            ->where('user_id', $user)
            ->get();

        $combinedData = $prosesData->concat($prosesPaData)->unique();

        $result = [];

        foreach ($combinedData as $data) {
            $cl_sum_proses = DB::table('proses')
                ->selectRaw('SUM(CASE 
                WHEN model_ukuran_warna LIKE "%=%" THEN (SUBSTRING_INDEX(model_ukuran_warna, "=", -1) * total_qty) / 1000 
                ELSE (cl * total_qty) / 1000 
                END) as total')
                ->where('model_ukuran_warna', $data->model_ukuran_warna)
                ->where('specific_component_number', $data->specific_component_number)
                ->first();

            $total_fa = $cl_sum_proses->total;

            $cl_sum_proses_pa = DB::table('proses_pa')
                ->selectRaw('SUM(CASE 
                WHEN model_ukuran_warna LIKE "%=%" THEN (SUBSTRING_INDEX(model_ukuran_warna, "=", -1) * total_qty) / 1000 
                ELSE (cl * total_qty) / 1000 
                END) as total')
                ->where('model_ukuran_warna', $data->model_ukuran_warna)
                ->where('specific_component_number', $data->specific_component_number)
                ->first();

            $total_pa = $cl_sum_proses_pa->total;

            $cl_sum_combined = $total_fa + $total_pa;
            $result[] = [
                'model_ukuran_warna' => $data->model_ukuran_warna,
                'specific_component_number' => $data->specific_component_number,
                'cl_sum' => $cl_sum_combined,
            ];
        }

        $groups = [
            'trm_b', 'acc_bag_b1', 'acc_bag_b2', 'tbe_b',
            'trm_a', 'acc_bag_a1', 'acc_bag_a2', 'tbe_a',
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

                    $qtySumProsesPa = DB::table('proses_pa')
                        ->where('user_id', $user)
                        ->where($group, $key)
                        ->sum('total_qty');

                    $qtySumCombined = $qtySumProses + $qtySumProsesPa;

                    if (!isset($results[$key])) {
                        $results[$key] = [
                            'material' => $key,
                            'item' => $key,
                            'qty_sum_combined' => 0,
                        ];
                    }

                    $results[$key]['qty_sum_combined'] += $qtySumCombined;
                } elseif ($containsHyphen && $containsLetter) {
                    $qtySumProses = DB::table('proses')
                        ->where('user_id', $user)
                        ->where($group, $key)
                        ->sum('total_qty');

                    $qtySumProsesPa = DB::table('proses_pa')
                        ->where('user_id', $user)
                        ->where($group, $key)
                        ->sum('total_qty');

                    $qtySumCombined = $qtySumProses + $qtySumProsesPa;

                    $itemList = DB::table('item')
                        ->where('component_number', 'LIKE', '%' . $key . '%')
                        ->where('user_id', $user)
                        ->first();

                    $material = $key;
                    $item = $key;

                    if ($itemList) {
                        $formattedPartNo = convertMaterialToPartNo($itemList->component_number);
                        $item = $itemList->specific_component_number;

                        if ($formattedPartNo == $material) {
                            $item = $itemList->specific_component_number;
                        }
                    }

                    if (!isset($results[$key])) {
                        $results[$key] = [
                            'material' => $material,
                            'item' => $item,
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
