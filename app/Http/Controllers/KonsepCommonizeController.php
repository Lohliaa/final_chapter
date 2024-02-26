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
        $user = Auth::id();

        $searchTerm = $request->input('konsep_commonize');

        $count = Konsep_Commonize::count();

        $query = Konsep_Commonize::query();

        $query->where('user_id', $user);

        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('ctrl_no', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('kind_new', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('size_new', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('col_new', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('cl_28', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('term_b_new', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('acc_b1_new', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('acc_b2', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('tube_b_new', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('term_a_new', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('acc_a1_new', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('acc_a2', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('tube_a_new', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $count = $query->count();

        $konsep_commonize = $query->paginate(5000);

        return view('konsep_commonize.partial.konsep_commonize', ['konsep_commonize' => $konsep_commonize, 'count' => $count, 'user' => $user]);
    }

    public function getCount(Request $request)
    {
        $user = Auth::id();

        $searchTerm = $request->input('konsep_commonize');

        $query = Konsep_Commonize::query();

        $query->where('user_id', $user);

        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('ctrl_no', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('kind_new', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('size_new', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('col_new', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('cl_28', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('term_b_new', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('acc_b1_new', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('acc_b2', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('tube_b_new', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('term_a_new', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('acc_a1_new', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('acc_a2', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('tube_a_new', 'LIKE', '%' . $searchTerm . '%');
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

        $query = Konsep_Commonize::where('user_id', $user)->orderBy('id', 'asc');

        if ($keyword) {
            $query->where('ctrl_no', 'LIKE', '%' . $keyword . '%')
                ->orWhere('kind_new', 'LIKE', '%' . $keyword . '%')
                ->orWhere('size_new', 'LIKE', '%' . $keyword . '%')
                ->orWhere('col_new', 'LIKE', '%' . $keyword . '%')
                ->orWhere('cl_28', 'LIKE', '%' . $keyword . '%')
                ->orWhere('term_b_new', 'LIKE', '%' . $keyword . '%')
                ->orWhere('acc_b1_new', 'LIKE', '%' . $keyword . '%')
                ->orWhere('acc_b2', 'LIKE', '%' . $keyword . '%')
                ->orWhere('tube_b_new', 'LIKE', '%' . $keyword . '%')
                ->orWhere('term_a_new', 'LIKE', '%' . $keyword . '%')
                ->orWhere('acc_a1_new', 'LIKE', '%' . $keyword . '%')
                ->orWhere('acc_a2', 'LIKE', '%' . $keyword . '%')
                ->orWhere('tube_a_new', 'LIKE', '%' . $keyword . '%');
            $count = $query->count();
        } else {
            $count = $query->count();
        }

        $konsep_commonize = $query->get();

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
