<?php

namespace App\Http\Controllers;

use App\Models\Item_List;
use App\Imports\ItemListImport;
use App\Exports\ItemListExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Validators\ValidationException;

class Item_ListController extends Controller
{

    public function cari(Request $request)
    {
        $keyword = $request->cari;
        $user = Auth::id();

        $item_list = Item_List::where('user_id', $user)
        ->where(function ($query) use ($keyword) {
            $query->where('part_no', 'like', "%{$keyword}%")
                ->orWhere('cust_pno', 'like', "%{$keyword}%")
                ->orWhere('part_name', 'like', "%{$keyword}%");
        })->paginate(8000);
        $count = $item_list->count();
        $countPartNo = $item_list->where('part_no', 'like', "%{$keyword}%")->count();
        $countCustPno = $item_list->where('cust_pno', 'like', "%{$keyword}%")->count();
        $countPartName = $item_list->where('part_name', 'like', "%{$keyword}%")->count();
        return view('item_list.index', compact('item_list', 'count'));
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
        $item_list = Item_List::where('user_id', $user)->orderBy('id', 'asc')->paginate(8000);
        $count = $item_list->count();
        $data = $item_list->all();  
        return view('item_list.index', compact('item_list', 'count', 'data'));
    }

    public function export_excel_il()
    {
        return Excel::download(new ItemListExport, 'Item_List.xlsx');
    }

    public function import_excel_il(Request $request)
    {
        set_time_limit(0);
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        $nama_file = rand() . $file->getClientOriginalName();

        $path = $file->storeAs('public/excel/', $nama_file);

        $import = Excel::import(new ItemListImport(), storage_path('app/public/excel/' . $nama_file));

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
        return view('item_list.create');
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
            'cust_pno' => 'required',
            'part_name' => 'required',
        ]);
        $user = Auth::id();

        $item_list = Item_List::create([
            'part_no' => $request->part_no,
            'cust_pno' => $request->cust_pno,
            'part_name' => $request->part_name,
            'user_id' => $user,
        ]);

        if ($item_list) {
            return redirect()->route('item_list.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return redirect()->route('item_list.index')->with(['error' => 'Data Gagal Disimpan!']);
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
        $item_list = Item_List::findOrFail($id);
        return view('item_list.edit', compact('item_list'));
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
            'cust_pno' => 'required',
            'part_name' => 'required',
        ]);
        $user = Auth::id();

        $item_list = Item_List::findOrFail($id);

        $item_list->update([
            'part_no' => $request->part_no,
            'cust_pno' => $request->cust_pno,
            'part_name' => $request->part_name,
            'user_id' => $user,
        ]);

        if ($item_list) {
            return redirect()->route('item_list.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            return redirect()->route('item_list.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function destroy($id)
    {
        $user = Auth::id();
        $item_list = Item_List::where('user_id', $user)->find($id);

        if (!$item_list) {
            return response()->json(['error' => 'Data not found.'], 404);
        }

        $item_list->delete();

        return response()->json(['success' => 'Deleted successfully.', 'tr' => 'tr_' . $id]);
    }

    /**
     * Delete multiple resources from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteAll_Item_List(Request $request)
    {
        $ids = $request->ids;
        $user = Auth::id();

        if (empty($ids)) {
            return response()->json(['error' => 'No items selected.'], 400);
        }
    
        $idArray = explode(",", $ids);
        $batchSize = 1000; // Ukuran batch yang Anda inginkan
    
        while (!empty($idArray)) {
            $batchIds = array_splice($idArray, 0, $batchSize);
    
            try {
                // Hapus data dalam batch
                $deleted = Item_List::where('user_id', $user)->whereIn('id', $batchIds)->delete();
    
                if (!$deleted) {
                    // Handle jika batch gagal dihapus
                    return response()->json(['error' => 'Failed to delete items.'], 500);
                }
            } catch (\Exception $e) {
                // Tangani kesalahan jika ada
                return response()->json(['error' => 'An error occurred during batch deletion.'], 500);
            }
        }
    
        return response()->json(['success' => 'Deleted successfully.']);
    }

    public function reset_il()
    {
        $user = Auth::id();
        Item_List::where('user_id', $user)->delete();
        return response()->json(['success' => "Deleted successfully."]);
    }

}
