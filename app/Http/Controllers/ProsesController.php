<?php

namespace App\Http\Controllers;

use App\Models\Proses;
use App\Exports\ProsesExport;
use App\Models\Properti_Nonsingle;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

class ProsesController extends Controller
{
    public function pilih_proses(Request $request)
    {

        $user = Auth::id();

        $searchTerm = $request->input('proses');

        $count = Proses::count();

        $query = Proses::query();

        $query->where('user_id', $user);

        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('material', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('model', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('ukuran', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('warna', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('month', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('kav', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('bagian', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('area_store', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('material_properties', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('model_ukuran_warna', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('specific_component_number', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('cl', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('trm_b', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('acc_bag_b1', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('acc_bag_b2', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('tbe_b', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('trm_a', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('acc_bag_a1', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('acc_bag_a2', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('tbe_a', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('total_qty', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('wire_cost', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('component_cost', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('material_cost', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('material_cost_amount', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('process', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('umh', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('charge', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('process_cost', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('process_cost_amount', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('total_amount', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('price_sum', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $count = $query->count();

        $proses = $query->paginate(5000);

        return view('proses.partial.proses', ['proses' => $proses, 'count' => $count, 'user' => $user]);
    }

    public function getCount(Request $request)
    {
        $user = Auth::id();

        $searchTerm = $request->input('proses');

        $query = Proses::query();

        $query->where('user_id', $user);

        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('material', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('model', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('ukuran', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('warna', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('month', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('kav', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('bagian', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('area_store', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('material_properties', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('model_ukuran_warna', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('specific_component_number', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('cl', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('trm_b', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('acc_bag_b1', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('acc_bag_b2', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('tbe_b', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('trm_a', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('acc_bag_a1', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('acc_bag_a2', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('tbe_a', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('total_qty', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('wire_cost', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('component_cost', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('material_cost', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('material_cost_amount', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('process', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('umh', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('charge', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('process_cost', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('process_cost_amount', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('total_amount', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('price_sum', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $count = $query->count();

        $proses = $query->paginate(8000);

        return response()->json($count);
    }

    public function index(Request $request)
    {
        set_time_limit(0);
        $keyword = $request->pilih_proses;
        $user = Auth::id();
        $query = Proses::where('user_id', $user)->orderBy('id', 'asc');

        if ($keyword) {
            $query->where('material', 'like', "%" . $keyword . "%")
                ->orWhere('model', 'like', "%" . $keyword . "%")
                ->orWhere('ukuran', 'like', "%" . $keyword . "%")
                ->orWhere('warna', 'like', "%" . $keyword . "%")
                ->orWhere('month', 'like', "%" . $keyword . "%")
                ->orWhere('kav', 'like', "%" . $keyword . "%")
                ->orWhere('bagian', 'like', "%" . $keyword . "%")
                ->orWhere('area_store', 'like', "%" . $keyword . "%")
                ->orWhere('material_properties', 'like', "%" . $keyword . "%")
                ->orWhere('model_ukuran_warna', 'like', "%" . $keyword . "%")
                ->orWhere('specific_component_number', 'like', "%" . $keyword . "%")
                ->orWhere('trm_b', 'like', "%" . $keyword . "%")
                ->orWhere('acc_bag_b1', 'like', "%" . $keyword . "%")
                ->orWhere('acc_bag_b2', 'like', "%" . $keyword . "%")
                ->orWhere('tbe_b', 'like', "%" . $keyword . "%")
                ->orWhere('trm_a', 'like', "%" . $keyword . "%")
                ->orWhere('acc_bag_a1', 'like', "%" . $keyword . "%")
                ->orWhere('acc_bag_a2', 'like', "%" . $keyword . "%")
                ->orWhere('tbe_a', 'like', "%" . $keyword . "%")
                ->orWhere('total_qty', 'like', "%" . $keyword . "%")
                ->orWhere('wire_cost', 'like', "%" . $keyword . "%")
                ->orWhere('component_cost', 'like', "%" . $keyword . "%")
                ->orWhere('material_cost', 'like', "%" . $keyword . "%")
                ->orWhere('material_cost_amount', 'like', "%" . $keyword . "%")
                ->orWhere('process', 'like', "%" . $keyword . "%")
                ->orWhere('umh', 'like', "%" . $keyword . "%")
                ->orWhere('charge', 'like', "%" . $keyword . "%")
                ->orWhere('process_cost', 'like', "%" . $keyword . "%")
                ->orWhere('process_cost_amount', 'like', "%" . $keyword . "%")
                ->orWhere('total_amount', 'like', "%" . $keyword . "%")
                ->orWhere('price_sum', 'like', "%" . $keyword . "%");
            $count = $query->count();
        } else {
            $count = $query->count();
        }

        $dataFa1c = DB::table('area_final')->select('kav', 'month', 'bagian', 'area_store', 'material', 'total_qty')
            ->where('user_id', $user)
            ->get();
        Proses::where('user_id', $user)->delete();

        $proses = $query->get();

        $data = $proses->all();

        $dataToInsert = [];

        foreach ($dataFa1c as $data) {
            $properti_single = DB::table('properti_single')->where('material_properties', $data->material)->where('user_id', $user)->get();
            $properti_nonsingle = Properti_Nonsingle::where('jenis_material', $data->material)->where('user_id', $user)->get();

            $ctrl_no_exists = false;

            foreach ($properti_single as $properti_single) {
                if (is_numeric($properti_single->ukuran)) {
                    // Jika ukuran adalah numerik, cek jika itu bulat atau pecahan
                    $is_integer = ($properti_single->ukuran == intval($properti_single->ukuran));
                    if ($is_integer) {
                        $size_decimal = number_format($properti_single->ukuran, 1);
                    } else {
                        $size_formatted = sprintf("%.2f", $properti_single->ukuran);
                        $size_decimal = rtrim(rtrim($size_formatted, '0'), '.');
                    }
                } else {
                    // Jika ukuran adalah teks, gunakan nilai teks tanpa perubahan
                    $size_decimal = $properti_single->ukuran;
                }

                $item = DB::table('item')
                    ->where('component_number', $properti_single->model . ' ' . $size_decimal . ' ' . $properti_single->warna,)
                    ->where('user_id', $user)
                    ->first();
                $prosesData = [
                    'month' => $data->month,
                    'kav' => $data->kav,
                    'bagian' => $data->bagian,
                    'area_store' => $data->area_store,
                    'material' => $data->material,
                    'total_qty' => $data->total_qty,
                    'material_properties' => $properti_single->material_properties,
                    'model' => $properti_single->model,
                    'ukuran' => $size_decimal,
                    'warna' => $properti_single->warna,
                    'model_ukuran_warna' => $properti_single->model . ' ' . $size_decimal . ' ' . $properti_single->warna,
                    'specific_component_number' => $item ? $item->specific_component_number : '',
                    'cl' => $properti_single->cl,
                    'trm_b' => $properti_single->trm_b,
                    'acc_bag_b1' => $properti_single->acc_bag_b1,
                    'acc_bag_b2' => $properti_single->acc_bag_b2,
                    'tbe_b' => $properti_single->tbe_b,
                    'trm_a' => $properti_single->trm_a,
                    'acc_bag_a1' => $properti_single->acc_bag_a1,
                    'acc_bag_a2' => $properti_single->acc_bag_a2,
                    'tbe_a' => $properti_single->tbe_a,
                ];
                $dataToInsert[] = $prosesData;
                $ctrl_no_exists = true;
            }

            foreach ($properti_nonsingle as $properti_nonsingle) {
                $prosesData2 = [
                    'month' => $data->month,
                    'kav' => $data->kav,
                    'bagian' => $data->bagian,
                    'area_store' => $data->area_store,
                    'material' => $data->material,
                    'total_qty' => $data->total_qty,
                    'material_properties' => $properti_nonsingle->material_properties,
                    'model' => $properti_nonsingle->model,
                    'ukuran' => $properti_nonsingle->ukuran,
                    'warna' => $properti_nonsingle->warna,
                    'model_ukuran_warna' => $properti_nonsingle->model . ' ' . $properti_nonsingle->ukuran . ' ' . $properti_nonsingle->warna,
                    'specific_component_number' => $properti_nonsingle->no_item,
                    'cl' => $properti_nonsingle->cl,
                    'trm_b' => $properti_nonsingle->trm_b,
                    'acc_bag_b1' => $properti_nonsingle->acc_bag_b1,
                    'acc_bag_b2' => $properti_nonsingle->acc_bag_b2,
                    'tbe_b' => $properti_nonsingle->tbe_b,
                    'trm_a' => $properti_nonsingle->trm_a,
                    'acc_bag_a1' => $properti_nonsingle->acc_bag_a1,
                    'acc_bag_a2' => $properti_nonsingle->acc_bag_a2,
                    'tbe_a' => $properti_nonsingle->tbe_a,
                ];
                $dataToInsert[] = $prosesData2;
                $ctrl_no_exists = true;
            }
            if (!$ctrl_no_exists) {
                $prosesDataFa1c = [
                    'month' => $data->month,
                    'kav' => $data->kav,
                    'bagian' => $data->bagian,
                    'area_store' => $data->area_store,
                    'material' => $data->material,
                    'total_qty' => $data->total_qty,
                    'keterangan' => '#N/A',
                ];
                $dataToInsert[] = $prosesDataFa1c;
            }
        }
        // Proses::where('user_id', $user)->truncate();

        foreach ($dataToInsert as $data) {
            $data['user_id'] = $user;
            Proses::insert($data);
        }

        $proses = Proses::where('user_id', $user)->get();

        foreach ($proses as $item) {
            $model_ukuran_warna = intval($item->model_ukuran_warna);
            $specific_component_number = intval($item->specific_component_number);
            $cl = intval($item->cl);
            $trm_b = intval($item->trm_b);
            $acc_bag_b1 = intval($item->acc_bag_b1);
            $acc_bag_b2 = intval($item->acc_bag_b2);
            $tbe_b = intval($item->tbe_b);
            $trm_a = intval($item->trm_a);
            $acc_bag_a1 = intval($item->acc_bag_a1);
            $acc_bag_a2 = intval($item->acc_bag_a2);
            $tbe_a = intval($item->tbe_a);
            $total_qty = intval($item->total_qty);
            $processValue = $item->process;
            $charge = $item->charge;
            $umh = $item->umh;
            $ctrlno_value = $item->material;

            $item->trm_b = $item->trm_b === '-' ? null : $item->trm_b;
            $item->acc_bag_b1 = $item->acc_bag_b1 === '-' ? null : $item->acc_bag_b1;
            $item->acc_bag_b2 = $item->acc_bag_b2 === '-' ? null : $item->acc_bag_b2;
            $item->tbe_b = $item->tbe_b === '-' ? null : $item->tbe_b;
            $item->trm_a = $item->trm_a === '-' ? null : $item->trm_a;
            $item->acc_bag_a1 = $item->acc_bag_a1 === '-' ? null : $item->acc_bag_a1;
            $item->acc_bag_a2 = $item->acc_bag_a2 === '-' ? null : $item->acc_bag_a2;
            $item->tbe_a = $item->tbe_a === '-' ? null : $item->tbe_a;

            // Mencari nilai 1 atau 0 berdasarkan kondisi pada kolom-kolom yang disebutkan
            $term_b_value = $item->trm_b !== null ? 1 : 0;
            $accb1_value = $item->acc_bag_b1 !== null ? 1 : 0;
            $term_a_value = $item->trm_a !== null ? 1 : 0;
            $acca1_value = $item->acc_bag_a1 !== null ? 1 : 0;
            $accb2_value = $item->acc_bag_b2 !== null ? 1 : 0;
            $acca2_value = $item->acc_bag_a2 !== null ? 1 : 0;
            $tubeb_value = $item->tbe_b !== null ? 1 : 0;
            $tubea_value = $item->tbe_a !== null ? 1 : 0;

            $process = 0;

            if (stripos($ctrlno_value, 'SOLDER') !== false || stripos($ctrlno_value, 'JOINT') !== false) {
                $process = 30;
            } elseif (
                !$term_b_value && !$accb1_value && !$accb2_value &&
                !$tubeb_value && !$term_a_value && !$acca1_value && !$acca2_value && !$tubea_value
            ) {
                $process = 0;
            } elseif (
                $accb2_value && $acca2_value && !$tubeb_value && !$tubea_value ||
                !$accb2_value && $acca2_value && !$tubeb_value && !$tubea_value ||
                $accb2_value && !$acca2_value && !$tubeb_value && !$tubea_value
            ) {
                $process = 20;
            } elseif (
                $accb1_value && $tubeb_value && $term_a_value && ($acca1_value || !$acca1_value) ||
                $term_a_value && $acca1_value && !$acca2_value && $tubea_value ||
                $accb1_value && $tubea_value && $term_b_value && ($acca1_value || !$acca1_value) ||
                $term_b_value && !$accb2_value && $tubeb_value && !$tubea_value
            ) {
                $process = 30;
            } elseif (
                $accb1_value && $term_b_value && !$tubeb_value && !$tubea_value ||
                $acca1_value && $term_a_value && !$tubeb_value && !$tubea_value ||
                !$accb1_value && !$tubeb_value && $term_b_value && !$acca1_value ||
                !$accb1_value && !$tubeb_value && $term_a_value && !$acca1_value ||
                !$accb1_value && !$tubeb_value && !$term_a_value && !$acca1_value ||
                !$accb2_value && !$acca2_value && !$tubeb_value && !$tubea_value ||
                $accb1_value && !$term_b_value && !$tubeb_value && !$tubea_value ||
                $acca1_value && $term_a_value && !$tubeb_value && !$tubea_value ||
                $acca1_value && !$term_a_value && !$tubeb_value && !$tubea_value ||
                !$accb1_value && $acca1_value && !$tubeb_value && !$tubea_value ||
                $accb1_value && !$acca1_value && !$tubeb_value && !$tubea_value
            ) {
                $process = 10;
            }

            $item->process = $process;

            $processValue = $item->process;
            $umh_master = DB::table('umh_master')->where('kav', $item->kav)->where('user_id', $user)->first();

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
            $harga = DB::table('harga')
                ->where('component_number_ori', $item->model_ukuran_warna)
                ->where('user_id', $user)
                ->first();

            if (isset($harga->price_per_pcs)) {
                $item->price_sum = $harga->price_per_pcs;
            } else {
                $item->price_sum = null;
                $item->keterangan = '#N/A';
            }

            if ($harga && isset($harga->price_per_pcs)) {
                $item->wire_cost = $harga->price_per_pcs * $item->cl / 1000;
            } else {
                $item->wire_cost = null;
                $item->keterangan = '#N/A';
            }

            // $item->price_sum = $harga->price_per_pcs;
            // $item->wire_cost = $harga->price_per_pcs * $item->cl / 1000;

            $component_cost = null;
            $part_numbers = ['trm_b', 'acc_bag_b1', 'acc_bag_b2', 'tbe_b', 'trm_a', 'acc_bag_a1', 'acc_bag_a2', 'tbe_a'];
            $missingData = false;

            foreach ($part_numbers as $component_name) {
                $component_number = $item->{$component_name};

                if (!empty($component_number)) {
                    if (preg_match('/=(\d+)/', $component_number, $matches)) {
                        $multiplier = intval($matches[1]);

                        $prices = DB::table('harga')
                            ->where('user_id', $user)
                            ->whereIn('component_number_ori', [$component_number])
                            ->pluck('price_per_pcs')
                            ->toArray();

                        if (count($prices) > 0) {
                            $price = $multiplier * $prices[0] / 1000;
                        } else {
                            $missingData = true;
                            break;
                        }
                    } else {
                        $prices = DB::table('harga')
                            ->where('user_id', $user)
                            ->whereIn('component_number_ori', [$component_number])
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
            }

            if ($missingData) {
                $component_cost = null;
                $item->keterangan = '#N/A';
            }

            // MATERIAL COST
            $material_cost = $item->wire_cost + $component_cost;
            $material_cost_amount = $material_cost * $total_qty;

            // TOTAL COST AMOUNT
            $total_amount = $material_cost_amount + $process_cost_amount;

            $item->component_cost = $component_cost;
            $item->material_cost = $material_cost;
            $item->material_cost_amount = $material_cost_amount;
            $item->total_amount = $total_amount;

            if ($component_cost !== null) {
                $item->save();
            }
            $item->save();
        }

        return view('proses.index', compact('count', 'proses', 'data'));
    }

    public function export_excel_proses()
    {
        set_time_limit(0);
        $user = Auth::id();
        $dataToExport = Proses::where('user_id', $user)->get();
        return Excel::download(new ProsesExport($dataToExport), 'Proses Final.xlsx');
    }

    public function destroy($id)
    {
        $user = Auth::id();

        Proses::where('user_id', $user)->delete($id);
        return response()->json(['success' => " Deleted successfully.", 'tr' => 'tr_' . $id]);
    }

    public function deleteAll_proses(Request $request)
    {
        $ids = $request->ids;
        $user = Auth::id();

        Proses::where('user_id', $user)->whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => " Deleted successfully."]);
    }
}
