<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Exports\ReportCVExport;
use App\Utilities\ExportUtilities;

class ConveyorSheetExport implements FromCollection, WithHeadings
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

        foreach ($this->conveyorData as $conveyor) {
            $cl_sum_proses = DB::table('proses')
                ->where('conveyor', $conveyor->conveyor)
                ->where('kind_size_color', $conveyor->kind_size_color)
                ->where('cust_part_no', $conveyor->cust_part_no)
                ->sum(DB::raw('(cl * total_qty) / 1000'));

            $cl_sum_proses_fa1a = DB::table('proses_fa_1a')
                ->where('conveyor', $conveyor->conveyor)
                ->where('kind_size_color', $conveyor->kind_size_color)
                ->where('cust_part_no', $conveyor->cust_part_no)
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

        $combinedResults = [];

        foreach ($this->conveyorData as $conveyor) {
            $combinedResults[$conveyor->conveyor] = [];
            foreach ($groups as $group) {
                $prosesData = DB::table('proses')
                    ->where('conveyor', $conveyor->conveyor)
                    ->select($groups)  
                    ->groupBy($groups) 
                    ->get();

                $prosesFa1aData = DB::table('proses_fa_1a')
                    ->where('conveyor', $conveyor->conveyor)
                    ->select($groups)  
                    ->groupBy($groups) 
                    ->get();

                $combinedData = $prosesData->concat($prosesFa1aData);
                $uniqueResultsByConveyor = [];

                foreach ($combinedData as $item) {
                    foreach ($groups as $columnName) {
                        $key = $item->{$columnName};
                
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
                
                        if (($isNumeric && $containsHyphen) || ($containsHyphen && $containsLetter)) {
                            $qtySumProses = DB::table('proses')
                                ->where('conveyor', $conveyor->conveyor)
                                ->where($columnName, $key)
                                ->sum('total_qty');
                
                            $qtySumProsesFa1a = DB::table('proses_fa_1a')
                                ->where('conveyor', $conveyor->conveyor)
                                ->where($columnName, $key)
                                ->sum('total_qty');
                
                            $qtySumCombined = $qtySumProses + $qtySumProsesFa1a;
                
                            $itemList = DB::table('item_list')
                                ->where('part_no', 'LIKE', '%' . $key . '%')
                                ->first();
                
                            $material = $key;
                            $buppin = $key;
                
                            if ($itemList) {
                                $formattedPartNo = $this->convertMaterialToPartNo($itemList->part_no);
                                $buppin = $itemList->cust_pno;
                                if ($formattedPartNo == $material) {
                                    $buppin = $itemList->cust_pno;
                                }
                            }
                
                            $combinedKey = $material . '-' . $buppin;
                
                            if (!isset($uniqueResultsByConveyor[$conveyor->conveyor][$combinedKey])) {
                                $uniqueResultsByConveyor[$conveyor->conveyor][$combinedKey] = [
                                    'conveyor' => $conveyor->conveyor,
                                    'material' => $material,
                                    'buppin' => $buppin,
                                    'qty_sum_combined' => $qtySumCombined,
                                ];
                                $finalResults[] = $uniqueResultsByConveyor[$conveyor->conveyor][$combinedKey];
                            } else {
                                $uniqueResultsByConveyor[$conveyor->conveyor][$combinedKey]['qty_sum_combined'] += $qtySumCombined;
                            }
                        }
                    }
                }

                $rowsAndCombined = array_merge($rows, $finalResults);

                return collect($rowsAndCombined);
            }
        }
    }

    public function headings(): array
    {
        return [
            'Conveyor',
            'Material',
            'Buppin',
            'QTY',
        ];
    }
}
