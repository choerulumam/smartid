<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Matakuliah;
use App\Dosen;
use App\Mahasiswa;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function showCourseMahasiswa(){
    	$matakuliah = Matakuliah::get();
    	$mahasiswa = Mahasiswa::get(); 
    	return view('pages.admin.course.mahasiswa');
    }

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

    
}
