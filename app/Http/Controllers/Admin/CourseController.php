<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Matakuliah;
use App\Dosen;
use App\Mahasiswa;
use App\MatakuliahMahasiswa;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    // Mahasiswa 
    public function showCourseMahasiswa(){
        $data = MatakuliahMahasiswa::with(['data_mahasiswa', 'data_matakuliah', 'data_jadwal'])->get(); 
        return view('pages.admin.course.mahasiswa', compact('data'));      
    }


    // Dosen
    public function showCourseDosen(){
    	$matakuliah = Matakuliah::get();
    	$dosen = Dosen::get();
    	return view('pages.admin.course.dosen',  compact('matakuliah', 'dosen'));
    }

    public function createCourseDosen(Request $request){
    	$data = new Matakuliah();
    	$data->id = $request->id;
    	$data->kode = $request->kode;
    	$data->name = $request->nama_matakuliah;
    	$data->kode_dosen = $request->kdosen;
    	$data->save();
    	return response()->json($data);
    }

    public function deleteCourseDosen(Request $request)
    {
        $data = Matakuliah::find($request->id)->delete();
        return response()->json($data);
    }

    public function updateCourseDosen(Request $request)
    {
        $data = Matakuliah::find($request->id);
        $data->kode = $request->kode;
        $data->name = $request->name;
        $data->kode_dosen = $request->kode_dosen;
        $data->save();
        return response()->json($data);
    }

    
}
