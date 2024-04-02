<?php

namespace App\Http\Controllers;

use App\Exports\HargaExport;
use App\Imports\HargaImport;
use App\Models\Harga;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Validators\ValidationException;

class HargaController extends Controller
{

    public function search(Request $request)
    {

        $user = Auth::id();

        $searchTerm = $request->input('harga');

        $count = Harga::count();

        $query = Harga::query();

        $query->where('user_id', $user);

        $harga = Harga::where('user_id', $user);

        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('component_number_ori', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('component_number', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('item', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('price_per_pcs', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $count = $query->count();

        $harga = $query->paginate(10000);

        return view('harga.partial.harga', ['harga' => $harga, 'count' => $count, 'user' => $user]);
    }

    public function getCount(Request $request)
    {
        $user = Auth::id();

        $searchTerm = $request->input('harga');

        $query = Harga::query();

        $query->where('user_id', $user);

        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('component_number_ori', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('component_number', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('item', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('price_per_pcs', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $count = $query->count();

        return response()->json($count);
    }

    public function index(Request $request)
    {
        set_time_limit(0);
        $keyword = $request->pilih;
        $user = Auth::id();

        $query = Harga::where('user_id', $user)->orderBy('id', 'asc');

        if ($keyword) {
            $query->where('component_number_ori', 'LIKE', '%' . $keyword . '%')
                ->orWhere('component_number', 'LIKE', '%' . $keyword . '%')
                ->orWhere('item', 'LIKE', '%' . $keyword . '%')
                ->orWhere('price_per_pcs', 'LIKE', '%' . $keyword . '%');
            $count = $query->count();
        } else {
            $count = $query->count();
        }

        $harga = $query->get();

        $data = $harga->all();

        $harga = $query->paginate(10000);
        
        return view('harga.index', compact('harga', 'count', 'data'));
    }

    public function export_excel_mp()
    {
        return Excel::download(new HargaExport, 'Data Harga.xlsx');
    }

    public function import_excel_mp(Request $request)
    {
        set_time_limit(0);
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        $nama_file = rand() . $file->getClientOriginalName();

        $path = $file->storeAs('public/excel/', $nama_file);

        $import = Excel::queueimport(new HargaImport(), storage_path('app/public/excel/' . $nama_file));

        Storage::delete($path);

        return back()->with('success', "Data berhasil diimport!");
    }

    public function create()
    {
        return view('harga.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'component_number_ori' => 'required',
            'component_number' => 'required',
            'item' => 'required',
            'price_per_pcs' => 'required',
        ]);

        $user = Auth::id();

        $harga = Harga::create([
            'component_number_ori' => $request->component_number_ori,
            'component_number' => $request->component_number,
            'item' => $request->item,
            'price_per_pcs' => $request->price_per_pcs,
            'user_id' => $user,
        ]);

        if ($harga) {
            return redirect()->route('harga.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return redirect()->route('harga.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function show(Request $request, $id)
    {
        //
    }

    public function edit($id)
    {
        $harga = Harga::findOrFail($id);
        return view('harga.edit', compact('harga'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'component_number_ori' => 'required',
            'component_number' => 'required',
            'item' => 'required',
            'price_per_pcs' => 'required',
        ]);
        $user = Auth::id();

        $harga = Harga::findOrFail($id);

        $harga->update([
            'component_number_ori' => $request->component_number_ori,
            'component_number' => $request->component_number,
            'item' => $request->item,
            'price_per_pcs' => $request->price_per_pcs,
            'user_id' => $user,
        ]);

        if ($harga) {
            return redirect()->route('harga.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            return redirect()->route('harga.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function destroy($id)
    {
        $user = Auth::id();
        $harga = Harga::where('user_id', $user)->find($id);
        if (!$harga) {
            return response()->json(['error' => 'Data not found.'], 404);
        }

        $harga->delete();

        return response()->json(['success' => 'Deleted successfully.', 'tr' => 'tr_' . $id]);
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        $user = Auth::id();

        if (empty($ids)) {
            return response()->json(['error' => 'No items selected.'], 400);
        }

        $idArray = explode(",", $ids);

        $deleted = Harga::where('user_id', $user)->whereIn('id', $idArray)->delete();

        if ($deleted) {
            return response()->json(['success' => 'Deleted successfully.']);
        } else {
            return response()->json(['error' => 'Failed to delete items.'], 500);
        }
    }
    public function reset_mp()
    {
        $user = Auth::id();
        Harga::where('user_id', $user)->delete();
        return response()->json(['success' => "Deleted successfully."]);
    }
}
