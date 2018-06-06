<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MatakuliahMahasiswa;

class PresenceController extends Controller
{
    public function __construct()
    {
        $this->mMahasiswa = new MatakuliahMahasiswa;
    }

    public function getJadwal()
    {
        $result = array();
        $data   = $this->mMahasiswa->get_data_jadwal_mahasiswa("6702144114");
        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                $temp = array(
                    'id'  => $value['id'],
                    'nim' => $value['nim'],
                    'matakuliah' => $value['data_matakuliah']['name'],
                    'dosen' => $value['data_matakuliah']['kode_dosen'],
                    'hari' => $value['data_jadwal']['hari'],
                    'ruangan' => $value['data_jadwal']['ruangan'],
                    'jam_masuk' => $value['data_jadwal']['jam_masuk'],
                    'jam_keluar' => $value['data_jadwal']['jam_keluar']
                );
                array_push($result, $temp);
            }
        }
        return response()->json(array('schedules'=> $result));
    }
}
