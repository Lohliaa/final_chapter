<?php

namespace App\Http\Controllers;

use App\Exports\Properti_SingleExport;
use App\Imports\Properti_SingleImport;
use App\Models\Properti_Single;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Properti_SingleController extends Controller
{

    public function cari_properti_single(Request $request)
    {
        $user = Auth::id();

        $searchTerm = $request->input('properti_single');

        $count = Properti_Single::count();

        $query = Properti_Single::query();

        $query->where('user_id', $user);

        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('material_properties', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('model', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('ukuran', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('warna', 'LIKE', '%' . $searchTerm . '%')
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

        $properti_single = $query->paginate(5000);

        return view('properti_single.partial.properti_single', ['properti_single' => $properti_single, 'count' => $count, 'user' => $user]);
    }

    public function getCount(Request $request)
    {
        $user = Auth::id();

        $searchTerm = $request->input('properti_single');

        $query = Properti_Single::query();

        $query->where('user_id', $user);

        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('material_properties', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('model', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('ukuran', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('warna', 'LIKE', '%' . $searchTerm . '%')
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

        $query = Properti_Single::where('user_id', $user)->orderBy('id', 'asc');

        if ($keyword) {
            $query->where('material_properties', 'LIKE', '%' . $keyword . '%')
            ->orWhere('model', 'LIKE', '%' . $keyword . '%')
            ->orWhere('ukuran', 'LIKE', '%' . $keyword . '%')
            ->orWhere('warna', 'LIKE', '%' . $keyword . '%')
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

        $properti_single = $query->get();

        $data = $properti_single->all();

        return view('properti_single.index', compact('properti_single', 'count', 'data'));
    }

    public function export_excel_kc()
    {
        return Excel::download(new Properti_SingleExport, 'Properti Single.xlsx');
    }

    public function import_excel_kc(Request $request)
    {
        set_time_limit(0);
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        $nama_file = rand() . $file->getClientOriginalName();

        $path = $file->storeAs('public/excel/', $nama_file);

        $import = Excel::import(new Properti_SingleImport(), storage_path('app/public/excel/' . $nama_file));

        Storage::delete($path);

        return back()->with('success', "Data berhasil diimport!");
    }

    public function create()
    {
        return view('properti_single.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'material_properties' => 'required',
            'model' => 'required',
            'ukuran' => 'required',
            'warna' => 'required',
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

        $properti_single = Properti_Single::create([
            'material_properties' => $request->material_properties,
            'model' => $request->model,
            'ukuran' => $request->ukuran,
            'warna' => $request->warna,
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

        if ($properti_single) {
            return redirect()->route('properti_single.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return redirect()->route('properti_single.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function show(Request $request, $id)
    {
        //
    }

    public function edit($id)
    {
        $properti_single = Properti_Single::findOrFail($id);
        return view('properti_single.edit', compact('properti_single'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'material_properties' => 'required',
            'model' => 'required',
            'ukuran' => 'required',
            'warna' => 'required',
            'cl' => 'required|integer',
            'trm_b' => 'required',
            'acc_bag_b1' => 'required',
            'acc_bag_b2' => 'required',
            'tbe_b' => 'required',
            'trm_a' => 'required',
            'acc_bag_a1' => 'required',
            'acc_bag_a2' => 'required',
            'tbe_a' => 'required',
        ]);
        $user = Auth::id();

        $properti_single = Properti_Single::findOrFail($id);

        $properti_single->update([
            'material_properties' => $request->material_properties,
            'model' => $request->model,
            'ukuran' => $request->ukuran,
            'warna' => $request->warna,
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

        if ($properti_single) {
            return redirect()->route('properti_single.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            return redirect()->route('properti_single.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function destroy($id)
    {
        $user = Auth::id();

        Properti_Single::where('user_id', $user)->delete($id);
        return response()->json(['success' => " Deleted successfully.", 'tr' => 'tr_' . $id]);
    }

    public function deleteAll_properti_single(Request $request)
    {
        $ids = $request->ids;
        $user = Auth::id();

        Properti_Single::where('user_id', $user)->whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => " Deleted successfully."]);
    }

    public function reset_kc()
    {
        $user = Auth::id();
        Properti_Single::where('user_id', $user)->delete();
        return response()->json(['success' => "Deleted successfully."]);
    }
}
