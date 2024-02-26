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

        $user = Auth::id();

        $searchTerm = $request->input('fa_1c');

        $count = Fa_1C::count();

        $query = Fa_1C::query();

        $query->where('user_id', $user);

        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('ctrl_no', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('addressing_store', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('colour', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('qty_kbn', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('issue', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('total_qty', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('housing', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('conveyor', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('car_line', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('month', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('year', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('sai', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $count = $query->count();

        $fa_1c = $query->paginate(5000);

        return view('fa_1c.partial.fa_1c', ['fa_1c' => $fa_1c, 'count' => $count, 'user' => $user]);
    }


    public function getCount(Request $request)
    {
        $user = Auth::id();

        $searchTerm = $request->input('fa_1c');

        $query = Fa_1C::query();

        $query->where('user_id', $user);

        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('ctrl_no', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('addressing_store', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('colour', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('qty_kbn', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('issue', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('total_qty', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('housing', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('conveyor', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('car_line', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('month', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('year', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('sai', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $count = $query->count();

        $fa_1c = $query->paginate(8000);

        return response()->json($count);
    }

    public function index(Request $request)
    {
        set_time_limit(0);
        $keyword = $request->cari;
        $user = Auth::id();
        $query = Fa_1C::where('user_id', $user)->orderBy('id', 'asc');
       
        if ($keyword) {
            $query->where('ctrl_no', 'LIKE', '%' . $keyword . '%')
            ->orWhere('addressing_store', 'LIKE', '%' . $keyword . '%')
            ->orWhere('colour', 'LIKE', '%' . $keyword . '%')
            ->orWhere('qty_kbn', 'LIKE', '%' . $keyword . '%')
            ->orWhere('issue', 'LIKE', '%' . $keyword . '%')
            ->orWhere('total_qty', 'LIKE', '%' . $keyword . '%')
            ->orWhere('housing', 'LIKE', '%' . $keyword . '%')
            ->orWhere('conveyor', 'LIKE', '%' . $keyword . '%')
            ->orWhere('car_line', 'LIKE', '%' . $keyword . '%')
            ->orWhere('month', 'LIKE', '%' . $keyword . '%')
            ->orWhere('year', 'LIKE', '%' . $keyword . '%')
            ->orWhere('sai', 'LIKE', '%' . $keyword . '%');
            $count = $query->count();
        } else {
            $count = $query->count();
        }

        $fa_1c = $query->get();

        $data = $fa_1c->all();

        $fa_1c = $query->paginate(8000);

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
