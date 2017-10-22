<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Matakuliah;
use App\Dosen;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function showCourseMahasiswa(){
    	$matakuliah = Matakuliah::get();
    	$dosen = Dosen::get(); 
    	return view('pages.admin.course.mahasiswa');
    }
}
