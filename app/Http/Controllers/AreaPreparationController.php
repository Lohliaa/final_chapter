<?php

namespace App\Http\Controllers;

use App\Exports\AreaPreparationExport;
use App\Imports\AreaPreparationImport;
use App\Models\Area_Preparation;
use App\Models\ProsesFa_1A;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AreaPreparationController extends Controller
{

    public function cari_pa(Request $request)
    {

        $user = Auth::id();

        $searchTerm = $request->input('area_preparation');

        $count = Area_Preparation::count();

        $query = Area_Preparation::query();

        $query->where('user_id', $user);

        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('material', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('area_store', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('warna', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('qty_board', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('publish', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('total_qty', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('plank', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('bagian', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('kav', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('month', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('year', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('factory', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $count = $query->count();

        $area_preparation = $query->paginate(5000);

        return view('area_preparation.partial.area_preparation', ['area_preparation' => $area_preparation, 'count' => $count, 'user' => $user]);
    }


    public function getCount(Request $request)
    {
        $user = Auth::id();

        $searchTerm = $request->input('area_preparation');

        $query = Area_Preparation::query();

        $query->where('user_id', $user);

        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('material', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('area_store', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('warna', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('qty_board', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('publish', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('total_qty', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('plank', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('bagian', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('kav', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('month', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('year', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('factory', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $count = $query->count();

        $area_preparation = $query->paginate(8000);

        return response()->json($count);
    }

    public function index(Request $request)
    {
        set_time_limit(0);
        $keyword = $request->cari;
        $user = Auth::id();
        $query = Area_Preparation::where('user_id', $user)->orderBy('id', 'asc');
       
        if ($keyword) {
            $query->where('material', 'LIKE', '%' . $keyword . '%')
            ->orWhere('area_store', 'LIKE', '%' . $keyword . '%')
            ->orWhere('warna', 'LIKE', '%' . $keyword . '%')
            ->orWhere('qty_board', 'LIKE', '%' . $keyword . '%')
            ->orWhere('publish', 'LIKE', '%' . $keyword . '%')
            ->orWhere('total_qty', 'LIKE', '%' . $keyword . '%')
            ->orWhere('plank', 'LIKE', '%' . $keyword . '%')
            ->orWhere('bagian', 'LIKE', '%' . $keyword . '%')
            ->orWhere('kav', 'LIKE', '%' . $keyword . '%')
            ->orWhere('month', 'LIKE', '%' . $keyword . '%')
            ->orWhere('year', 'LIKE', '%' . $keyword . '%')
            ->orWhere('factory', 'LIKE', '%' . $keyword . '%');
            $count = $query->count();
        } else {
            $count = $query->count();
        }

        $area_preparation = $query->get();

        $data = $area_preparation->all();

        $area_preparation = $query->paginate(8000);

        return view('area_preparation.index', compact('area_preparation', 'count', 'data'));
    }

    public function export_excel_pa()
    {
        return Excel::download(new AreaPreparationExport, 'Area Preparation.xlsx');
    }
    public function import_excel_pa(Request $request)
    {
        set_time_limit(0);
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        $nama_file = rand() . $file->getClientOriginalName();

        $path = $file->storeAs('public/excel/', $nama_file);

        $import = Excel::import(new AreaPreparationImport(), storage_path('app/public/excel/' . $nama_file));

        Storage::delete($path);

        return back()->with('success', "Data berhasil diimport!");
    }

    public function create()
    {
        return view('area_preparation.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kav' => 'required',
            'bagian' => 'required',
            'area_store' => 'required',
            'material' => 'required',
            'warna' => 'required',
            'qty_board' => 'required',
            'publish' => 'required',
            'total_qty' => 'required',
            'plank' => 'required',
            'month' => 'required',
            'year' => 'required',
            'factory' => 'required',
        ]);

        $user = Auth::id();

        $area_preparation = Area_Preparation::create([
            'kav' => $request->kav,
            'bagian' => $request->bagian,
            'area_store' => $request->area_store,
            'material' => $request->material,
            'warna' => $request->warna,
            'qty_board' => $request->qty_board,
            'publish' => $request->publish,
            'total_qty' => $request->total_qty,
            'plank' => $request->plank,
            'month' => $request->month,
            'year' => $request->year,
            'factory' => $request->factory,
            'user_id' => $user,
        ]);

        if ($area_preparation) {
            return redirect()->route('area_preparation.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return redirect()->route('area_preparation.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function show(Request $request, $id)
    {
        //
    }

    public function edit($id)
    {
        $area_preparation = Area_Preparation::find($id);
        return view('area_preparation.edit', compact('area_preparation'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'kav' => 'required',
            'bagian' => 'required',
            'area_store' => 'required',
            'material' => 'required',
            'warna' => 'required',
            'qty_board' => 'required',
            'publish' => 'required',
            'total_qty' => 'required',
            'plank' => 'required',
            'month' => 'required',
            'year' => 'required',
            'factory' => 'required',
        ]);
        $user = Auth::id();

        $area_preparation = Area_Preparation::findOrFail($id);

        $area_preparation->update([
            'kav' => $request->kav,
            'bagian' => $request->bagian,
            'area_store' => $request->area_store,
            'material' => $request->material,
            'warna' => $request->warna,
            'qty_board' => $request->qty_board,
            'publish' => $request->publish,
            'total_qty' => $request->total_qty,
            'plank' => $request->plank,
            'month' => $request->month,
            'year' => $request->year,
            'factory' => $request->factory,
            'user_id' => $user,
        ]);

        if ($area_preparation) {
            return redirect()->route('area_preparation.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            return redirect()->route('area_preparation.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function destroy($id)
    {
        $user = Auth::id();

        Area_Preparation::where('user_id', $user)->delete($id);
        return response()->json(['success' => " Deleted successfully.", 'tr' => 'tr_' . $id]);
    }

    public function deleteAll_pa(Request $request)
    {
        $ids = $request->ids;
        $user = Auth::id();

        Area_Preparation::where('user_id', $user)->whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => " Deleted successfully."]);
    }
    public function reset_pa()
    {
        $user = Auth::id();
        Area_Preparation::where('user_id', $user)->delete();
        ProsesFa_1A::where('user_id', $user)->delete();
        return response()->json(['success' => "Deleted successfully."]);
    }
}
