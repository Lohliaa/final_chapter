<?php

namespace App\Http\Controllers;

use App\Models\Next_Proses;
use App\Imports\Next_ProsesImport;
use App\Exports\Next_ProsesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Validators\ValidationException;
use Maatwebsite\Excel\Validators\Row;
use Illuminate\Support\MessageBag;

class Next_ProsesController extends Controller
{

    public function cari_next_proses(Request $request)
    {
        $keyword = $request->cari_next_proses;
        $user = Auth::id();

        $next_proses = Next_Proses::where('user_id', $user)
        ->where(function ($query) use ($keyword) {
            $query->where('jenis', 'like', "%{$keyword}%")
                ->orWhere('carline', 'like', "%{$keyword}%")
                ->orWhere('type', 'like', "%{$keyword}%")
                ->orWhere('ctrl_no', 'like', "%{$keyword}%")
                ->orWhere('kind', 'like', "%{$keyword}%")
                ->orWhere('size', 'like', "%{$keyword}%")
                ->orWhere('color', 'like', "%{$keyword}%")
                ->orWhere('cl', 'like', "%{$keyword}%")
                ->orWhere('term_b', 'like', "%{$keyword}%")
                ->orWhere('accb1', 'like', "%{$keyword}%")
                ->orWhere('accb2', 'like', "%{$keyword}%")
                ->orWhere('tubeb', 'like', "%{$keyword}%")
                ->orWhere('term_a', 'like', "%{$keyword}%")
                ->orWhere('acca1', 'like', "%{$keyword}%")
                ->orWhere('acca2', 'like', "%{$keyword}%")
                ->orWhere('tubea', 'like', "%{$keyword}%")
                ->orWhere('jenis_ctrl_no', 'like', "%{$keyword}%")
                ->orWhere('ctrl_no_cct', 'like', "%{$keyword}%")
                ->orWhere('kind_size_color', 'like', "%{$keyword}%")
                ->orWhere('cust_part_no', 'like', "%{$keyword}%");
        })->paginate(10000);
        $count = $next_proses->count();
        $countJenis = $next_proses->where('jenis', 'like', "%{$keyword}%")->count();
        $countCarline = $next_proses->where('carline', 'like', "%{$keyword}%")->count();
        $countType = $next_proses->where('type', 'like', "%{$keyword}%")->count();
        $countCtrlno = $next_proses->where('ctrl_no', 'like', "%{$keyword}%")->count();
        $countKind = $next_proses->where('kind', 'like', "%{$keyword}%")->count();
        $countSize = $next_proses->where('size', 'like', "%{$keyword}%")->count();
        $countColor = $next_proses->where('color', 'like', "%{$keyword}%")->count();
        $countCl = $next_proses->where('cl', 'like', "%{$keyword}%")->count();
        $countTermb = $next_proses->where('term_b', 'like', "%{$keyword}%")->count();
        $countAccb1 = $next_proses->where('accb1', 'like', "%{$keyword}%")->count();
        $countAccb2 = $next_proses->where('accb2', 'like', "%{$keyword}%")->count();
        $countTubeb = $next_proses->where('tubeb', 'like', "%{$keyword}%")->count();
        $countTerma = $next_proses->where('term_a', 'like', "%{$keyword}%")->count();
        $countAcca1 = $next_proses->where('acca1', 'like', "%{$keyword}%")->count();
        $countAcca2 = $next_proses->where('acca2', 'like', "%{$keyword}%")->count();
        $countTubea = $next_proses->where('tubea', 'like', "%{$keyword}%")->count();
        $countJctrl = $next_proses->where('jenis_ctrl_no', 'like', "%{$keyword}%")->count();
        $countCtrl = $next_proses->where('ctrl_no_cct', 'like', "%{$keyword}%")->count();
        $countKind = $next_proses->where('kind_size_color', 'like', "%{$keyword}%")->count();
        $countCust = $next_proses->where('cust_part_no', 'like', "%{$keyword}%")->count();
        return view('next_proses.index', compact('next_proses', 'count'));
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
        $next_proses = Next_Proses::where('user_id', $user)->orderBy('id', 'asc')->paginate(10000);
        $count = $next_proses->count();
        $data = $next_proses->all();
        return view('next_proses.index', compact('next_proses', 'count', 'data'));
    }

    public function export_excel_np()
    {
        return Excel::download(new Next_ProsesExport, 'Next_Proses.xlsx');
    }

