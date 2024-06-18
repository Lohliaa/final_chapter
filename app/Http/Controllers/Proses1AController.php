<?php

namespace App\Http\Controllers;

use App\Exports\ProsesPAExport;
use App\Models\Area_Preparation;
use App\Models\Properti_Nonsingle;
use App\Models\Properti_Single;
use App\Models\Proses_PA;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

class Proses1AController extends Controller
{
    public function index(Request $request)
    {
        set_time_limit(0);
        $user = Auth::id();
        $count = Proses_PA::count();

        $query = Proses_PA::where('user_id', $user)->orderBy('id', 'asc');

        $dataFa1a = Area_Preparation::with('proses_pa')
            ->where('user_id', $user)
            ->get();

        Proses_PA::where('user_id', $user)->delete();

        $dataToInsert = [];

        foreach ($dataFa1a as $area_preparation) {
            $properti_single = Properti_Single::where('material_properties', $area_preparation->material)
                ->where('user_id', $user)
                ->get();

            $properti_nonsingle = Properti_Nonsingle::where('jenis_material', $area_preparation->material)
                ->where('user_id', $user)
                ->get();

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
                    ->where('component_number', $properti_single->model . ' ' . $size_decimal . ' ' . $properti_single->warna)
                    ->where('user_id', $user)
                    ->first();

                $prosesData = new Proses_PA([
                    'month' => $area_preparation->month,
                    'kav' => $area_preparation->kav,
                    'bagian' => $area_preparation->bagian,
                    'area_store' => $area_preparation->area_store,
                    'material' => $area_preparation->material,
                    'total_qty' => $area_preparation->total_qty,
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
                    'user_id' => $user,
                ]);
                $area_preparation->proses_pa()->save($prosesData);
            }

            foreach ($properti_nonsingle as $properti_nonsingle) {
                $prosesData = new Proses_PA([
                    'month' => $area_preparation->month,
                    'kav' => $area_preparation->kav,
                    'bagian' => $area_preparation->bagian,
                    'area_store' => $area_preparation->area_store,
                    'material' => $area_preparation->material,
                    'total_qty' => $area_preparation->total_qty,
                    'material_properties' => $properti_nonsingle->material_properties,
                    'model' => $properti_nonsingle->model,
                    'ukuran' => $properti_nonsingle->ukuran,
                    'warna' => $properti_nonsingle->warna,
                    'model_ukuran_warna' => $properti_nonsingle->model_ukuran_warna,
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
                    'user_id' => $user,
                ]);
                $area_preparation->proses_pa()->save($prosesData);
            }
        }

        $proses_pa = Proses_PA::where('user_id', $user)->get();

        foreach ($proses_pa as $item) {
            // Mengambil area_preparation yang sesuai dengan proses  
            $area_preparation = $item->area_preparation;

            // Mengambil nilai dari area_preparation
            $total_qty = $area_preparation->total_qty;
            $ctrlno_value = $area_preparation->material;
            $kav = $area_preparation->kav;

            // Lanjutkan dengan pengambilan nilai lain seperti yang Anda lakukan sebelumnya
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
            $processValue = $item->process;
            $umh = $item->umh;

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

            // WIRE COST 
            $harga = DB::table('harga')
                ->where('component_number_ori', $item->model_ukuran_warna)
                ->where('user_id', $user)
                ->first();

            if ($harga && isset($harga->price_per_pcs)) {
                $item->price_sum = $harga->price_per_pcs;
                $item->wire_cost = $harga->price_per_pcs * $item->cl / 1000;
            } else {
                $item->price_sum = null;
                $item->wire_cost = null;
                $item->keterangan = '#N/A';
            }

            // COMPONENT COST
            $part_numbers = ['trm_b', 'acc_bag_b1', 'acc_bag_b2', 'tbe_b', 'trm_a', 'acc_bag_a1', 'acc_bag_a2', 'tbe_a'];

            $component_cost = null;
            $missingData = false;

            foreach ($part_numbers as $component_name) {
                $component_number = $item->{$component_name};

                if (!empty($component_number)) {
                    $prices = DB::table('harga')
                        ->where('user_id', $user)
                        ->whereIn('component_number_ori', [$component_number])
                        ->pluck('price_per_pcs')
                        ->toArray();

                    if (count($prices) > 0) {
                        $price = $prices[0];
                        if (preg_match('/=(\d+)/', $component_number, $matches)) {
                            $multiplier = intval($matches[1]);
                            $price *= $multiplier / 1000;
                        }
                        if ($component_cost === null) {
                            $component_cost = 0;
                        }
                        $component_cost += $price;
                    } else {
                        $missingData = true;
                        break;
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

            // UMH - CHARGE
            $umh_master = DB::table('umh_master')
                ->where('kav', $kav)
                ->where('user_id', $user)
                ->first();

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
                $charge = $umh_master->charge;
            } else {
                $priceProcess = null;
                $charge = null;
                $item->keterangan = '#N/A';
            }

            $item->umh = $priceProcess;
            $item->charge = $charge;

            $charge = $item->charge;
            $umh = $item->umh;

            // PROCESS COST
            $process_cost = $charge * $umh;
            $process_cost_amount = $process_cost * $total_qty;

            // TOTAL COST AMOUNT
            $total_amount = $material_cost_amount + $process_cost_amount;

            $item->process_cost = $process_cost;
            $item->process_cost_amount = $process_cost_amount;
            $item->component_cost = $component_cost;
            $item->material_cost = $material_cost;
            $item->material_cost_amount = $material_cost_amount;
            $item->total_amount = $total_amount;
            $item->save();
        }

        return view('proses_pa.index', compact('count', 'proses_pa'));
    }

    public function export_excel_proses_fa_1a()
    {
        set_time_limit(0);
        $user = Auth::id();
        $dataToExport = Proses_PA::where('user_id', $user)->get();
        return Excel::download(new ProsesPAExport($dataToExport), 'Proses Preparation.xlsx');
    }
}
