<?php

namespace App\Http\Controllers;

use App\Exports\DatabaseKonversiExport;
use App\Imports\DatabaseKonversiImport;
use App\Models\DatabaseKonversi;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Validators\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class KonversiController extends Controller
{
    public function cari_dk(Request $request)
    {
        $keyword = $request->cari_dk;
        $user = Auth::id();

        $database_konversi = DatabaseKonversi::where('user_id', $user)
        ->where(function ($query) use ($keyword) {
            $query->orWhere('part_no', 'like', "%{$keyword}%")
                ->orWhere('buppin', 'like', "%{$keyword}%")
                ->orWhere('part_name', 'like', "%{$keyword}%")
                ->orWhere('uom', 'like', "%{$keyword}%")
                ->orWhere('inner_packing', 'like', "%{$keyword}%");
        })->get();
        
        $count = $database_konversi->count();
        $countPartNo = $database_konversi->where('part_no', 'like', "%{$keyword}%")->count();
        $countBuppin = $database_konversi->where('buppin', 'like', "%{$keyword}%")->count();
        $countPartName = $database_konversi->where('part_name', 'like', "%{$keyword}%")->count();
        $countUOM = $database_konversi->where('uom', 'like', "%{$keyword}%")->count();
        $countInner = $database_konversi->where('inner_packing', 'like', "%{$keyword}%")->count();
        
        return view('database_konversi.index', compact('database_konversi', 'count'));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->cari;
        $user = Auth::id();
        $database_konversi = DatabaseKonversi::where('user_id', $user)->orderBy('id', 'asc')->get();
        $count = $database_konversi->count();
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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('database_konversi.create');
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
            'part_no' => 'required',
            'buppin' => 'required',
            'part_name' => 'required',
            'uom' => 'required',
            'inner_packing' => 'required',
        ]);

        $user = Auth::id();

        $database_konversi = DatabaseKonversi::create([
            'part_no' => $request->part_no,
            'buppin' => $request->buppin,
            'part_name' => $request->part_name,
            'uom' => $request->uom,
            'inner_packing' => $request->inner_packing,
            'user_id' => $user,
        ]);

        if ($database_konversi) {
            return redirect()->route('database_konversi.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return redirect()->route('database_konversi.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        $database_konversi = DatabaseKonversi::findOrFail($id);
        return view('database_konversi.edit', compact('database_konversi'));
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
            'part_no' => 'required',
            'buppin' => 'required',
            'part_name' => 'required',
            'uom' => 'required',
            'inner_packing' => 'required',
        ]);
        $user = Auth::id();

        $database_konversi = DatabaseKonversi::findOrFail($id);

        $database_konversi->update([
            'part_no' => $request->part_no,
            'buppin' => $request->buppin,
            'part_name' => $request->part_name,
            'uom' => $request->uom,
            'inner_packing' => $request->inner_packing,
            'user_id' => $user,
        ]);

        if ($database_konversi) {
            return redirect()->route('database_konversi.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            return redirect()->route('database_konversi.index')->with(['error' => 'Data Gagal Diupdate!']);
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

        DatabaseKonversi::where('user_id', $user)->delete($id);
        return response()->json(['success' => " Deleted successfully.", 'tr' => 'tr_' . $id]);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
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
