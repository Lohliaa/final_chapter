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
                    ->orWhere('carcode', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('area', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('cavity', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('partnumber', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('part_name', 'LIKE', '%' . $searchTerm . '%')
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
                    ->orWhere('carcode', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('area', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('cavity', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('partnumber', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('part_name', 'LIKE', '%' . $searchTerm . '%')
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
            ->orWhere('carcode', 'LIKE', '%' . $keyword . '%')
            ->orWhere('area', 'LIKE', '%' . $keyword . '%')
            ->orWhere('cavity', 'LIKE', '%' . $keyword . '%')
            ->orWhere('partnumber', 'LIKE', '%' . $keyword . '%')
            ->orWhere('part_name', 'LIKE', '%' . $keyword . '%')
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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('material.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'factory' => 'required',
            'carcode' => 'required',
            'area' => 'required',
            'cavity' => 'required',
            'partnumber' => 'required',
            'part_name' => 'required',
            'qty_total' => 'required',
        ]);

        $user = Auth::id();

        $material = Material::create([
            'factory' => $request->factory,
            'carcode' => $request->carcode,
            'area' => $request->area,
            'cavity' => $request->cavity,
            'partnumber' => $request->partnumber,
            'part_name' => $request->part_name,
            'qty_total' => $request->qty_total,
            'user_id' => $user,

        ]);

        if ($material) {
            return redirect()->route('material.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return redirect()->route('material.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $material = Material::find($id);
        return view('material.edit', compact('material'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'factory' => 'required',
            'carcode' => 'required',
            'area' => 'required',
            'cavity' => 'required',
            'partnumber' => 'required',
            'part_name' => 'required',
            'qty_total' => 'required',
        ]);
        $user = Auth::id();

        $material = Material::findOrFail($id);

        $material->update([
            'factory' => $request->factory,
            'carcode' => $request->carcode,
            'area' => $request->area,
            'cavity' => $request->cavity,
            'partnumber' => $request->partnumber,
            'part_name' => $request->part_name,
            'qty_total' => $request->qty_total,
            'user_id' => $user,

        ]);

        if ($material) {
            return redirect()->route('material.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            return redirect()->route('material.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::id();

        Material::where('user_id', $user)->delete($id);
        return response()->json(['success' => " Deleted successfully.", 'tr' => 'tr_' . $id]);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteAll_material(Request $request)
    {
        $ids = $request->ids;
        $user = Auth::id();

        Material::where('user_id', $user)->whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => " Deleted successfully."]);
    }
    public function reset_material()
    {
        $user = Auth::id();
        Material::where('user_id', $user)->delete();
        ProsesMaterial::where('user_id', $user)->delete();
        return response()->json(['success' => "Deleted successfully."]);
    }
}
