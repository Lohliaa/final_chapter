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

        foreach ($this->conveyorData as $bagian) {
            $cl_sum_proses = DB::table('proses')
                ->where('bagian', $bagian->bagian)
                ->where('model_ukuran_warna', $bagian->model_ukuran_warna)
                ->where('specific_component_number', $bagian->specific_component_number)
                ->where('user_id', $user)
                ->sum(DB::raw('(cl * total_qty) / 1000'));

            $cl_sum_proses_fa1a = DB::table('proses_pa')
                ->where('bagian', $bagian->bagian)
                ->where('model_ukuran_warna', $bagian->model_ukuran_warna)
                ->where('specific_component_number', $bagian->specific_component_number)
                ->where('user_id', $user)
                ->sum(DB::raw('(cl * total_qty) / 1000'));

            $cl_sum_combined = $cl_sum_proses + $cl_sum_proses_fa1a;

            $rows[] = [
                'Bagian' => $bagian->bagian,
                'Material' => $bagian->model_ukuran_warna,
                'Item' => $bagian->specific_component_number,
                'QTY' => $cl_sum_combined,
            ];
        }

        $groups = [
            'trm_b', 'acc_bag_b1', 'acc_bag_b2', 'tbe_b',
            'trm_a', 'acc_bag_a1', 'acc_bag_a2', 'tbe_a',
        ];

        $results = [];

        foreach ($groups as $group) {
            $data_fa = DB::table('proses')
                ->where('bagian', $bagian->bagian)
                ->select($group)
                ->groupBy($group)
                ->where('user_id', $user)
                ->get();

            $data_pa = DB::table('proses_pa')
                ->where('bagian', $bagian->bagian)
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
                        ->where('bagian', $bagian->bagian)
                        ->where($group, $key)
                        ->sum('total_qty');

                    $qtySumProsesPa = DB::table('proses_pa')
                        ->where('user_id', $user)
                        ->where('bagian', $bagian->bagian)
                        ->where($group, $key)
                        ->sum('total_qty');

                    $qtySumCombined = $qtySumProses + $qtySumProsesPa;

                    if (!isset($results[$key])) {
                        $results[$key] = [
                            'bagian' => $bagian->bagian,
                            'material' => $key,
                            'item' => $key,
                            'qty_sum_combined' => 0,
                        ];
                    }

                    $results[$key]['qty_sum_combined'] += $qtySumCombined;
                } elseif ($containsHyphen && $containsLetter) {
                    $qtySumProses = DB::table('proses')
                        ->where('user_id', $user)
                        ->where('bagian', $bagian->bagian)
                        ->where($group, $key)
                        ->sum('total_qty');

                    $qtySumProsesPa = DB::table('proses_pa')
                        ->where('user_id', $user)
                        ->where('bagian', $bagian->bagian)
                        ->where($group, $key)
                        ->sum('total_qty');

                    $qtySumCombined = $qtySumProses + $qtySumProsesPa;

                    $item = DB::table('item')
                        ->where('component_number', 'LIKE', '%' . $key . '%')
                        ->where('user_id', $user)
                        ->first();

                    $material = $key;
                    $item = $key;

                    if ($item) {
                        $exportUtilities = new ExportUtilities();
                        // Check if $item is an object
                        if (is_object($item) && property_exists($item, 'component_number')) {
                            $formattedPartNo = $exportUtilities->convertMaterialToPartNo($item->component_number);
                            $item = $item->specific_component_number;
                    
                            if ($formattedPartNo == $material) {
                                $item = $item->specific_component_number;
                            }
                        }
                    }
                    

                    if (!isset($results[$key])) {
                        $results[$key] = [
                            'bagian' => $bagian->bagian,
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
