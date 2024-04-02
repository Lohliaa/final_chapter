<?php

namespace App\Http\Controllers;

use App\Exports\DatabaseKonversiExport;
use App\Imports\DatabaseKonversiImport;
use App\Models\DatabaseKonversi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class KonversiController extends Controller
{
    public function cari_dk(Request $request)
    {
        $user = Auth::id();

        $searchTerm = $request->input('database_konversi');

        $count = DatabaseKonversi::count();

        $query = DatabaseKonversi::query();

        $query->where('user_id', $user);

        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->orWhere('nomor_komponen', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('item', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('nama_komponen', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('satuan', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('inner_packing', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $count = $query->count();

        $database_konversi = $query->paginate(5000);

        return view('database_konversi.partial.database_konversi', ['database_konversi' => $database_konversi, 'count' => $count, 'user' => $user]);
    }

    public function getCount(Request $request)
    {
        $user = Auth::id();

        $searchTerm = $request->input('database_konversi');

        $query = DatabaseKonversi::query();

        $query->where('user_id', $user);
        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->orWhere('nomor_komponen', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('item', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('nama_komponen', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('satuan', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('inner_packing', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $count = $query->count();

        $database_konversi = $query->paginate(8000);

        return response()->json($count);
    }

    public function index(Request $request)
    {
        set_time_limit(0);
        $keyword = $request->cari;
        $user = Auth::id();
        $query = DatabaseKonversi::where('user_id', $user)->orderBy('id', 'asc');
        
        if ($keyword) {
            $query->where('nomor_komponen', 'LIKE', '%' . $keyword . '%')
            ->orWhere('item', 'LIKE', '%' . $keyword . '%')
            ->orWhere('nama_komponen', 'LIKE', '%' . $keyword . '%')
            ->orWhere('satuan', 'LIKE', '%' . $keyword . '%')
            ->orWhere('inner_packing', 'LIKE', '%' . $keyword . '%');

            $count = $query->count();
        } else {
            $count = $query->count();
        }

        $database_konversi = $query->get();

        $data = $database_konversi->all();


        return view('database_konversi.index', compact('database_konversi', 'count', 'data'));
    }

    public function export_excel_dk()
    {
        return Excel::download(new DatabaseKonversiExport, 'Database Konversi.xlsx');
    }

    public function import_excel_dk(Request $request)
    {
        set_time_limit(0);
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        $nama_file = rand() . $file->getClientOriginalName();

        $path = $file->storeAs('public/excel/', $nama_file);

        $import = Excel::import(new DatabaseKonversiImport(), storage_path('app/public/excel/' . $nama_file));

        Storage::delete($path);

        return back()->with('success', "Data berhasil diimport!");
    }

    public function create()
    {
        return view('database_konversi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_komponen' => 'required',
            'item' => 'required',
            'nama_komponen' => 'required',
            'satuan' => 'required',
            'inner_packing' => 'required',
        ]);

        $user = Auth::id();

        $database_konversi = DatabaseKonversi::create([
            'nomor_komponen' => $request->nomor_komponen,
            'item' => $request->item,
            'nama_komponen' => $request->nama_komponen,
            'satuan' => $request->satuan,
            'inner_packing' => $request->inner_packing,
            'user_id' => $user,
        ]);

        if ($database_konversi) {
            return redirect()->route('database_konversi.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return redirect()->route('database_konversi.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $database_konversi = DatabaseKonversi::findOrFail($id);
        return view('database_konversi.edit', compact('database_konversi'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nomor_komponen' => 'required',
            'item' => 'required',
            'nama_komponen' => 'required',
            'satuan' => 'required',
            'inner_packing' => 'required',
        ]);
        $user = Auth::id();

        $database_konversi = DatabaseKonversi::findOrFail($id);

        $database_konversi->update([
            'nomor_komponen' => $request->nomor_komponen,
            'item' => $request->item,
            'nama_komponen' => $request->nama_komponen,
            'satuan' => $request->satuan,
            'inner_packing' => $request->inner_packing,
            'user_id' => $user,
        ]);

        if ($database_konversi) {
            return redirect()->route('database_konversi.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            return redirect()->route('database_konversi.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function destroy($id)
    {
        $user = Auth::id();

        DatabaseKonversi::where('user_id', $user)->delete($id);
        return response()->json(['success' => " Deleted successfully.", 'tr' => 'tr_' . $id]);
    }

    public function deleteAll_dk(Request $request)
    {
        $ids = $request->ids;
        $user = Auth::id();

        DatabaseKonversi::where('user_id', $user)->whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => " Deleted successfully."]);
    }
    public function reset_dk()
    {
        $user = Auth::id();
        DatabaseKonversi::where('user_id', $user)->delete();
        return response()->json(['success' => "Deleted successfully."]);
    }
}
