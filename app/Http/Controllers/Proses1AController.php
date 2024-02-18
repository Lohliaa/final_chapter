<?php

namespace App\Http\Controllers;

use App\Exports\ProsesPAExport;
use App\Exports\SelectedDataExport;
use App\Models\Fa_1A;
use App\Models\Next_Proses;
use App\Models\Konsep_Commonize;
use App\Models\Item_List;
use App\Models\ProsesFa_1A;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

class Proses1AController extends Controller
{
    public function pilih_proses_pa(Request $request)
    {
        $keyword = $request->pilih_proses_pa;
        $user = Auth::id();

        $proses_fa_1a = ProsesFa_1A::where('user_id', $user)
            ->where(function ($query) use ($keyword) {
                $query->where('ctrl_no', 'like', "%" . $keyword . "%")
                    ->orWhere('kind', 'like', "%" . $keyword . "%")
                    ->orWhere('size', 'like', "%" . $keyword . "%")
                    ->orWhere('color', 'like', "%" . $keyword . "%")
                    ->orWhere('month', 'like', "%" . $keyword . "%")
                    ->orWhere('car_line', 'like', "%" . $keyword . "%")
                    ->orWhere('conveyor', 'like', "%" . $keyword . "%")
                    ->orWhere('addressing_store', 'like', "%" . $keyword . "%")
                    ->orWhere('ctrlno', 'like', "%" . $keyword . "%")
                    ->orWhere('kind_size_color', 'like', "%" . $keyword . "%")
                    ->orWhere('cust_part_no', 'like', "%" . $keyword . "%")
                    ->orWhere('cl', 'like', "%" . $keyword . "%")
                    ->orWhere('term_b', 'like', "%" . $keyword . "%")
                    ->orWhere('accb1', 'like', "%" . $keyword . "%")
                    ->orWhere('accb2', 'like', "%" . $keyword . "%")
                    ->orWhere('tubeb', 'like', "%" . $keyword . "%")
                    ->orWhere('term_a', 'like', "%" . $keyword . "%")
                    ->orWhere('acca1', 'like', "%" . $keyword . "%")
                    ->orWhere('acca2', 'like', "%" . $keyword . "%")
                    ->orWhere('tubea', 'like', "%" . $keyword . "%")
                    ->orWhere('total_qty', 'like', "%" . $keyword . "%")
                    ->orWhere('wire_cost', 'like', "%" . $keyword . "%")
                    ->orWhere('component_cost', 'like', "%" . $keyword . "%")
                    ->orWhere('material_cost', 'like', "%" . $keyword . "%")
                    ->orWhere('process', 'like', "%" . $keyword . "%")
                    ->orWhere('umh', 'like', "%" . $keyword . "%")
                    ->orWhere('charge', 'like', "%" . $keyword . "%")
                    ->orWhere('process_cost', 'like', "%" . $keyword . "%")
                    ->orWhere('process_cost_amount', 'like', "%" . $keyword . "%")
                    ->orWhere('total_amount', 'like', "%" . $keyword . "%")
                    ->orWhere('price_sum', 'like', "%" . $keyword . "%");
            })
            ->get();
        $columnsToSearch = [
            'month', 'car_line', 'conveyor', 'addressing_store', 'ctrl_no', 'ctrlno', 'kind', 'size', 'color',
            'kind_size_color', 'cust_part_no', 'cl', 'term_b', 'accb1', 'accb2', 'tubeb', 'term_a', 'acca1', 'acca2', 'tubea', 'total_qty',
            'price_sum', 'wire_cost', 'component_cost', 'material_cost', 'process', 'umh', 'charge', 'process_cost', 'process_cost_amount', 'total_amount'
        ];

        $count = $proses_fa_1a->filter(function ($item) use ($keyword, $columnsToSearch) {
            foreach ($columnsToSearch as $column) {
                if (stripos($item->{$column}, $keyword) !== false) {
                    return true;
                }
            }
            return false;
        })->count();

        return view('proses_fa_1a.index', compact('count', 'proses_fa_1a'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        set_time_limit(0);
        $keyword = $request->pilih_proses_pa;
        $user = Auth::id();
        $proses_fa_1a = ProsesFa_1A::where('user_id', $user)
            ->where(function ($query) use ($keyword) {
                $query->where('ctrl_no', 'like', "%" . $keyword . "%")
                    ->orWhere('kind', 'like', "%" . $keyword . "%")
                    ->orWhere('size', 'like', "%" . $keyword . "%")
                    ->orWhere('color', 'like', "%" . $keyword . "%")
                    ->orWhere('month', 'like', "%" . $keyword . "%")
                    ->orWhere('car_line', 'like', "%" . $keyword . "%")
                    ->orWhere('conveyor', 'like', "%" . $keyword . "%")
                    ->orWhere('addressing_store', 'like', "%" . $keyword . "%")
                    ->orWhere('ctrlno', 'like', "%" . $keyword . "%")
                    ->orWhere('kind_size_color', 'like', "%" . $keyword . "%")
                    ->orWhere('cust_part_no', 'like', "%" . $keyword . "%")
                    ->orWhere('term_b', 'like', "%" . $keyword . "%")
                    ->orWhere('accb1', 'like', "%" . $keyword . "%")
                    ->orWhere('accb2', 'like', "%" . $keyword . "%")
                    ->orWhere('tubeb', 'like', "%" . $keyword . "%")
                    ->orWhere('term_a', 'like', "%" . $keyword . "%")
                    ->orWhere('acca1', 'like', "%" . $keyword . "%")
                    ->orWhere('acca2', 'like', "%" . $keyword . "%")
                    ->orWhere('tubea', 'like', "%" . $keyword . "%")
                    ->orWhere('total_qty', 'like', "%" . $keyword . "%")
                    ->orWhere('wire_cost', 'like', "%" . $keyword . "%")
                    ->orWhere('component_cost', 'like', "%" . $keyword . "%")
                    ->orWhere('material_cost', 'like', "%" . $keyword . "%")
                    ->orWhere('process', 'like', "%" . $keyword . "%")
                    ->orWhere('umh', 'like', "%" . $keyword . "%")
                    ->orWhere('charge', 'like', "%" . $keyword . "%")
                    ->orWhere('process_cost', 'like', "%" . $keyword . "%")
                    ->orWhere('process_cost_amount', 'like', "%" . $keyword . "%")
                    ->orWhere('total_amount', 'like', "%" . $keyword . "%")
                    ->orWhere('price_sum', 'like', "%" . $keyword . "%");
            })
            ->get();
        $dataFa1a = DB::table('fa_1a')->select('month', 'car_line', 'conveyor', 'addressing_store', 'ctrl_no', 'total_qty', 'car_line')
            ->where('user_id', $user)
            ->get();
        ProsesFa_1A::where('user_id', $user)->delete();
        $count = $proses_fa_1a->count();
        $data = $proses_fa_1a->all();
        $dataToInsert = [];

        foreach ($dataFa1a as $data) {
            $konsep_commonizes = DB::table('konsep_commonize')->where('ctrl_no', $data->ctrl_no)->where('user_id', $user)->get();
            $next_proseses = DB::table('next_proses')->where('jenis_ctrl_no', $data->ctrl_no)->where('user_id', $user)->get();

            $ctrl_no_exists = false;

            foreach ($konsep_commonizes as $konsep_commonize) {
                if (is_numeric($konsep_commonize->size_new)) {
                    // Jika size_new adalah numerik, cek jika itu bulat atau pecahan
                    $is_integer = ($konsep_commonize->size_new == intval($konsep_commonize->size_new));
                    if ($is_integer) {
                        $size_decimal = number_format($konsep_commonize->size_new, 1);
                    } else {
                        $size_formatted = sprintf("%.2f", $konsep_commonize->size_new);
                        $size_decimal = rtrim(rtrim($size_formatted, '0'), '.');
                    }
                } else {
                    // Jika size_new adalah teks, gunakan nilai teks tanpa perubahan
                    $size_decimal = $konsep_commonize->size_new;
                }

                $itemList = DB::table('item_list')
                    ->where('part_no', $konsep_commonize->kind_new . ' ' . $size_decimal . ' ' . $konsep_commonize->col_new,)
                    ->where('user_id', $user)
                    ->first();
                $prosesData = [
                    'month' => $data->month,
                    'car_line' => $data->car_line,
                    'conveyor' => $data->conveyor,
                    'addressing_store' => $data->addressing_store,
                    'ctrl_no' => $data->ctrl_no,
                    'total_qty' => $data->total_qty,
                    'ctrlno' => $konsep_commonize->ctrl_no,
                    'kind' => $konsep_commonize->kind_new,
                    'size' => $size_decimal,
                    'color' => $konsep_commonize->col_new,
                    'kind_size_color' => $konsep_commonize->kind_new . ' ' . $size_decimal . ' ' . $konsep_commonize->col_new,
                    'cust_part_no' => $itemList ? $itemList->cust_pno : '',
                    'cl' => $konsep_commonize->cl_28,
                    'term_b' => $konsep_commonize->term_b_new,
                    'accb1' => $konsep_commonize->acc_b1_new,
                    'accb2' => $konsep_commonize->acc_b2,
                    'tubeb' => $konsep_commonize->tube_b_new,
                    'term_a' => $konsep_commonize->term_a_new,
                    'acca1' => $konsep_commonize->acc_a1_new,
                    'acca2' => $konsep_commonize->acc_a2,
                    'tubea' => $konsep_commonize->tube_a_new,
                ];
                $dataToInsert[] = $prosesData;
                $ctrl_no_exists = true;
            }

            foreach ($next_proseses as $next_proses) {
                $prosesData2 = [
                    'month' => $data->month,
                    'car_line' => $data->car_line,
                    'conveyor' => $data->conveyor,
                    'addressing_store' => $data->addressing_store,
                    'ctrl_no' => $data->ctrl_no,
                    'total_qty' => $data->total_qty,
                    'ctrlno' => $next_proses->ctrl_no_cct,
                    'kind' => $next_proses->kind,
                    'size' => $next_proses->size,
                    'color' => $next_proses->color,
                    'kind_size_color' => $next_proses->kind . ' ' . $next_proses->size . ' ' . $next_proses->color,
                    'cust_part_no' => $next_proses->cust_part_no,
                    'cl' => $next_proses->cl,
                    'term_b' => $next_proses->term_b,
                    'accb1' => $next_proses->accb1,
                    'accb2' => $next_proses->accb2,
                    'tubeb' => $next_proses->tubeb,
                    'term_a' => $next_proses->term_a,
                    'acca1' => $next_proses->acca1,
                    'acca2' => $next_proses->acca2,
                    'tubea' => $next_proses->tubea,
                ];
                $dataToInsert[] = $prosesData2;
                $ctrl_no_exists = true;
            }
            if (!$ctrl_no_exists) {
                $prosesDataFa1a = [
                    'month' => $data->month,
                    'car_line' => $data->car_line,
                    'conveyor' => $data->conveyor,
                    'addressing_store' => $data->addressing_store,
                    'ctrl_no' => $data->ctrl_no,
                    'total_qty' => $data->total_qty,
                    'keterangan' => '#N/A',
                ];
                $dataToInsert[] = $prosesDataFa1a;
            }
        }
        ProsesFa_1A::where('user_id', $user)->truncate();

        foreach ($dataToInsert as $data) {
            $data['user_id'] = $user;
            ProsesFa_1A::insert($data);
        }

        $proses_fa_1a = ProsesFa_1A::where('user_id', $user)->get();

        foreach ($proses_fa_1a as $item) {
            $kind_size_color = intval($item->kind_size_color);
            $cust_part_no = intval($item->cust_part_no);
            $cl = intval($item->cl);
            $term_b = intval($item->term_b);
            $accb1 = intval($item->accb1);
            $accb2 = intval($item->accb2);
            $tubeb = intval($item->tubeb);
            $term_a = intval($item->term_a);
            $acca1 = intval($item->acca1);
            $acca2 = intval($item->acca2);
            $tubea = intval($item->tubea);
            $total_qty = intval($item->total_qty);
            $processValue = $item->process;
            $charge = $item->charge;
            $umh = $item->umh;
            $ctrlno_value = $item->ctrl_no;

            $item->term_b = $item->term_b === '-' ? null : $item->term_b;
            $item->accb1 = $item->accb1 === '-' ? null : $item->accb1;
            $item->accb2 = $item->accb2 === '-' ? null : $item->accb2;
            $item->tubeb = $item->tubeb === '-' ? null : $item->tubeb;
            $item->term_a = $item->term_a === '-' ? null : $item->term_a;
            $item->acca1 = $item->acca1 === '-' ? null : $item->acca1;
            $item->acca2 = $item->acca2 === '-' ? null : $item->acca2;
            $item->tubea = $item->tubea === '-' ? null : $item->tubea;

            // Mencari nilai 1 atau 0 berdasarkan kondisi pada kolom-kolom yang disebutkan
            $term_b_value = $item->term_b !== null ? 1 : 0;
            $accb1_value = $item->accb1 !== null ? 1 : 0;
            $term_a_value = $item->term_a !== null ? 1 : 0;
            $acca1_value = $item->acca1 !== null ? 1 : 0;
            $accb2_value = $item->accb2 !== null ? 1 : 0;
            $acca2_value = $item->acca2 !== null ? 1 : 0;
            $tubeb_value = $item->tubeb !== null ? 1 : 0;
            $tubea_value = $item->tubea !== null ? 1 : 0;

            $process = 0;

            if (stripos($ctrlno_value, 'BONDER') !== false || stripos($ctrlno_value, 'JOINT') !== false) {
                $process = 30;
            } elseif ($accb1_value && $tubeb_value && $term_a_value && !$acca1_value) {
                $process = 30;
            } elseif ($term_a_value && $acca1_value && !$acca2_value && $tubea_value) {
                $process = 30;
            } elseif (!$accb1_value && $tubeb_value && $term_a_value && !$acca1_value) {
                $process = 30;
            } elseif ($accb1_value && $tubea_value && $term_b_value && $acca1_value) {
                $process = 30;
            } elseif ($accb1_value && $tubea_value && $term_b_value && !$acca1_value) {
                $process = 30;
            } elseif ($term_b_value && !$accb2_value && $tubeb_value && !$tubea_value) {
                $process = 30;
            } elseif (!$accb1_value && $tubea_value && $term_b_value && !$acca1_value) {
                $process = 30;
            } elseif ($term_a_value && $acca1_value && $acca2_value && $tubea_value) {
                $process = 30;
            } elseif ($term_b_value && $term_a_value && $acca2_value && $tubea_value) {
                $process = 30;
            } elseif ($accb1_value && !$tubeb_value && $acca1_value && $tubea_value) {
                $process = 30;
            } elseif (!$accb2_value && !$acca2_value && $tubeb_value && !$tubea_value) {
                $process = 30;
            } elseif (!$accb2_value && !$acca2_value && !$tubeb_value && $tubea_value) {
                $process = 30;
            } elseif (!$accb2_value && $acca2_value && !$tubeb_value && !$tubea_value) {
                $process = 20;
            } elseif ($accb2_value && !$acca2_value && !$tubeb_value && !$tubea_value) {
                $process = 20;
            } elseif ($accb2_value && $term_a_value && !$tubeb_value && !$tubea_value) {
                $process = 20;
            } elseif ($accb1_value && $accb2_value && $acca1_value && $accb2_value) {
                $process = 20;
            } elseif (!$term_b_value && !$accb1_value && !$accb2_value && !$tubeb_value && !$term_a_value && !$acca1_value && !$acca2_value && !$tubea_value) {
                $process = 0;
            } elseif ($accb1_value && $term_b_value && !$tubeb_value && !$tubea_value) {
                $process = 10;
            } elseif ($acca1_value && $term_a_value && !$tubeb_value && !$tubea_value) {
                $process = 10;
            } elseif (!$accb1_value && !$tubeb_value && $term_b_value && !$acca1_value) {
                $process = 10;
            } elseif (!$accb1_value && !$tubeb_value && $term_a_value && !$acca1_value) {
                $process = 10;
            } elseif (!$accb1_value && !$tubeb_value && !$term_a_value && !$acca1_value) {
                $process = 10;
            } elseif (!$accb2_value && !$acca2_value && !$tubeb_value && !$tubea_value) {
                $process = 10;
            } elseif ($accb1_value && !$term_b_value && !$tubeb_value && !$tubea_value) {
                $process = 10;
            } elseif ($acca1_value && $term_a_value && !$tubeb_value && !$tubea_value) {
                $process = 10;
            } elseif ($acca1_value && !$term_a_value && !$tubeb_value && !$tubea_value) {
                $process = 10;
            } elseif (!$accb1_value && $acca1_value && !$tubeb_value && !$tubea_value) {
                $process = 10;
            } elseif ($accb1_value && !$acca1_value && !$tubeb_value && !$tubea_value) {
                $process = 10;
            }

            $item->process = $process;

            $processValue = $item->process;
            $umh_master = DB::table('umh_master')->where('car_line', $item->car_line)->where('user_id', $user)->first();

            if ($umh_master) {
                switch ($processValue) {
                    case 10:
                        $priceProcess = $umh_master->code_umh1;
                        break;
                    case 20:
                        $priceProcess = $umh_master->code_umh1 + $umh_master->code_umh2;
                        break;
                    case 30:
                        $priceProcess = $umh_master->code_umh1 + $umh_master->code_umh2 + $umh_master->code_umh3;
                        break;
                    default:
                        $priceProcess = null;
                        break;
                }
            } else {
                $priceProcess = null;
                $item->keterangan = '#N/A';
            }

            $item->umh = $priceProcess;

            $item->save();

            // PROCESS COST
            if ($umh_master) {
                $charge = $umh_master->charge;
            } else {
                $charge = null;
                $item->keterangan = '#N/A';
            }
            $item->charge = $charge;

            $item->save();

            $charge = $item->charge;
            $umh = $item->umh;
            $process_cost = $charge * $umh;
            $item->process_cost = $process_cost;

            $process_cost_amount = $process_cost * $total_qty;
            $item->process_cost_amount = $process_cost_amount;
            $item->save();

            // WIRE COST 
            $master_price = DB::table('master_price')
                ->where('part_number_ori_sto', $item->kind_size_color)
                ->where('user_id', $user)
                ->first();

            if (isset($master_price->price_per_pcs)) {
                $item->price_sum = $master_price->price_per_pcs;
            } else {
                $item->price_sum = null;
                $item->keterangan = '#N/A';
            }

            if ($master_price && isset($master_price->price_per_pcs)) {
                $item->wire_cost = $master_price->price_per_pcs * $item->cl / 1000;
            } else {
                $item->wire_cost = null;
                $item->keterangan = '#N/A';
            }


            // $item->price_sum = $master_price->price_per_pcs;
            // $item->wire_cost = $master_price->price_per_pcs * $item->cl / 1000;

            $component_cost = null;
            $part_numbers = ['term_b', 'accb1', 'accb2', 'tubeb', 'term_a', 'acca1', 'acca2', 'tubea'];
            $missingData = false;

            foreach ($part_numbers as $part_name) {
                $part_number = $item->{$part_name};

                if (!empty($part_number)) {
                    if (preg_match('/=(\d+)/', $part_number, $matches)) {
                        $multiplier = intval($matches[1]);

                        $prices = DB::table('master_price')
                            ->where('user_id', $user)
                            ->whereIn('part_number_ori_sto', [$part_number])
                            ->pluck('price_per_pcs')
                            ->toArray();

                        if (count($prices) > 0) {
                            $price = $multiplier * $prices[0] / 1000;
                        } else {
                            $missingData = true;
                            break;
                        }
                    } else {
                        $prices = DB::table('master_price')
                            ->where('user_id', $user)
                            ->whereIn('part_number_ori_sto', [$part_number])
                            ->pluck('price_per_pcs')
                            ->toArray();

                        if (count($prices) > 0) {
                            $price = $prices[0];
                        } else {
                            $missingData = true;
                            break;
                        }
                    }

                    if ($price !== null) {
                        if ($component_cost === null) {
                            $component_cost = 0;
                        }
                        $component_cost += $price;
                    }
                }
                // dd($part_number);
            }

            if ($missingData) {
                $component_cost = null;
                $item->keterangan = '#N/A';
            }

            // MATERIAL COST
            $material_cost = $item->wire_cost + $component_cost;
            $material_cost_amount = $material_cost * $total_qty;

            // TOTAL COST
            // $total_cost = $process_cost + $material_cost;
            // TOTAL COST AMOUNT
            $total_amount = $material_cost_amount + $process_cost_amount;

            $item->component_cost = $component_cost;
            $item->material_cost = $material_cost;
            $item->material_cost_amount = $material_cost_amount;
            // $item->total_cost = $total_cost;
            $item->total_amount = $total_amount;

            if ($component_cost !== null) {
                $item->save();
            }
            $item->save();
        }

        return view('proses_fa_1a.index', compact('count', 'proses_fa_1a'));
    }

    public function export_excel_proses_fa_1a()
    {
        set_time_limit(0);
        $user = Auth::id();
        $dataToExport = ProsesFa_1A::where('user_id', $user)->get();
        return Excel::download(new ProsesPAExport($dataToExport), 'proses_pa_data.xlsx');
    }

    public function destroy($id)
    {
        $user = Auth::id();
        ProsesFa_1A::where('user_id', $user)->delete($id);
        return response()->json(['success' => " Deleted successfully.", 'tr' => 'tr_' . $id]);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteAll_proses_pa(Request $request)
    {
        $ids = $request->ids;
        $user = Auth::id();

        ProsesFa_1A::where('user_id', $user)->whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => " Deleted successfully."]);
    }
}
