<?php

namespace App\Http\Controllers;

use App\Models\Fa_1C;
use App\Models\Next_Proses;
use App\Models\Konsep_Commonize;
use App\Models\Item_List;
use App\Models\Proses;
use App\Imports\FA_1CImport;
use App\Exports\FA_1CExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FA_1CController extends Controller
{

    public function cari_fa(Request $request)
    {
        $keyword = $request->cari_fa;
        $user = Auth::id();

        $fa_1c = Fa_1C::where('user_id', $user)
            ->where(function ($query) use ($keyword) {
                $query->where('ctrl_no', 'like', "%{$keyword}%")
                    ->orWhere('addressing_store', 'like', "%{$keyword}%")
                    ->orWhere('colour', 'like', "%{$keyword}%")
                    ->orWhere('qty_kbn', 'like', "%{$keyword}%")
                    ->orWhere('issue', 'like', "%{$keyword}%")
                    ->orWhere('total_qty', 'like', "%{$keyword}%")
                    ->orWhere('housing', 'like', "%{$keyword}%")
                    ->orWhere('conveyor', 'like', "%{$keyword}%")
                    ->orWhere('car_line', 'like', "%{$keyword}%")
                    ->orWhere('month', 'like', "%{$keyword}%")
                    ->orWhere('year', 'like', "%{$keyword}%")
                    ->orWhere('sai', 'like', "%{$keyword}%");
            })->get();

        $count = $fa_1c->count();
        $countCtrlNo = $fa_1c->where('ctrl_no', 'like', "%{$keyword}%")->count();
        $countConveyor = $fa_1c->where('conveyor', 'like', "%{$keyword}%")->count();
        $countCarLine = $fa_1c->where('car_line', 'like', "%{$keyword}%")->count();
        $countAS = $fa_1c->where('addressing_store', 'like', "%{$keyword}%")->count();
        $countColour = $fa_1c->where('colour', 'like', "%{$keyword}%")->count();
        $countKbn = $fa_1c->where('qty_kbn', 'like', "%{$keyword}%")->count();
        $countIssue = $fa_1c->where('issue', 'like', "%{$keyword}%")->count();
        $countTotal = $fa_1c->where('total_qty', 'like', "%{$keyword}%")->count();
        $countHousing = $fa_1c->where('housing', 'like', "%{$keyword}%")->count();
        $countMonth = $fa_1c->where('month', 'like', "%{$keyword}%")->count();
        $countYear = $fa_1c->where('year', 'like', "%{$keyword}%")->count();
        $countSai = $fa_1c->where('sai', 'like', "%{$keyword}%")->count();
        return view('fa_1c.index', compact('fa_1c', 'count'));
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
        $fa_1c = Fa_1C::where('user_id', $user)->orderBy('id', 'asc')->get();
        $count = $fa_1c->count();
        $data = $fa_1c->all();

        return view('fa_1c.index', compact('fa_1c', 'count', 'data'));
    }

    public function export_excel_fa()
    {
        return Excel::download(new FA_1CExport, 'FA.xlsx');
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

        $import = Excel::import(new FA_1CImport(), storage_path('app/public/excel/' . $nama_file));

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
        return view('fa_1c.create');
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
            'conveyor' => 'required',
            'addressing_store' => 'required',
            'ctrl_no' => 'required',
            'colour' => 'required',
            'qty_kbn' => 'required',
            'issue' => 'required',
            'total_qty' => 'required',
            'housing' => 'required',
            'month' => 'required',
            'year' => 'required',
            'sai' => 'required',
        ]);

        $user = Auth::id();

        $fa_1c = Fa_1C::create([
            'car_line' => $request->car_line,
            'conveyor' => $request->conveyor,
            'addressing_store' => $request->addressing_store,
            'ctrl_no' => $request->ctrl_no,
            'colour' => $request->colour,
            'qty_kbn' => $request->qty_kbn,
            'issue' => $request->issue,
            'total_qty' => $request->total_qty,
            'housing' => $request->housing,
            'month' => $request->month,
            'year' => $request->year,
            'sai' => $request->sai,
            'user_id' => $user,
        ]);

        if ($fa_1c) {
            return redirect()->route('data-fa-841w.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return redirect()->route('data-fa-841w.index')->with(['error' => 'Data Gagal Disimpan!']);
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
        $fa_1c = Fa_1C::find($id);
        return view('fa_1c.edit', compact('fa_1c'));
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
            'conveyor' => 'required',
            'addressing_store' => 'required',
            'ctrl_no' => 'required',
            'colour' => 'required',
            'qty_kbn' => 'required',
            'issue' => 'required',
            'total_qty' => 'required',
            'housing' => 'required',
            'month' => 'required',
            'year' => 'required',
            'sai' => 'required',
        ]);
        $user = Auth::id();

        $fa_1c = Fa_1C::findOrFail($id);

        $fa_1c->update([
            'car_line' => $request->car_line,
            'conveyor' => $request->conveyor,
            'addressing_store' => $request->addressing_store,
            'ctrl_no' => $request->ctrl_no,
            'colour' => $request->colour,
            'qty_kbn' => $request->qty_kbn,
            'issue' => $request->issue,
            'total_qty' => $request->total_qty,
            'housing' => $request->housing,
            'month' => $request->month,
            'year' => $request->year,
            'sai' => $request->sai,
            'user_id' => $user,
        ]);

        if ($fa_1c) {
            return redirect()->route('data-fa-841w.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            return redirect()->route('data-fa-841w.index')->with(['error' => 'Data Gagal Diupdate!']);
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

        Fa_1C::where('user_id', $user)->delete($id);
        return response()->json(['success' => " Deleted successfully.", 'tr' => 'tr_' . $id]);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteAll_fa(Request $request)
    {
        $ids = $request->ids;
        $user = Auth::id();

        Fa_1C::where('user_id', $user)->whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => " Deleted successfully."]);
    }
    public function reset_fa()
    {
        $user = Auth::id();
        Fa_1C::where('user_id', $user)->delete();
        Proses::where('user_id', $user)->delete();
        return response()->json(['success' => "Deleted successfully."]);
    }
}
