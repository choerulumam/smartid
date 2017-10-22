<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mahasiswa;
use App\Dosen;
use App\Matakuliah;
Use App\Kelas;

class ManagementController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //  START CRUD MAHASISWA 
	public function showDataMahasiswa()
	{
		$data = Mahasiswa::get();
        $kelas = Kelas::get();
		return view('pages.admin.management.mahasiswa', compact('data', 'kelas'));
	}

	public function updateDataMahasiswa(Request $request)
    {
    	$data = Mahasiswa::find($request->id);
        $data->nim = $request->nim;
        $data->mac = $request->mac;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->kelas = $request->kelas;
        $data->save();
        return response()->json($data);
    }

    public function createDataMahasiswa(Request $request)
    {
    	$data = new Mahasiswa();
    	$data->id = $request->id;
        $data->nim = $request->nim;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->kelas = $request->kelas;
        $data->mac = $request->mac;
        $data->password = Hash::make($request->password);
        $data->save();
        return response()->json($data);
    }

    public function deleteDataMahasiswa(Request $request)
    {
        $data = Mahasiswa::find($request->id)->delete();
        return response()->json($data);
    }

    // END CRUD MAHASISWA


    // START CRUD DOSEN
    public function showDataDosen()
    {
        $data = Dosen::get();
        $matakuliah = Matakuliah::get();
        return view('pages.admin.management.dosen', compact('data', 'matakuliah')); 
    }

    public function updateDataDosen(Request $request)
    {
        $data = Dosen::find($request->id);
        $data->nip = $request->nip;
        $data->kode_dosen = $request->kode;
        $data->name = $request->name;
        $data->mac = $request->mac;
        $data->email = $request->email;
        $data->save();
        return response()->json($data);
    }

    public function createDataDosen(Request $request)
    {
        $data = new Dosen();
        $data->id = $request->id;
        $data->nip = $request->nip;
        $data->name = $request->name;
        $data->kode_dosen = $request->kode;
        $data->email = $request->email;
        $data->mac = $request->mac;
        $data->password = Hash::make($request->password);
        $data->save();
        return response()->json($data);
    }

    public function deleteDataDosen(Request $request)
    {
        $data = Dosen::find($request->id)->delete();
        return response()->json($data);
    }

}
