<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function update_database()
    {
        return view('update_database');
    }
    
    public function hasil_sto()
    {
        return view('hasil_sto');
    }

    public function report_hasil()
    {
        return view('report');
    }

    public function data_profile()
    {
        return view('data_profile');
    }
    
}