    public function import_excel_np(Request $request)
    {
        set_time_limit(0);
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        $nama_file = rand() . $file->getClientOriginalName();

        $path = $file->storeAs('public/excel/', $nama_file);

        $import = Excel::import(new Next_ProsesImport(), storage_path('app/public/excel/' . $nama_file));

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
        return view('next_proses.create');
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
            'carline' => 'required',
            'type' => 'required',
            'jenis' => 'required',
            'ctrl_no' => 'required',
            'jenis_ctrl_no' => 'required',
            'ctrl_no_cct' => 'required',
            'kind' => 'required',
            'size' => 'required',
            'color' => 'required',
            'kind_size_color' => 'required',
            'cust_part_no' => 'required',
            'cl' => 'required|integer',
            'term_b' => 'required',
            'accb1' => 'required',
            'accb2' => 'required',
            'tubeb' => 'required',
            'term_a' => 'required',
            'acca1' => 'required',
            'acca2' => 'required',
            'tubea' => 'required',
        ]);
        $user = Auth::id();

        $next_proses = Next_Proses::create([
            'carline' => $request->carline,
            'type' => $request->type,
            'jenis' => $request->jenis,
            'ctrl_no' => $request->ctrl_no,
            'jenis_ctrl_no' => $request->jenis_ctrl_no,
            'ctrl_no_cct' => $request->ctrl_no_cct,
            'kind' => $request->kind,
            'size' => $request->size,
            'color' => $request->color,
            'kind_size_color' => $request->kind_size_color,
            'cust_part_no' => $request->cust_part_no,
            'cl' => $request->cl,
            'term_b' => $request->term_b,
            'accb1' => $request->accb1,
            'accb2' => $request->accb2,
            'tubeb' => $request->tubeb,
            'term_a' => $request->term_a,
            'acca1' => $request->acca1,
            'acca2' => $request->acca2,
            'tubea' => $request->tubea,
            'user_id' => $user,
        ]);

        if ($next_proses) {
            return redirect()->route('next_proses.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return redirect()->route('next_proses.index')->with(['error' => 'Data Gagal Disimpan!']);
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
        $next_proses = Next_Proses::findOrFail($id);
        return view('next_proses.edit', compact('next_proses'));
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
            'carline' => 'required',
            'type' => 'required',
            'jenis' => 'required',
            'ctrl_no' => 'required',
            'jenis_ctrl_no' => 'required',
            'ctrl_no_cct' => 'required',
            'kind' => 'required',
            'size' => 'required',
            'color' => 'required',
            'kind_size_color' => 'required',
            'cust_part_no' => 'required',
            'cl' => 'required|integer',
            'term_b' => 'required',
            'accb1' => 'required',
            'accb2' => 'required',
            'tubeb' => 'required',
            'term_a' => 'required',
            'acca1' => 'required',
            'acca2' => 'required',
            'tubea' => 'required',
        ]);
        $user = Auth::id();

        $next_proses = Next_Proses::findOrFail($id);

        $next_proses->update([
            'carline' => $request->carline,
            'type' => $request->type,
            'jenis' => $request->jenis,
            'ctrl_no' => $request->ctrl_no,
            'jenis_ctrl_no' => $request->jenis_ctrl_no,
            'ctrl_no_cct' => $request->ctrl_no_cct,
            'kind' => $request->kind,
            'size' => $request->size,
            'color' => $request->color,
            'kind_size_color' => $request->kind_size_color,
            'cust_part_no' => $request->cust_part_no,
            'cl' => $request->cl,
            'term_b' => $request->term_b,
            'accb1' => $request->accb1,
            'accb2' => $request->accb2,
            'tubeb' => $request->tubeb,
            'term_a' => $request->term_a,
            'acca1' => $request->acca1,
            'acca2' => $request->acca2,
            'tubea' => $request->tubea,
            'user_id' => $user,
        ]);

        if ($next_proses) {
            return redirect()->route('next_proses.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            return redirect()->route('next_proses.index')->with(['error' => 'Data Gagal Diupdate!']);
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

        Next_Proses::where('user_id', $user)->delete($id);
        return response()->json(['success' => " Deleted successfully.", 'tr' => 'tr_' . $id]);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteAll_Next_Proses(Request $request)
    {
        $ids = $request->ids;
        $user = Auth::id();

        Next_Proses::where('user_id', $user)->whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => " Deleted successfully."]);
    }

    public function reset_np()
    {
        $user = Auth::id();
        Next_Proses::where('user_id', $user)->delete();
        return response()->json(['success' => "Deleted successfully."]);
    }
}
