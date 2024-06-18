<?php

namespace App\Http\Controllers;

use App\Exports\ProsesMaterialExport;
use App\Models\DatabaseKonversi;
use App\Models\Material;
use App\Models\ProsesMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ProsesMaterialController extends Controller
{

    public function index(Request $request)
    {
        set_time_limit(0);
        $user = Auth::id();

        $count = ProsesMaterial::count();

        $query = ProsesMaterial::where('user_id', $user)->orderBy('id', 'asc');

        // Menghapus ProsesMaterial yang ada untuk user saat ini
        ProsesMaterial::where('user_id', $user)->delete();

        // Mengambil semua data Material dengan relasi ProsesMaterial
        $dataMaterial = Material::with('proses_material')->where('user_id', $user)->get();

        foreach ($dataMaterial as $material) {
            $partNumber = $material->component_number;
            $qtyTotal = $material->qty_total; // Mengambil qty_total dari Material saat ini
            
            $length = null;
            if (preg_match('/L=(\d+)/', $partNumber, $matches)) {
                $length = $matches[1];
            }

            $pricePerPcs = DB::table('harga')
                ->where('component_number_ori', trim($partNumber))
                ->where('user_id', $user)
                ->value('price_per_pcs');

            if ($pricePerPcs !== null) {
                $price = $pricePerPcs;
            } else {
                $price = 0;
            }

            $databaseKonversi = DatabaseKonversi::where('nomor_komponen', trim($partNumber))->first();
            $konversi = $databaseKonversi ? $databaseKonversi->inner_packing : null;

            if ($length) {
                $qty_after_konversi = ($length * $qtyTotal) / 1000;
            } elseif ($konversi) {
                $qty_after_konversi = ($konversi * $qtyTotal);
            } else {
                $qty_after_konversi = $qtyTotal;
            }

            $amount = $qty_after_konversi * $price;

            $cek = $qty_after_konversi - $qtyTotal;

            // Menyimpan Data ke dalam prosesMaterial
            $prosesMaterial = new ProsesMaterial([
                'user_id' => $user,
                'factory' => $material->factory,
                'code' => $material->code,
                'area' => $material->area,
                'hole' => $material->hole,
                'component_number' => trim($partNumber),
                'component_name' => $material->component_name,
                'qty_total' => $qtyTotal,
                'length' => $length,
                'konversi' => $konversi,
                'qty_after_konversi' => $qty_after_konversi,
                'cek' => $cek,
                'price' => $price,
                'amount' => $amount
            ]);

            // Atur relasi material
            $prosesMaterial->material()->associate($material);
            $prosesMaterial->save();
        }

        // Mengambil data ProsesMaterial setelah diupdate
        $proses_material = ProsesMaterial::where('user_id', $user)->get();

        $data = $proses_material->all();

        return view('proses_material.index', compact('count', 'proses_material', 'data'));
    }

    public function export_excel_prosesMaterial()
    {
        set_time_limit(0);
        $user = Auth::id();
        $dataToExport = ProsesMaterial::where('user_id', $user)->get();
        return Excel::download(new ProsesMaterialExport($dataToExport), 'proses material.xlsx');
    }
}
