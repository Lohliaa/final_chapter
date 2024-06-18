<?php

namespace App\Http\Controllers;

use App\Exports\MaterialExport;
use App\Imports\MaterialImport;
use App\Models\Material;
use App\Models\ProsesMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class MaterialController extends Controller
{

    public function cari_material(Request $request)
    {
        $user = Auth::id();

        $searchTerm = $request->input('material');

        $count = Material::count();

        $query = Material::query();

        $query->where('user_id', $user);

        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('factory', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('code', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('area', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('hole', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('component_number', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('component_name', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('qty_total', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $count = $query->count();

        $material = $query->paginate(5000);

        return view('material.partial.material', ['material' => $material, 'count' => $count, 'user' => $user]);
    }

    public function getCount(Request $request)
    {
        $user = Auth::id();

        $searchTerm = $request->input('material');

        $query = Material::query();

        $query->where('user_id', $user);

        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('factory', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('code', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('area', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('hole', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('component_number', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('component_name', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('qty_total', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $count = $query->count();

        $material = $query->paginate(8000);

        return response()->json($count);
    }

    public function index(Request $request)
    {
        set_time_limit(0);
        $keyword = $request->cari;
        $user = Auth::id();
        $query = Material::where('user_id', $user)->orderBy('id', 'asc');
        
        if ($keyword) {
            $query->where('factory', 'LIKE', '%' . $keyword . '%')
            ->orWhere('code', 'LIKE', '%' . $keyword . '%')
            ->orWhere('area', 'LIKE', '%' . $keyword . '%')
            ->orWhere('hole', 'LIKE', '%' . $keyword . '%')
            ->orWhere('component_number', 'LIKE', '%' . $keyword . '%')
            ->orWhere('component_name', 'LIKE', '%' . $keyword . '%')
            ->orWhere('qty_total', 'LIKE', '%' . $keyword . '%');            
            $count = $query->count();
        } else {
            $count = $query->count();
        }
        
        $material = $query->get();

        $data = $material->all();

        return view('material.index', compact('material', 'count', 'data'));
    }

    public function export_excel_material()
    {
        return Excel::download(new MaterialExport, 'Material.xlsx');
    }

    public function import_excel_material(Request $request)
    {
        set_time_limit(0);
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        $nama_file = rand() . $file->getClientOriginalName();

        $path = $file->storeAs('public/excel/', $nama_file);

        $import = Excel::import(new MaterialImport(), storage_path('app/public/excel/' . $nama_file));

        Storage::delete($path);

        return back()->with('success', "Data berhasil diimport!");
    }

    public function create()
    {
        return view('material.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'factory' => 'required',
            'code' => 'required',
            'area' => 'required',
            'hole' => 'required',
            'component_number' => 'required',
            'component_name' => 'required',
            'qty_total' => 'required',
        ]);

        $user = Auth::id();

        $material = Material::create([
            'factory' => $request->factory,
            'code' => $request->code,
            'area' => $request->area,
            'hole' => $request->hole,
            'component_number' => $request->component_number,
            'component_name' => $request->component_name,
            'qty_total' => $request->qty_total,
            'user_id' => $user,

        ]);

        if ($material) {
            return redirect()->route('material.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return redirect()->route('material.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function show(Request $request, $id)
    {
        //
    }

    public function edit($id)
    {
        $material = Material::find($id);
        return view('material.edit', compact('material'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'factory' => 'required',
            'code' => 'required',
            'area' => 'required',
            'hole' => 'required',
            'component_number' => 'required',
            'component_name' => 'required',
            'qty_total' => 'required',
        ]);
        $user = Auth::id();

        $material = Material::findOrFail($id);

        $material->update([
            'factory' => $request->factory,
            'code' => $request->code,
            'area' => $request->area,
            'hole' => $request->hole,
            'component_number' => $request->component_number,
            'component_name' => $request->component_name,
            'qty_total' => $request->qty_total,
            'user_id' => $user,

        ]);

        if ($material) {
            return redirect()->route('material.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            return redirect()->route('material.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function destroy($id)
    {
        $user = Auth::id();

        Material::where('user_id', $user)->delete($id);
        return response()->json(['success' => " Deleted successfully.", 'tr' => 'tr_' . $id]);
    }

    public function deleteAll_material(Request $request)
    {
        $ids = $request->ids;
        $user = Auth::id();
    
        // Hapus data terkait dari tabel 'proses_material'
        ProsesMaterial::whereHas('material', function ($query) use ($user, $ids) {
            $query->where('user_id', $user)->whereIn('id', explode(",", $ids));
        })->delete();
    
        // Hapus data dari tabel 'material'
        Material::where('user_id', $user)->whereIn('id', explode(",", $ids))->delete();
    
        return response()->json(['success' => "Deleted successfully."]);
    }    

    public function reset_material()
    {
        $user = Auth::id();
    
        // Menghapus data dari tabel 'proses_material' yang berelasi dengan pengguna
        ProsesMaterial::whereHas('material', function ($query) use ($user) {
            $query->where('user_id', $user);
        })->delete();
    
        // Menghapus data dari tabel 'material' yang dimiliki oleh pengguna
        Material::where('user_id', $user)->delete();
    
        return response()->json(['success' => "Deleted successfully."]);
    }
    
}
