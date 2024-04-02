<?php

namespace App\Http\Controllers;

use App\Exports\ItemExport;
use App\Imports\ItemImport;
use App\Models\Item;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Validators\ValidationException;

class ItemController extends Controller
{

    public function cari(Request $request)
    {

        $user = Auth::id();

        $searchTerm = $request->input('item');

        $count = Item::count();

        $query = Item::query();

        $query->where('user_id', $user);

        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('component_number', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('specific_component_number', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('component_name', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $count = $query->count();

        $item = $query->paginate(5000);

        return view('item.partial.item', ['item' => $item, 'count' => $count, 'user' => $user]);
    }
  
    public function getCount(Request $request)
    {
        $user = Auth::id();

        $searchTerm = $request->input('item');

        $query = Item::query();

        $query->where('user_id', $user);

        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('component_number', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('specific_component_number', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('component_name', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $count = $query->count();

        $item = $query->paginate(8000);

        return response()->json($count);
    }
  
    public function index(Request $request)
    {
        set_time_limit(0);
        $keyword = $request->cari;
        $user = Auth::id();
        $query = Item::where('user_id', $user)->orderBy('id', 'asc');
        
        if ($keyword) {
            $query->where('component_number', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('specific_component_number', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('component_name', 'LIKE', '%' . $keyword . '%');
            $count = $query->count();
        } else {
            $count = $query->count();
        }

        $item = $query->get();

        $data = $item->all();

        $item = $query->paginate(8000);

        return view('item.index', compact('item', 'count', 'data'));
    }

    public function export_excel_il()
    {
        return Excel::download(new ItemExport, 'Data Item.xlsx');
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

        $import = Excel::import(new ItemImport(), storage_path('app/public/excel/' . $nama_file));

        Storage::delete($path);

        return back()->with('success', "Data berhasil diimport!");
    }

    public function create()
    {
        return view('item.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'component_number' => 'required',
            'specific_component_number' => 'required',
            'component_name' => 'required',
        ]);
        $user = Auth::id();

        $item = Item::create([
            'component_number' => $request->component_number,
            'specific_component_number' => $request->specific_component_number,
            'component_name' => $request->component_name,
            'user_id' => $user,
        ]);

        if ($item) {
            return redirect()->route('item.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return redirect()->route('item.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function show(Request $request, $id)
    {
        //
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);
        return view('item.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
                'component_number' => 'required',
                'specific_component_number' => 'required',
                'component_name' => 'required', 
        ]);
        $user = Auth::id();

        $item = Item::findOrFail($id);

        $item->update([
            'component_number' => $request->component_number,
            'specific_component_number' => $request->specific_component_number,
            'component_name' => $request->component_name,
            'user_id' => $user,
        ]);

        if ($item) {
            return redirect()->route('item.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            return redirect()->route('item.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function destroy($id)
    {
        $user = Auth::id();
        $item = Item::where('user_id', $user)->find($id);

        if (!$item) {
            return response()->json(['error' => 'Data not found.'], 404);
        }

        $item->delete();

        return response()->json(['success' => 'Deleted successfully.', 'tr' => 'tr_' . $id]);
    }

    public function deleteAll_Item(Request $request)
    {
        $ids = $request->ids;
        $user = Auth::id();

        if (empty($ids)) {
            return response()->json(['error' => 'No items selected.'], 400);
        }

        $idArray = explode(",", $ids);
        $batchSize = 1000; // Ukuran batch yang diinginkan

        while (!empty($idArray)) {
            $batchIds = array_splice($idArray, 0, $batchSize);

            try {
                // Hapus data dalam batch
                $deleted = Item::where('user_id', $user)->whereIn('id', $batchIds)->delete();

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
        Item::where('user_id', $user)->delete();
        return response()->json(['success' => "Deleted successfully."]);
    }
}
