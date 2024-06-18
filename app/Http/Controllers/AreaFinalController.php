<?php

namespace App\Http\Controllers;

use App\Exports\AreaFinalExport;
use App\Imports\AreaFinalImport;
use App\Models\Area_Final;
use App\Models\Proses;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AreaFinalController extends Controller
{

    public function cari_fa(Request $request)
    {

        $user = Auth::id();

        $searchTerm = $request->input('area_final');

        $count = Area_Final::count();

        $query = Area_Final::query();

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

        $area_final = $query->paginate(5000);

        return view('area_final.partial.area_final', ['area_final' => $area_final, 'count' => $count, 'user' => $user]);
    }


    public function getCount(Request $request)
    {
        $user = Auth::id();

        $searchTerm = $request->input('area_final');

        $query = Area_Final::query();

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

        $area_final = $query->paginate(8000);

        return response()->json($count);
    }

    public function index(Request $request)
    {
        set_time_limit(0);
        $keyword = $request->cari;
        $user = Auth::id();
        $query = Area_Final::where('user_id', $user)->orderBy('id', 'asc');
       
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

        $area_final = $query->get();

        $data = $area_final->all();

        $area_final = $query->paginate(8000);

        return view('area_final.index', compact('area_final', 'count', 'data'));
    }

    public function export_excel_fa()
    {
        return Excel::download(new AreaFinalExport, 'Area Final.xlsx');
    }
    public function import_excel_fa(Request $request)
    {
        set_time_limit(0);
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        $nama_file = rand() . $file->getClientOriginalName();

        $path = $file->storeAs('public/excel/', $nama_file);

        $import = Excel::import(new AreaFinalImport(), storage_path('app/public/excel/' . $nama_file));

        Storage::delete($path);

        return back()->with('success', "Data berhasil diimport!");
    }

    public function create()
    {
        return view('area_final.create');
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

        $area_final = Area_Final::create([
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

        if ($area_final) {
            return redirect()->route('area_final.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return redirect()->route('area_final.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function show(Request $request, $id)
    {
        //
    }

    public function edit($id)
    {
        $area_final = Area_Final::find($id);
        return view('area_final.edit', compact('area_final'));
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

        $area_final = Area_Final::findOrFail($id);

        $area_final->update([
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

        if ($area_final) {
            return redirect()->route('area_final.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            return redirect()->route('area_final.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function destroy($id)
    {
        $user = Auth::id();

        Area_Final::where('user_id', $user)->delete($id);
        return response()->json(['success' => " Deleted successfully.", 'tr' => 'tr_' . $id]);
    }

    public function deleteAll_fa(Request $request)
    {
        $ids = $request->ids;
        $user = Auth::id();

        Area_Final::where('user_id', $user)->whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => " Deleted successfully."]);
    }

    public function reset_fa()
    {
        $user = Auth::id();
    
        // Menghapus data dari tabel 'proses' yang berelasi dengan pengguna
        Proses::whereHas('area_final', function ($query) use ($user) {
            $query->where('user_id', $user);
        })->delete();
    
        // Menghapus data dari tabel 'area_final' yang dimiliki oleh pengguna
        Area_Final::where('user_id', $user)->delete();
    
        return response()->json(['success' => "Deleted successfully."]);
    }
}
