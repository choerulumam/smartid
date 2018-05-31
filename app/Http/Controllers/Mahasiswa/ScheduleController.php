<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jadwal;
use App\MatakuliahMahasiswa;
use Auth;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->jadwal = new Jadwal;
        $this->jadwalMatakuliah = new MatakuliahMahasiswa;
    }

    public function index()
    {
        $nim = Auth::user()->nim;
        $data = $this->jadwalMatakuliah->get_data_jadwal_mahasiswa($nim);
        return view('pages.mahasiswa.schedule')->with(['data' => $data]);
    }
}
