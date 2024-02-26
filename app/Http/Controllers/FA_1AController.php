<?php

namespace App\Http\Controllers;

use App\Models\Fa_1A;
use App\Models\Next_Proses;
use App\Models\Konsep_Commonize;
use App\Models\Item_List;
use App\Models\Proses;
use App\Imports\FA_1AImport;
use App\Exports\FA_1AExport;
use App\Models\Fa_1C;
use App\Models\ProsesFa_1A;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FA_1AController extends Controller
{

    public function cari_pa(Request $request)
    {
       
        $user = Auth::id();

        $searchTerm = $request->input('fa_1a');

        
        $count = Fa_1A::count();

        $query = Fa_1A::query();

        $query->where('user_id', $user);

        if($searchTerm){
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

        $fa_1a = $query->paginate(5000);

        return view('fa_1a.partial.fa_1a', ['fa_1a' => $fa_1a, 'count' => $count, 'user' => $user]);
    }

    
    public function getCount(Request $request)
    {
        $user = Auth::id();

        $searchTerm = $request->input('fa_1a');

        $query = Fa_1A::query();

        $query->where('user_id', $user);
        
        if($searchTerm){
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

        $item_list = $query->paginate(8000);

        return response()->json($count);
    }

    public function index(Request $request)
    {
        set_time_limit(0);
        $keyword = $request->cari;
        $user = Auth::id();
        $query = Fa_1A::where('user_id', $user)->orderBy('id', 'asc');

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

        $fa_1a = $query->get();

        $data = $fa_1a->all();

        $fa_1a = $query->paginate(8000);

        return view('fa_1a.index', compact('fa_1a', 'count', 'data'));
    }

    public function export_excel_pa()
    {
        return Excel::download(new FA_1AExport, 'PA.xlsx');
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

        $import = Excel::import(new FA_1AImport(), storage_path('app/public/excel/' . $nama_file));

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
        return view('fa_1a.create');
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

        $fa_1a = Fa_1A::create([
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

        if ($fa_1a) {
            return redirect()->route('data-pa-841w.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return redirect()->route('data-pa-841w.index')->with(['error' => 'Data Gagal Disimpan!']);
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
        $fa_1a = Fa_1A::find($id);
        return view('fa_1a.edit', compact('fa_1a'));
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

        $fa_1a = Fa_1A::findOrFail($id);

        $fa_1a->update([
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

        if ($fa_1a) {
            return redirect()->route('data-pa-841w.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            return redirect()->route('data-pa-841w.index')->with(['error' => 'Data Gagal Diupdate!']);
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

        Fa_1A::where('user_id', $user)->delete($id);
        return response()->json(['success' => " Deleted successfully.", 'tr' => 'tr_' . $id]);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteAll_pa(Request $request)
    {
        $ids = $request->ids;
        $user = Auth::id();

        Fa_1A::where('user_id', $user)->whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => " Deleted successfully."]);
    }
    public function reset_pa()
    {
        $user = Auth::id();
        Fa_1A::where('user_id', $user)->delete();
        ProsesFa_1A::where('user_id', $user)->delete();
        return response()->json(['success' => "Deleted successfully."]);
    }
}
