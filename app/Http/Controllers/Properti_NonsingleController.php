<?php

namespace App\Http\Controllers;

use App\Models\Properti_Nonsingle;
use App\Imports\Next_ProsesImport;
use App\Exports\Properti_NonsingleExport;
use App\Imports\Properti_NonsingleImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Properti_NonsingleController extends Controller
{

    public function cari_properti_nonsingle(Request $request)
    {
        $user = Auth::id();

        $searchTerm = $request->input('properti_nonsingle');

        $count = Properti_Nonsingle::count();

        $query = Properti_Nonsingle::query();

        $query->where('user_id', $user);

        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('kav', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('tipe', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('jenis', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('material', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('jenis_material', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('material_properties', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('model', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('ukuran', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('warna', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('model_ukuran_warna', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('no_item', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('cl', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('trm_b', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('acc_bag_b1', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('acc_bag_b2', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('tbe_b', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('trm_a', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('acc_bag_a1', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('acc_bag_a2', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('tbe_a', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $count = $query->count();

        $properti_nonsingle = $query->paginate(5000);

        return view('properti_nonsingle.partial.properti_nonsingle', ['properti_nonsingle' => $properti_nonsingle, 'count' => $count, 'user' => $user]);
    }

    public function getCount(Request $request)
    {
        $user = Auth::id();

        $searchTerm = $request->input('properti_nonsingle');

        $query = Properti_Nonsingle::query();

        $query->where('user_id', $user);

        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('kav', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('tipe', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('jenis', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('material', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('jenis_material', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('material_properties', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('model', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('ukuran', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('warna', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('model_ukuran_warna', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('no_item', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('cl', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('trm_b', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('acc_bag_b1', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('acc_bag_b2', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('tbe_b', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('trm_a', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('acc_bag_a1', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('acc_bag_a2', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('tbe_a', 'LIKE', '%' . $searchTerm . '%');
        });

        }

        $count = $query->count();

        return response()->json($count);
    }

    public function index(Request $request)
    {
        set_time_limit(0);
        $keyword = $request->cari;
        $user = Auth::id();

        $query = Properti_Nonsingle::where('user_id', $user)->orderBy('id', 'asc');

        if ($keyword) {
            $query->where('kav', 'LIKE', '%' . $keyword . '%')
            ->orWhere('tipe', 'LIKE', '%' . $keyword . '%')
            ->orWhere('jenis', 'LIKE', '%' . $keyword . '%')
            ->orWhere('material', 'LIKE', '%' . $keyword . '%')
            ->orWhere('jenis_material', 'LIKE', '%' . $keyword . '%')
            ->orWhere('material_properties', 'LIKE', '%' . $keyword . '%')
            ->orWhere('model', 'LIKE', '%' . $keyword . '%')
            ->orWhere('ukuran', 'LIKE', '%' . $keyword . '%')
            ->orWhere('warna', 'LIKE', '%' . $keyword . '%')
            ->orWhere('model_ukuran_warna', 'LIKE', '%' . $keyword . '%')
            ->orWhere('no_item', 'LIKE', '%' . $keyword . '%')
            ->orWhere('cl', 'LIKE', '%' . $keyword . '%')
            ->orWhere('trm_b', 'LIKE', '%' . $keyword . '%')
            ->orWhere('acc_bag_b1', 'LIKE', '%' . $keyword . '%')
            ->orWhere('acc_bag_b2', 'LIKE', '%' . $keyword . '%')
            ->orWhere('tbe_b', 'LIKE', '%' . $keyword . '%')
            ->orWhere('trm_a', 'LIKE', '%' . $keyword . '%')
            ->orWhere('acc_bag_a1', 'LIKE', '%' . $keyword . '%')
            ->orWhere('acc_bag_a2', 'LIKE', '%' . $keyword . '%')
            ->orWhere('tbe_a', 'LIKE', '%' . $keyword . '%');

            $count = $query->count();
        } else {
            $count = $query->count();
        }

        $properti_nonsingle = $query->get();

        $data = $properti_nonsingle->all();

        return view('properti_nonsingle.index', compact('properti_nonsingle', 'count', 'data'));
    }

    public function export_excel_np()
    {
        return Excel::download(new Properti_NonsingleExport, 'Properti Nonsingle.xlsx');
    }

    public function import_excel_np(Request $request)
    {
        set_time_limit(0);
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        $nama_file = rand() . $file->getClientOriginalName();

        $path = $file->storeAs('public/excel/', $nama_file);

        $import = Excel::import(new Properti_NonsingleImport(), storage_path('app/public/excel/' . $nama_file));

        Storage::delete($path);

        return back()->with('success', "Data berhasil diimport!");
    }

    public function create()
    {
        return view('properti_nonsingle.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kav' => 'required',
            'tipe' => 'required',
            'jenis' => 'required',
            'material' => 'required',
            'jenis_material' => 'required',
            'material_properties' => 'required',
            'model' => 'required',
            'ukuran' => 'required',
            'warna' => 'required',
            'model_ukuran_warna' => 'required',
            'no_item' => 'required',
            'cl' => 'required|integer',
            'trm_b' => 'required',
            'acc_bag_b1' => 'required',
            'acc_bag_b2' => 'required',
            'tbe_b' => 'required',
            'trm_a' => 'required',
            'acc_bag_a1' => 'required',
            'acc_bag_a2' => 'required',
            'tbe_b' => 'required',
        ]);
        $user = Auth::id();

        $properti_nonsingle = Properti_Nonsingle::create([
            'kav' => $request->kav,
            'tipe' => $request->tipe,
            'jenis' => $request->jenis,
            'material' => $request->material,
            'jenis_material' => $request->jenis_material,
            'material_properties' => $request->material_properties,
            'model' => $request->model,
            'ukuran' => $request->ukuran,
            'warna' => $request->warna,
            'model_ukuran_warna' => $request->model_ukuran_warna,
            'no_item' => $request->no_item,
            'cl' => $request->cl,
            'trm_b' => $request->trm_b,
            'acc_bag_b1' => $request->acc_bag_b1,
            'acc_bag_b2' => $request->acc_bag_b2,
            'tbe_b' => $request->tbe_b,
            'trm_a' => $request->trm_a,
            'acc_bag_a1' => $request->acc_bag_a1,
            'acc_bag_a2' => $request->acc_bag_a2,
            'tbe_a' => $request->tbe_a,
            'user_id' => $user,
        ]);

        if ($properti_nonsingle) {
            return redirect()->route('properti_nonsingle.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return redirect()->route('properti_nonsingle.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function show(Request $request, $id)
    {
        //
    }

    public function edit($id)
    {
        $properti_nonsingle = Properti_Nonsingle::findOrFail($id);
        return view('properti_nonsingle.edit', compact('properti_nonsingle'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'kav' => 'required',
            'tipe' => 'required',
            'jenis' => 'required',
            'material' => 'required',
            'jenis_material' => 'required',
            'material_properties' => 'required',
            'model' => 'required',
            'ukuran' => 'required',
            'warna' => 'required',
            'model_ukuran_warna' => 'required',
            'no_item' => 'required',
            'cl' => 'required|integer',
            'trm_b' => 'required',
            'acc_bag_b1' => 'required',
            'acc_bag_b2' => 'required',
            'tbe_b' => 'required',
            'trm_a' => 'required',
            'acc_bag_a1' => 'required',
            'acc_bag_a2' => 'required',
            'tbe_b' => 'required',
        ]);
        $user = Auth::id();

        $properti_nonsingle = Properti_Nonsingle::findOrFail($id);

        $properti_nonsingle->update([
            'kav' => $request->kav,
            'tipe' => $request->tipe,
            'jenis' => $request->jenis,
            'material' => $request->material,
            'jenis_material' => $request->jenis_material,
            'material_properties' => $request->material_properties,
            'model' => $request->model,
            'ukuran' => $request->ukuran,
            'warna' => $request->warna,
            'model_ukuran_warna' => $request->model_ukuran_warna,
            'no_item' => $request->no_item,
            'cl' => $request->cl,
            'trm_b' => $request->trm_b,
            'acc_bag_b1' => $request->acc_bag_b1,
            'acc_bag_b2' => $request->acc_bag_b2,
            'tbe_b' => $request->tbe_b,
            'trm_a' => $request->trm_a,
            'acc_bag_a1' => $request->acc_bag_a1,
            'acc_bag_a2' => $request->acc_bag_a2,
            'tbe_a' => $request->tbe_a,
            'user_id' => $user,
        ]);

        if ($properti_nonsingle) {
            return redirect()->route('properti_nonsingle.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            return redirect()->route('properti_nonsingle.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function destroy($id)
    {
        $user = Auth::id();

        Properti_Nonsingle::where('user_id', $user)->delete($id);
        return response()->json(['success' => " Deleted successfully.", 'tr' => 'tr_' . $id]);
    }

    public function deleteAll_Properti_Nonsingle(Request $request)
    {
        $ids = $request->ids;
        $user = Auth::id();

        Properti_Nonsingle::where('user_id', $user)->whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => " Deleted successfully."]);
    }

    public function reset_np()
    {
        $user = Auth::id();
        Properti_Nonsingle::where('user_id', $user)->delete();
        return response()->json(['success' => "Deleted successfully."]);
    }
}
