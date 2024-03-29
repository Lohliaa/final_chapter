<?php

namespace App\Http\Controllers;

use App\Exports\ProsesMaterialExport;
use App\Models\DatabaseKonversi;
use App\Models\ProsesMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ProsesMaterialController extends Controller
{
    public function pilih_proses_material(Request $request)
    {
        $user = Auth::id();

        $searchTerm = $request->input('proses_material');

        $count = ProsesMaterial::count();

        $query = ProsesMaterial::query();

        $query->where('user_id', $user);

        if($searchTerm){
            $query->where(function ($query) use ($searchTerm) {
                $query->where('factory', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('carcode', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('area', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('cavity', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('partnumber', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('part_name', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('qty_total', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('length', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('konversi', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('qty_after_konversi', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('cek', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('price', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('amount', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $count = $query->count();

        $proses_material = $query->paginate(5000);

        return view('proses_material.partial.proses_material', ['proses_material' => $proses_material, 'count' => $count, 'user' => $user]);
    }
    
    public function getCount(Request $request)
    {
        $user = Auth::id();

        $searchTerm = $request->input('proses_material');

        $query = ProsesMaterial::query();

        $query->where('user_id', $user);

        if($searchTerm){
            $query->where(function ($query) use ($searchTerm) {
                $query->where('factory', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('carcode', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('area', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('cavity', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('partnumber', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('part_name', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('qty_total', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('length', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('konversi', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('qty_after_konversi', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('cek', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('price', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('amount', 'LIKE', '%' . $searchTerm . '%');
            });

        }

        $count = $query->count();

        $proses_material = $query->paginate(8000);

        return response()->json($count);
    }

    public function index(Request $request)
    {
        set_time_limit(0);
        $keyword = $request->pilih_proses_material;
        $user = Auth::id();

        $query = ProsesMaterial::where('user_id', $user)->orderBy('id', 'asc');

        if($keyword){
            $query->where('factory', 'LIKE', '%' . $keyword . '%')
            ->orWhere('carcode', 'LIKE', '%' . $keyword . '%')
            ->orWhere('area', 'LIKE', '%' . $keyword . '%')
            ->orWhere('cavity', 'LIKE', '%' . $keyword . '%')
            ->orWhere('partnumber', 'LIKE', '%' . $keyword . '%')
            ->orWhere('part_name', 'LIKE', '%' . $keyword . '%')
            ->orWhere('qty_total', 'LIKE', '%' . $keyword . '%')
            ->orWhere('length', 'LIKE', '%' . $keyword . '%')
            ->orWhere('konversi', 'LIKE', '%' . $keyword . '%')
            ->orWhere('qty_after_konversi', 'LIKE', '%' . $keyword . '%')
            ->orWhere('cek', 'LIKE', '%' . $keyword . '%')
            ->orWhere('price', 'LIKE', '%' . $keyword . '%')
            ->orWhere('amount', 'LIKE', '%' . $keyword . '%');
            $count = $query->count();
        } else {
            $count = $query->count();
        }

        $dataMaterial = DB::table('material')->select('factory', 'carcode', 'area', 'cavity', 'partnumber', 'part_name', 'qty_total')
            ->where('user_id', $user)
            ->get();
        ProsesMaterial::where('user_id', $user)->delete();
        foreach ($dataMaterial as $data) {
            $partNumbers = explode('+', $data->partnumber);
            $qtyTotal = $data->qty_total;
            foreach ($partNumbers as $partNumber) {
                $length = null;
                if (preg_match('/L=(\d+)/', $partNumber, $matches)) {
                    $length = $matches[1];
                }

                $pricePerPcs = DB::table('master_price')
                    ->where('part_number_ori_sto', trim($partNumber))
                    ->value('price_per_pcs');

                if (isset($pricePerPcs->price_per_pcs)) {
                    $data->price = $pricePerPcs->price_per_pcs;
                } else {
                    $data->price = 0;
                }

                $databaseKonversi = DatabaseKonversi::where('part_no', trim($partNumber))->first();
                $konversi = $databaseKonversi ? $databaseKonversi->inner_packing : null;

                if ($length) {
                    $qty_after_konversi = ($length * $qtyTotal) / 1000;
                } elseif ($konversi) {
                    $qty_after_konversi = ($konversi * $qtyTotal);
                } else {
                    $qty_after_konversi = $qtyTotal;
                }

                // AMOUNT
                $amount = $qty_after_konversi * $pricePerPcs;

                // CEK
                $cek = $qty_after_konversi - $qtyTotal;

                ProsesMaterial::create([
                    'user_id' => $user,
                    'factory' => $data->factory,
                    'carcode' => $data->carcode,
                    'area' => $data->area,
                    'cavity' => $data->cavity,
                    'partnumber' => trim($partNumber),
                    'part_name' => $data->part_name,
                    'qty_total' => $qtyTotal,
                    'length' => $length,
                    'konversi' => $konversi,
                    'qty_after_konversi' => $qty_after_konversi,
                    'cek' => $cek,
                    'price' => $pricePerPcs,
                    'amount' => $amount
                ]);
            }
        }

        $proses_material = ProsesMaterial::where('user_id', $user)->get();

        $proses_material = $query->get();

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

    // public function export_excel_prosesMaterial()
    // {
    //     set_time_limit(0);
    //     $dataToExport = ProsesMaterial::all();

    //     $carcode = $dataToExport->first()->carcode;

    //     $charactersToReplace = ['/', '\\', ':', '?', '|', '(', ')', '-', ',', '.'];

    //     $carcode = str_replace($charactersToReplace, '', $carcode);

    //     $fileName = "report material {$carcode}.xlsx";

    //     return Excel::download(new ProsesMaterialExport($dataToExport), $fileName);
    // }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::id();

        ProsesMaterial::where('user_id', $user)->delete($id);
        return response()->json(['success' => " Deleted successfully.", 'tr' => 'tr_' . $id]);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteAll_prosesMaterial(Request $request)
    {
        $ids = $request->ids;
        $user = Auth::id();

        ProsesMaterial::where('user_id', $user)->whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => " Deleted successfully."]);
    }
}
