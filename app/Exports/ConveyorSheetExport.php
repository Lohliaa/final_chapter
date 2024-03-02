<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Exports\ReportCVExport;
use App\Utilities\ExportUtilities;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ConveyorSheetExport implements FromCollection, WithHeadings, ShouldAutoSize

{
    protected $conveyorData;
    protected $conveyorType;

    public function __construct($conveyorData)
    {
        $this->conveyorData = $conveyorData;
    }

    protected function convertMaterialToPartNo($material)
    {
        return ExportUtilities::convertMaterialToPartNo($material);
    }
    public function collection()
    {
        $rows = [];
        $user = Auth::id();

        foreach ($this->conveyorData as $conveyor) {
            $cl_sum_proses = DB::table('proses')
                ->where('conveyor', $conveyor->conveyor)
                ->where('kind_size_color', $conveyor->kind_size_color)
                ->where('cust_part_no', $conveyor->cust_part_no)
                ->where('user_id', $user)
                ->sum(DB::raw('(cl * total_qty) / 1000'));

            $cl_sum_proses_fa1a = DB::table('proses_fa_1a')
                ->where('conveyor', $conveyor->conveyor)
                ->where('kind_size_color', $conveyor->kind_size_color)
                ->where('cust_part_no', $conveyor->cust_part_no)
                ->where('user_id', $user)
                ->sum(DB::raw('(cl * total_qty) / 1000'));

            $cl_sum_combined = $cl_sum_proses + $cl_sum_proses_fa1a;

            $rows[] = [
                'Conveyor' => $conveyor->conveyor,
                'Material' => $conveyor->kind_size_color,
                'Buppin' => $conveyor->cust_part_no,
                'QTY' => $cl_sum_combined,
            ];
        }

        $groups = [
            'term_b', 'accb1', 'accb2', 'tubeb',
            'term_a', 'acca1', 'acca2', 'tubea',
        ];

        $results = [];

        foreach ($groups as $group) {
            $data_fa = DB::table('proses')
                ->where('conveyor', $conveyor->conveyor)
                ->select($group)
                ->groupBy($group)
                ->where('user_id', $user)
                ->get();

            $data_pa = DB::table('proses_fa_1a')
                ->where('conveyor', $conveyor->conveyor)
                ->select($group)
                ->groupBy($group)
                ->where('user_id', $user)
                ->get();
            $data = $data_fa->merge($data_pa);
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
                        ->where('conveyor', $conveyor->conveyor)
                        ->where($group, $key)
                        ->sum('total_qty');

                    $qtySumProsesFa1a = DB::table('proses_fa_1a')
                        ->where('user_id', $user)
                        ->where('conveyor', $conveyor->conveyor)
                        ->where($group, $key)
                        ->sum('total_qty');

                    $qtySumCombined = $qtySumProses + $qtySumProsesFa1a;

                    if (!isset($results[$key])) {
                        $results[$key] = [
                            'conveyor' => $conveyor->conveyor,
                            'material' => $key,
                            'buppin' => $key,
                            'qty_sum_combined' => 0,
                        ];
                    }

                    $results[$key]['qty_sum_combined'] += $qtySumCombined;
                } elseif ($containsHyphen && $containsLetter) {
                    $qtySumProses = DB::table('proses')
                        ->where('user_id', $user)
                        ->where('conveyor', $conveyor->conveyor)
                        ->where($group, $key)
                        ->sum('total_qty');

                    $qtySumProsesFa1a = DB::table('proses_fa_1a')
                        ->where('user_id', $user)
                        ->where('conveyor', $conveyor->conveyor)
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
                        $exportUtilities = new ExportUtilities();
                        $formattedPartNo = $exportUtilities->convertMaterialToPartNo($itemList->part_no);
                        $buppin = $itemList->cust_pno;

                        if ($formattedPartNo == $material) {
                            $buppin = $itemList->cust_pno;
                        }
                    }

                    if (!isset($results[$key])) {
                        $results[$key] = [
                            'conveyor' => $conveyor->conveyor,
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
            'rows' => $rows,
            'results' => $results,
        ];

        return collect($combinedResults);
    }

    public function headings(): array
    {
        return [
            'Bagian',
            'Material',
            'Item',
            'QTY',
        ];
    }
}
