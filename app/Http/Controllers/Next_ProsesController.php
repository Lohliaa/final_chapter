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
        $user = Auth::id();

        $searchTerm = $request->input('next_proses');

        $count = Next_Proses::count();

        $query = Next_Proses::query();

        $query->where('user_id', $user);

        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('jenis', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('carline', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('type', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('ctrl_no', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('kind', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('size', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('color', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('cl', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('term_b', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('accb1', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('accb2', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('tubeb', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('term_a', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('acca1', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('acca2', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('tubea', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('jenis_ctrl_no', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('ctrl_no_cct', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('kind_size_color', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('cust_part_no', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $count = $query->count();

        $next_proses = $query->paginate(5000);

        return view('next_proses.partial.next_proses', ['next_proses' => $next_proses, 'count' => $count, 'user' => $user]);
    }

    public function getCount(Request $request)
    {
        $user = Auth::id();

        $searchTerm = $request->input('next_proses');

        $query = Next_Proses::query();

        $query->where('user_id', $user);

        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('jenis', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('carline', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('type', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('ctrl_no', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('kind', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('size', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('color', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('cl', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('term_b', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('accb1', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('accb2', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('tubeb', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('term_a', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('acca1', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('acca2', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('tubea', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('jenis_ctrl_no', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('ctrl_no_cct', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('kind_size_color', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('cust_part_no', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $count = $query->count();

        return response()->json($count);
    }

    public function index(Request $request)
    {
        set_time_limit(0);
        $keyword = $request->cari;
        $user = Auth::id();

        $query = Next_Proses::where('user_id', $user)->orderBy('id', 'asc');

        if ($keyword) {
            $query->where('jenis', 'LIKE', '%' . $keyword . '%')
                ->orWhere('carline', 'LIKE', '%' . $keyword . '%')
                ->orWhere('type', 'LIKE', '%' . $keyword . '%')
                ->orWhere('ctrl_no', 'LIKE', '%' . $keyword . '%')
                ->orWhere('kind', 'LIKE', '%' . $keyword . '%')
                ->orWhere('size', 'LIKE', '%' . $keyword . '%')
                ->orWhere('color', 'LIKE', '%' . $keyword . '%')
                ->orWhere('cl', 'LIKE', '%' . $keyword . '%')
                ->orWhere('term_b', 'LIKE', '%' . $keyword . '%')
                ->orWhere('accb1', 'LIKE', '%' . $keyword . '%')
                ->orWhere('accb2', 'LIKE', '%' . $keyword . '%')
                ->orWhere('tubeb', 'LIKE', '%' . $keyword . '%')
                ->orWhere('term_a', 'LIKE', '%' . $keyword . '%')
                ->orWhere('acca1', 'LIKE', '%' . $keyword . '%')
                ->orWhere('acca2', 'LIKE', '%' . $keyword . '%')
                ->orWhere('tubea', 'LIKE', '%' . $keyword . '%')
                ->orWhere('jenis_ctrl_no', 'LIKE', '%' . $keyword . '%')
                ->orWhere('ctrl_no_cct', 'LIKE', '%' . $keyword . '%')
                ->orWhere('kind_size_color', 'LIKE', '%' . $keyword . '%')
                ->orWhere('cust_part_no', 'LIKE', '%' . $keyword . '%');
            $count = $query->count();
        } else {
            $count = $query->count();
        }

        $next_proses = $query->get();

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
