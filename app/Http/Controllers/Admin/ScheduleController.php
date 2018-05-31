<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Jadwal;
use App\Matakuliah;
use App\Ruangan;

class ScheduleController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function showSchedule(){
    	$ruangan = Ruangan::get();
    	$matakuliah = Matakuliah::get();
    	$data = Jadwal::get();
    	return view('pages.admin.schedule.jadwal', compact('data', 'matakuliah', 'ruangan'));
    }

    public function createSchedule(Request $request){
    	$data = new Jadwal();
    	$data->id = $request->id;
    	$data->hari = $request->hari;
    	$data->matakuliah = $request->mk;
    	$data->ruangan = $request->rn;
    	$data->jam_masuk = $request->jm;
    	$data->jam_keluar = $request->jk;
    	$data->save();
    	return response()->json($data);
    }

    public function updateSchedule(Request $request)
    {
    	$data = Jadwal::find($request->id);
        $data->hari = $request->hari;
        $data->matakuliah = $request->mk;
        $data->ruangan = $request->rn;
        $data->jam_masuk = $request->jm;
        $data->jam_keluar = $request->jk;
        $data->save();
        return response()->json($data);
    }

    public function deleteSchedule(Request $request)
    {
        $data = Jadwal::find($request->id)->delete();
        return response()->json($data);
    }
}
