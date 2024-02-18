<?php

namespace App\Http\Controllers;

use App\Imports\MasterPriceImport;
use App\Exports\MasterPriceExport;
use App\Models\MasterPrice;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Validators\ValidationException;

class MasterPriceController extends Controller
{

    public function search(Request $request)
    {
        $keyword = $request->search;
        $user = Auth::id();

        $master_price = MasterPrice::where('user_id', $user)
        ->where(function ($query) use ($keyword) {
            $query->where('part_number_ori_sto', 'like', "%{$keyword}%")
                ->orWhere('part_number_mpl', 'like', "%{$keyword}%")
                ->orWhere('buppin', 'like', "%{$keyword}%")
                ->orWhere('price_per_pcs', 'like', "%{$keyword}%");
        })->paginate(10000);
        $count = $master_price->count();
        $countPartNumb = $master_price->where('part_number_ori_sto', 'like', "%{$keyword}%")->count();
        $countNumbmpl = $master_price->where('part_number_mpl', 'like', "%{$keyword}%")->count();
        $countBuppin = $master_price->where('buppin', 'like', "%{$keyword}%")->count();
        $countPrice = $master_price->where('price_per_pcs', 'like', "%{$keyword}%")->count();
        return view('master_price.index', compact('master_price', 'count'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        set_time_limit(0);
        $keyword = $request->pilih;
        $user = Auth::id();
        $master_price = MasterPrice::where('user_id', $user)->orderBy('id', 'asc')->paginate(10000);
        $count = $master_price->count();
        $data = $master_price->all();
        return view('master_price.index', compact('master_price', 'count', 'data'));
    }

    public function export_excel_mp()
    {
        return Excel::download(new MasterPriceExport, 'master_price.xlsx');
    }

    public function import_excel_mp(Request $request)
    {
        set_time_limit(0);
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        $nama_file = rand() . $file->getClientOriginalName();

        $path = $file->storeAs('public/excel/', $nama_file);

        $import = Excel::queueimport(new MasterPriceImport(), storage_path('app/public/excel/' . $nama_file));

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
        return view('master_price.create');
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
            'part_number_ori_sto' => 'required',
            'part_number_mpl' => 'required',
            'buppin' => 'required',
            'price_per_pcs' => 'required',
        ]);

        $user = Auth::id();

        $master_price = MasterPrice::create([
            'part_number_ori_sto' => $request->part_number_ori_sto,
            'part_number_mpl' => $request->part_number_mpl,
            'buppin' => $request->buppin,
            'price_per_pcs' => $request->price_per_pcs,
            'user_id' => $user,
        ]);

        if ($master_price) {
            return redirect()->route('master_price.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return redirect()->route('master_price.index')->with(['error' => 'Data Gagal Disimpan!']);
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
        $master_price = MasterPrice::findOrFail($id);
        return view('master_price.edit', compact('master_price'));
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
            'part_number_ori_sto' => 'required',
            'part_number_mpl' => 'required',
            'buppin' => 'required',
            'price_per_pcs' => 'required',
        ]);
        $user = Auth::id();

        $master_price = MasterPrice::findOrFail($id);

        $master_price->update([
            'part_number_ori_sto' => $request->part_number_ori_sto,
            'part_number_mpl' => $request->part_number_mpl,
            'buppin' => $request->buppin,
            'price_per_pcs' => $request->price_per_pcs,
            'user_id' => $user,
        ]);

        if ($master_price) {
            return redirect()->route('master_price.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            return redirect()->route('master_price.index')->with(['error' => 'Data Gagal Diupdate!']);
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
        $masterPrice = MasterPrice::where('user_id', $user)->find($id);
        if (!$masterPrice) {
            return response()->json(['error' => 'Data not found.'], 404);
        }

        $masterPrice->delete();

        return response()->json(['success' => 'Deleted successfully.', 'tr' => 'tr_' . $id]);
    }

    /**
     * Delete multiple resources from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        $user = Auth::id();

        if (empty($ids)) {
            return response()->json(['error' => 'No items selected.'], 400);
        }
    
        $idArray = explode(",", $ids);
    
        $deleted = MasterPrice::where('user_id', $user)->whereIn('id', $idArray)->delete();
    
        if ($deleted) {
            return response()->json(['success' => 'Deleted successfully.']);
        } else {
            return response()->json(['error' => 'Failed to delete items.'], 500);
        }
    }
    public function reset_mp()
    {
        $user = Auth::id();
        MasterPrice::where('user_id', $user)->delete();
        return response()->json(['success' => "Deleted successfully."]);
    }
}
