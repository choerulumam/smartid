<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dosen = \App\Dosen::get();
        $mahasiswa = \App\Mahasiswa::get(); 
        $kelas = \App\Ruangan::get();
        $jadwal = \App\Jadwal::get();
        return view('pages.admin.home', compact('dosen', 'mahasiswa', 'kelas', 'jadwal'));
    }

    public function log() {
        return view('pages.admin.logs');   
    }

    public function test() {
        \Carbon\Carbon::setlocale('LC_ALL', 'id_ID');
        $tanggal = \Carbon\Carbon::now()->format('l, d F Y H:i');
        return $tanggal;
    }
}
