<?php

namespace App\Http\Controllers\Dosen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Dosen;
use App\Matakuliah;
use auth;

class DosenController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:dosen');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.dosen.home');
    }

    public function showCourse(){
        $data = Matakuliah::where('kode_dosen', Auth::user()->kode_dosen)->get();
        return view('pages.dosen.course', compact('data'));
    }
}
