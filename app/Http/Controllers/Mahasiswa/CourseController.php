<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\MatakuliahMahasiswa;
use App\Matakuliah;

class CourseController extends Controller
{
    public function index()
    {
    	$nim = Auth::user()->nim;
    	$data = MatakuliahMahasiswa::with(['data_mahasiswa', 'data_matakuliah', 'data_jadwal'])
    	->where('nim', $nim)->get();
    	$mk = Matakuliah::all();
    	return view('pages.mahasiswa.course', compact('data', 'mk'));
    }
}
