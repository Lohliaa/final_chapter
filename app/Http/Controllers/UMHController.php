<?php

namespace App\Http\Controllers;

use App\Exports\UMHExport;
use App\Imports\UMHImport;
use App\Models\UMH_Master;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Validators\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class UMHController extends Controller
{
    public function cari_umh(Request $request)
    {
        $keyword = $request->cari_umh;
        $user = Auth::id();

        $umh_master = UMH_Master::where('user_id', $user)
        ->where(function ($query) use ($keyword) {
            $query->orWhere('car_line', 'like', "%{$keyword}%")
                ->orWhere('code_umh1', 'like', "%{$keyword}%")
                ->orWhere('code_umh2', 'like', "%{$keyword}%")
                ->orWhere('code_umh3', 'like', "%{$keyword}%")
                ->orWhere('kode_umh1', 'like', "%{$keyword}%")
                ->orWhere('kode_umh2', 'like', "%{$keyword}%")
                ->orWhere('kode_umh3', 'like', "%{$keyword}%");
        })->get();
        
        $count = $umh_master->count();
        $countCarline = $umh_master->where('car_line', 'like', "%{$keyword}%")->count();
        $countCode1 = $umh_master->where('code_umh1', 'like', "%{$keyword}%")->count();
        $countCode2 = $umh_master->where('code_umh2', 'like', "%{$keyword}%")->count();
        $countCode3 = $umh_master->where('code_umh3', 'like', "%{$keyword}%")->count();
        $countKode1 = $umh_master->where('kode_umh1', 'like', "%{$keyword}%")->count();
        $countKode2 = $umh_master->where('kode_umh2', 'like', "%{$keyword}%")->count();
        $countKode3 = $umh_master->where('kode_umh3', 'like', "%{$keyword}%")->count();
        
        return view('umh_master.index', compact('umh_master', 'count'));
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
        $umh_master = UMH_Master::where('user_id', $user)->orderBy('id', 'asc')->get();
        $count = $umh_master->count();
        $data = $umh_master->all();

        $totalKodeUMH1 = 0;
        $totalKodeUMH2 = 0;
        $totalKodeUMH3 = 0;

        foreach ($data as $umh) {
            $totalKodeUMH1 += $umh->code_umh1;

            $totalKodeUMH2 += $umh->code_umh1 + $umh->code_umh2;

            $totalKodeUMH3 += $umh->code_umh1 + $umh->code_umh2 + $umh->code_umh3;
        }

        return view('umh_master.index', compact('umh_master', 'count', 'data', 'totalKodeUMH1', 'totalKodeUMH2', 'totalKodeUMH3'));
    }

    public function export_excel_umh()
    {
        return Excel::download(new UMHExport, 'UMH_Master.xlsx');
    }

    public function import_excel_umh(Request $request)
    {
        set_time_limit(0);
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        $nama_file = rand() . $file->getClientOriginalName();

        $path = $file->storeAs('public/excel/', $nama_file);

        $import = Excel::import(new UMHImport(), storage_path('app/public/excel/' . $nama_file));

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
        return view('umh_master.create');
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
            'car_line' => 'required',
            'code_umh1' => 'required',
            'code_umh2' => 'required',
            'code_umh3' => 'required',
            'kode_umh1' => 'required',
            'kode_umh2' => 'required',
            'kode_umh3' => 'required',
            'charge' => 'required',
        ]);

        $user = Auth::id();

        $umh_master = UMH_Master::create([
            'car_line' => $request->car_line,
            'code_umh1' => $request->code_umh1,
            'code_umh2' => $request->code_umh2,
            'code_umh3' => $request->code_umh3,
            'kode_umh1' => $request->kode_umh1,
            'kode_umh2' => $request->kode_umh2,
            'kode_umh3' => $request->kode_umh3,
            'charge' => $request->charge,
            'user_id' => $user,
        ]);

        if ($umh_master) {
            return redirect()->route('umh_master.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return redirect()->route('umh_master.index')->with(['error' => 'Data Gagal Disimpan!']);
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
        $umh_master = UMH_Master::findOrFail($id);
        return view('umh_master.edit', compact('umh_master'));
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
            'car_line' => 'required',
            'code_umh1' => 'required',
            'code_umh2' => 'required',
            'code_umh3' => 'required',
            'kode_umh1' => 'required',
            'kode_umh2' => 'required',
            'kode_umh3' => 'required',
            'charge' => 'required',
        ]);
        $user = Auth::id();

        $umh_master = UMH_Master::findOrFail($id);

        $umh_master->update([
            'car_line' => $request->car_line,
            'code_umh1' => $request->code_umh1,
            'code_umh2' => $request->code_umh2,
            'code_umh3' => $request->code_umh3,
            'kode_umh1' => $request->kode_umh1,
            'kode_umh2' => $request->kode_umh2,
            'kode_umh3' => $request->kode_umh3,
            'charge' => $request->charge,
            'user_id' => $user,
        ]);

        if ($umh_master) {
            return redirect()->route('umh_master.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            return redirect()->route('umh_master.index')->with(['error' => 'Data Gagal Diupdate!']);
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

        UMH_Master::where('user_id', $user)->delete($id);
        return response()->json(['success' => " Deleted successfully.", 'tr' => 'tr_' . $id]);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteAll_umh(Request $request)
    {
        $ids = $request->ids;
        $user = Auth::id();

        UMH_Master::where('user_id', $user)->whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => " Deleted successfully."]);
    }
    public function reset_umh()
    {
        $user = Auth::id();
        UMH_Master::where('user_id', $user)->delete();
        return response()->json(['success' => "Deleted successfully."]);
    }
}
