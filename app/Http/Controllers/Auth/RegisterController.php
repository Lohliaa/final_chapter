<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    // use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function index()
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);

        // Mengisi kolom 'last_seen' dengan waktu saat ini
        $validatedData['last_seen'] = now();

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('/login')->with('success', 'Registration Succesfull! Please Login');
    }


    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'name' => 'required|max:255',
    //         'email' => 'required|unique:users',
    //         'password' => 'required',
    //         'last_seen' => 'required',
    //     ]);

    //     $validatedData['password'] = Hash::make($validatedData['password']);

    //     User::create($validatedData);
    //     return redirect('/login')->with('success', 'Registration Succesfull! Please Login');
    // }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'last_seen' => ['required'],

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        if ($data['password'] == $data['password_repeat']) {
            $users = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => "Pegawai",
                'last_seen' => now(),
            ]);
        }

        $profile = Profile::create([
            'profile_foto' => "default.svg",
            'user_id' => $users->id,
        ]);
        return $users;
        return $profile;
    }
}
