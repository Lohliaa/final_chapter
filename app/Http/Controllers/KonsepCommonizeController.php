<?php

namespace App\Http\Controllers;

use App\Models\Konsep_Commonize;
use App\Imports\KonsepCommonizeImport;
use App\Exports\KonsepCommonizeExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Validators\ValidationException;

class KonsepCommonizeController extends Controller
{

    public function cari_konsep(Request $request)
    {
        $keyword = $request->cari_konsep;
        $user = Auth::id();

        $konsep_commonize = Konsep_Commonize::where('user_id', $user)
            ->where(function ($query) use ($keyword) {
                $query->where('ctrl_no', 'like', "%{$keyword}%")
                    ->orWhere('size_new', 'like', "%{$keyword}%")
                    ->orWhere('col_new', 'like', "%{$keyword}%")
                    ->orWhere('cl_28', 'like', "%{$keyword}%")
                    ->orWhere('acc_b1_new', 'like', "%{$keyword}%")
                    ->orWhere('acc_b2', 'like', "%{$keyword}%")
                    ->orWhere('tube_b_new', 'like', "%{$keyword}%")
                    ->orWhere('term_a_new', 'like', "%{$keyword}%")
                    ->orWhere('acc_a1_new', 'like', "%{$keyword}%")
                    ->orWhere('acc_a2', 'like', "%{$keyword}%")
                    ->orWhere('tube_a_new', 'like', "%{$keyword}%")
                    ->orWhere('term_b_new', 'like', "%{$keyword}%")
                    ->orWhere('kind_new', 'like', "%{$keyword}%");
            })->get();
        $count = $konsep_commonize->count();
        $countCtrlNo = $konsep_commonize->where('ctrl_no', 'like', "%{$keyword}%")->count();
        $countSize = $konsep_commonize->where('size_new', 'like', "%{$keyword}%")->count();
        $countCol = $konsep_commonize->where('col_new', 'like', "%{$keyword}%")->count();
        $countCl = $konsep_commonize->where('cl_28', 'like', "%{$keyword}%")->count();
        $countTermb = $konsep_commonize->where('term_b_new', 'like', "%{$keyword}%")->count();
        $countAccb1 = $konsep_commonize->where('acc_b1_new', 'like', "%{$keyword}%")->count();
        $countAccb2 = $konsep_commonize->where('acc_b2', 'like', "%{$keyword}%")->count();
        $countTubeb = $konsep_commonize->where('tube_b_new', 'like', "%{$keyword}%")->count();
        $countTerma = $konsep_commonize->where('term_a_new', 'like', "%{$keyword}%")->count();
        $countAcca1 = $konsep_commonize->where('acc_a1_new', 'like', "%{$keyword}%")->count();
        $countAcca2 = $konsep_commonize->where('acc_a2', 'like', "%{$keyword}%")->count();
        $countTubea = $konsep_commonize->where('tube_a_new', 'like', "%{$keyword}%")->count();
        $countKind = $konsep_commonize->where('kind_new', 'like', "%{$keyword}%")->count();
        return view('konsep_commonize.index', compact('konsep_commonize', 'count'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        set_time_limit(0);
        $keyword = $request->cari;
        $user = Auth::id();
        $konsep_commonize = Konsep_Commonize::where('user_id', $user)->orderBy('id', 'asc')->get();
        $count = $konsep_commonize->count();
        $data = $konsep_commonize->all();

        return view('konsep_commonize.index', compact('konsep_commonize', 'count', 'data'));
    }

    public function export_excel_kc()
    {
        return Excel::download(new KonsepCommonizeExport, 'Konsep_Commonize.xlsx');
    }

    public function import_excel_kc(Request $request)
    {
        set_time_limit(0);
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        $nama_file = rand() . $file->getClientOriginalName();

        $path = $file->storeAs('public/excel/', $nama_file);

        $import = Excel::import(new KonsepCommonizeImport(), storage_path('app/public/excel/' . $nama_file));

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
        return view('konsep_commonize.create');
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
            'ctrl_no' => 'required',
            'kind_new' => 'required',
            'size_new' => 'required',
            'col_new' => 'required',
            'cl_28' => 'required|integer',
            'term_b_new' => 'required',
            'acc_b1_new' => 'required',
            'acc_b2' => 'required',
            'tube_b_new' => 'required',
            'term_a_new' => 'required',
            'acc_a1_new' => 'required',
            'acc_a2' => 'required',
            'tube_a_new' => 'required',
        ]);
        $user = Auth::id();

        $konsep_commonize = Konsep_Commonize::create([
            'ctrl_no' => $request->ctrl_no,
            'kind_new' => $request->kind_new,
            'size_new' => $request->size_new,
            'col_new' => $request->col_new,
            'cl_28' => $request->cl_28,
            'term_b_new' => $request->term_b_new,
            'acc_b1_new' => $request->acc_b1_new,
            'acc_b2' => $request->acc_b2,
            'tube_b_new' => $request->tube_b_new,
            'term_a_new' => $request->term_a_new,
            'acc_a1_new' => $request->acc_a1_new,
            'acc_a2' => $request->acc_a2,
            'tube_a_new' => $request->tube_a_new,
            'user_id' => $user,
        ]);

        if ($konsep_commonize) {
            return redirect()->route('konsep_commonize.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return redirect()->route('konsep_commonize.index')->with(['error' => 'Data Gagal Disimpan!']);
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
        $konsep_commonize = Konsep_Commonize::findOrFail($id);
        return view('konsep_commonize.edit', compact('konsep_commonize'));
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
            'ctrl_no' => 'required',
            'kind_new' => 'required',
            'size_new' => 'required',
            'col_new' => 'required',
            'cl_28' => 'required|integer',
            'term_b_new' => 'required',
            'acc_b1_new' => 'required',
            'acc_b2' => 'required',
            'tube_b_new' => 'required',
            'term_a_new' => 'required',
            'acc_a1_new' => 'required',
            'acc_a2' => 'required',
            'tube_a_new' => 'required',
        ]);
        $user = Auth::id();

        $konsep_commonize = Konsep_Commonize::findOrFail($id);

        $konsep_commonize->update([
            'ctrl_no' => $request->ctrl_no,
            'kind_new' => $request->kind_new,
            'size_new' => $request->size_new,
            'col_new' => $request->col_new,
            'cl_28' => $request->cl_28,
            'term_b_new' => $request->term_b_new,
            'acc_b1_new' => $request->acc_b1_new,
            'acc_b2' => $request->acc_b2,
            'tube_b_new' => $request->tube_b_new,
            'term_a_new' => $request->term_a_new,
            'acc_a1_new' => $request->acc_a1_new,
            'acc_a2' => $request->acc_a2,
            'tube_a_new' => $request->tube_a_new,
            'user_id' => $user,
        ]);

        if ($konsep_commonize) {
            return redirect()->route('konsep_commonize.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            return redirect()->route('konsep_commonize.index')->with(['error' => 'Data Gagal Diupdate!']);
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

        Konsep_Commonize::where('user_id', $user)->delete($id);
        return response()->json(['success' => " Deleted successfully.", 'tr' => 'tr_' . $id]);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteAll_konsep(Request $request)
    {
        $ids = $request->ids;
        $user = Auth::id();

        Konsep_Commonize::where('user_id', $user)->whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => " Deleted successfully."]);
    }

    public function reset_kc()
    {
        $user = Auth::id();
        Konsep_Commonize::where('user_id', $user)->delete();
        return response()->json(['success' => "Deleted successfully."]);
    }
}
