<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Ruangan;

class ClassroomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function showClassroom(){
    	$data = Ruangan::get();
    	return view('pages.admin.classroom.ruangan', compact('data'));
    }

    public function createClassroom(Request $request){
    	$data = new Ruangan();
    	$data->id = $request->id;
    	$data->kode = $request->kode;
    	$data->kapasitas = $request->kapasitas;
    	$data->save();
    	return response()->json($data);
    }

    public function updateClassroom(Request $request)
    {
        $data = Ruangan::find($request->id);
        $data->kode = $request->kode;
        $data->kapasitas = $request->kapasitas;
        $data->save();
        return response()->json($data);
    }

    public function deleteClassroom(Request $request)
    {
        $data = Ruangan::find($request->id)->delete();
        return response()->json($data);
    }

}
