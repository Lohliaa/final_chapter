<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use App\Models\Profile;
use App\Exports\UserExport;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->cari_profile;
        $users = User::select("*")
            ->orderBy('last_seen', 'DESC')
            ->paginate(10);
        $count = $users->count();
        foreach ($users as $user) {
            $user->last_seen = Carbon::parse($user->last_seen)->diffForHumans();
        }

        return view('users.index', ['users' => $users], compact('count'));
    }

    public function cari_profile(Request $request)
    {
        $keyword = $request->cari_profile;
        $user = Auth::id();

        $user = User::where('user_id', $user)
            ->where(function ($query) use ($keyword) {
                $query->orWhere('name', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%")
                    ->orWhere('role', 'like', "%{$keyword}%");
            })->get();

        $count = $user->count();
        $name = $user->where('name', 'like', "%{$keyword}%")->count();
        $email = $user->where('email', 'like', "%{$keyword}%")->count();
        $role = $user->where('role', 'like', "%{$keyword}%")->count();

        return view('user.index', compact('user', 'count'));
    }

    public function edit($id)
    {
        $users = User::find($id);
        return view('users.edit', compact('users'));
    }

    public function update(Request $request, $id)
    {
        $users = User::find($id);

        // Validasi data lainnya jika diperlukan
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email,' . $users->id,
            'role' => 'required|in:pegawai,admin',
        ]);

        // Update data yang diperlukan
        $users->name = $request->name;
        $users->email = $request->email;
        $users->role = $request->role;

        // Simpan perubahan
        $users->save();

        if ($users) {
            return redirect()->route('users.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            return redirect()->route('users.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function deleteUser(Request $request)
    {
        $ids = explode(",", $request->ids);
    
        // Memeriksa apakah ada pengguna dengan peran "Admin" di antara pengguna yang akan dihapus
        $adminUsers = User::whereIn('id', $ids)->where('role', 'admin')->get();
    
        if ($adminUsers->count() > 0) {
            return response()->json(['error' => "Tidak Dapat Menghapus Admin!"]);
        }
    
        // Melanjutkan dengan penghapusan jika tidak ada pengguna dengan peran "Admin"
        User::whereIn('id', $ids)->delete();
        return response()->json(['success' => "Deleted successfully."]);
    }
    
}
