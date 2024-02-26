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
        $user = Auth::id();

        $searchTerm = $request->input('database_konversi');

        $count = DatabaseKonversi::count();

        $query = DatabaseKonversi::query();

        $query->where('user_id', $user);

        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->orWhere('part_no', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('buppin', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('part_name', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('uom', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('inner_packing', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $count = $query->count();

        $database_konversi = $query->paginate(5000);

        return view('database_konversi.partial.database_konversi', ['database_konversi' => $database_konversi, 'count' => $count, 'user' => $user]);
    }

    public function getCount(Request $request)
    {
        $user = Auth::id();

        $searchTerm = $request->input('database_konversi');

        $query = DatabaseKonversi::query();

        $query->where('user_id', $user);
        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->orWhere('part_no', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('buppin', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('part_name', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('uom', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('inner_packing', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $count = $query->count();

        $database_konversi = $query->paginate(8000);

        return response()->json($count);
    }

    public function index(Request $request)
    {
        set_time_limit(0);
        $keyword = $request->cari;
        $user = Auth::id();
        $query = DatabaseKonversi::where('user_id', $user)->orderBy('id', 'asc');
        
        if ($keyword) {
            $query->where('part_no', 'LIKE', '%' . $keyword . '%')
            ->orWhere('buppin', 'LIKE', '%' . $keyword . '%')
            ->orWhere('part_name', 'LIKE', '%' . $keyword . '%')
            ->orWhere('uom', 'LIKE', '%' . $keyword . '%')
            ->orWhere('inner_packing', 'LIKE', '%' . $keyword . '%');

            $count = $query->count();
        } else {
            $count = $query->count();
        }

        $database_konversi = $query->get();

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
