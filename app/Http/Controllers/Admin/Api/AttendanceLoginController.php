<?php

namespace App\Http\Controllers\Admin\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AbsensiMahasiswa;
use App\AbsensiDosen;
use App\Dosen;
use App\Mahasiswa;
use App\Jadwal;
use App\Matakuliah;
use App\MatakuliahMahasiswa;
use Carbon\Carbon;

class AttendanceLoginController extends Controller
{

    public function __construct()
    {
        $this->jadwal           = new Jadwal;
        $this->mhs_matakuliah   = new MatakuliahMahasiswa;
        $this->dosen            = new Dosen;
        $this->matakuliah       = new Matakuliah;
        $this->mahasiswa        = new Mahasiswa;
        $this->absen_dosen      = new AbsensiDosen;
        $this->absen_mahasiswa  = new AbsensiMahasiswa;
    }

    public function get_login(Request $request)
    {
        $mac=$request['mac'];
        $ip=$request['ip'];
        $username=$request['username'];
        $linklogin=$request['link-login'];
        $linkorig=$request['link-orig'];
        $error=$request['error'];
        $chapid=$request['chap-id'];
        $chapchallenge=$request['chap-challenge'];
        $linkloginonly=$request['link-login-only'];
        $linkorigesc=$request['link-orig-esc'];
        $macesc=$request['mac-esc'];
        $room_data=$request['room'];

        return view('mikrotik', compact('mac', 'ip', 'username',
        'linklogin', 'linkorig', 'linkloginonly', 'error', 'chapid',
        'chapchallenge', 'linkloginonly', 'linkorigesc', 'macesc', 'room'));
    }

    public function check_mac(Request $request)
    {
        $day        = date('l');
        $day_id     = $this->day_name_id($day);
        $status     = 201;
        $data       = null;
        $code_response = 10;
        $message    = "kosong";
        $check_jadwal_mhs = null;
        $check_jadwal_dosen = null;

        $check_mhs = Mahasiswa::where('mac', $request->mac)->first();
        $check_dosen = Dosen::where('mac', $request->mac)->first();

        if(count($check_mhs)>0){
            $check_jadwal_mhs = $this->mhs_matakuliah->get_schedule_by_hari($check_mhs->nim, $day_id, $request->room);
            foreach ($check_jadwal_mhs as $cjm) {
                if($cjm->data_jadwal){
                    $stcmp = strtotime($cjm->data_jadwal->jam_masuk);
                    $secmp = strtotime($cjm->data_jadwal->jam_keluar);
                    $st = date('H:i:s', time());
                    if($stcmp <= strtotime($st)  && strtotime($st) <= $secmp){
                        if(date('i',$stcmp) - date('i', strtotime($st)) < 0)
                        {
                            $code_response = 21;
                            $data['nim'] = $cjm->nim;
                            $data['name'] = $cjm->data_mahasiswa->name;
                            $data['kelas'] = $cjm->data_mahasiswa->kelas;
                            $data['start_class_in'] = date('i',$stcmp) - date('i', strtotime($st));
                            $message = "kelas belum dimulai";
                        } else {
                            $message = "berhasil";
                            $status = 200;
                            $code_response = 20;
                            $data['hari']               = $cjm->data_jadwal->hari;
                            $data['jam_masuk']          = $cjm->data_jadwal->jam_masuk;
                            $data['jam_keluar']         = $cjm->data_jadwal->jam_keluar;
                            $data['ruangan']            = $cjm->data_jadwal->ruangan;
                            $data['kode_matakuliah']    = $cjm->matakuliah;
                            $data['matakuliah']         = $cjm->data_matakuliah->name;
                            $data['kode_dosen']         = $cjm->data_matakuliah->kode_dosen;
                            $data['end_class_in'] = date('i',$secmp) - date('i', strtotime($st));
                        }
                    }
                } else {
                    $data['nim'] = $check_mhs->nim;
                    $data['name'] = $check_mhs->name;
                    $data['kelas'] = $check_mhs->kelas;
                    $code_response = 22;
                    $message = "Tidak ada kelas";
                }
            }
        } elseif (count($check_dosen)>0) {
            $code_response = 32;
            $message = "tidak ada kelas";

            $check_jadwal_dosen = $this->matakuliah->get_schedule_by_kode_dosen($check_dosen->kode_dosen, $day_id, $request->room);
            $data_dosen = $this->dosen->get_nip_by_kode($check_dosen->kode_dosen);
            $ctr = count($check_jadwal_dosen);
            if( $ctr > 0){
                foreach ($check_jadwal_dosen as $cjd) {
                    if ($cjd->data_jadwal) {
                        foreach ($cjd->data_jadwal as $jadwal) {
                            $stcmp = $jadwal->jam_masuk;
                            $secmp = $jadwal->jam_keluar;
                            $st = date('H:i:s', time());
                            if(strtotime($stcmp) <= strtotime($st)  && strtotime($st) <= strtotime($secmp)){
                                $code_response = 30;
                                $data['hari']       = $jadwal->hari;
                                $data['jam_masuk']  = $stcmp;
                                $data['jam_keluar'] = $secmp;
                                $data['end_class_in'] = date('i',$secmp) - date('i', strtotime($st));
                            } else {
                                $code_response = 31;
                                $data['jam_masuk']      = $stcmp;
                                $data['jam_keluar']     = $secmp;
                                $data['start_class_in'] = date('i',$stcmp) - date('i', strtotime($st));
                                $message = "Kelas belum dimulai";
                            }
                        }
                    } else {
                        $data['jam_masuk'] = false;
                        $data['jam_keluar'] = false;
                    }
                    $data['nip']             = $data_dosen->nip;
                    $data['nama']            = $data_dosen->name;
                    $data['kode_matakuliah'] = $cjd->kode;
                    $data['nama_matakuliah'] = $cjd->name;
                    $data['kode_dosen']      = $cjd->kode_dosen;
                }
            }
        }

        $translate_code = $this->code_response_translation($code_response);

        $res = [
            "status" => $status,
            "message" => $message,
            "info" => $translate_code,
            "data" => $data
        ];

        return $res;
    }

    public function absent(Request $request)
    {
        $status = 201;
        $data = null;
        $message = "Absen Gagal";

        if($request->has('nim'))
        {

        }


    }

    public function day_name_id($name)
    {
        switch ($name) {
            case 'Sunday':
                return "Minggu";
                break;
            case 'Monday':
                return "Senin";
                break;
            case 'Tuesday':
                return "Selasa";
                break;
            case 'Wednesday':
                return "Rabu";
                break;
            case 'Thursday':
                return "Kamis";
                break;
            case 'Friday':
                return "Jumat";
                break;

            default:
                return "Sabtu";
                break;
        }
    }

    public function code_response_translation($code)
    {
        switch ($code) {
            case 20:
                return "Mac address mahasiswa terdaftar, jadwal matakuliah ditemukan (kelas sedang berlangsung)";
                break;
            case 21:
                return "Mac address mahasiswa terdaftar, jadwal matakuliah ditemukan (kelas belum dimulai)";
                break;
            case 22:
                return "Mac address mahasiswa terdaftar, jadwal matakuliah tidak ditemukan (tidak ada kelas)";
                break;
            case 30:
                return "Mac address dosen terdaftar, jadwal matakuliah ditemukan (kelas sedang berlangsung)";
                break;
            case 31:
                return "Mac address dosen terdaftar, jadwal matakuliah ditemukan (kelas belum dimulai)";
                break;
            case 32:
                return "Mac address dosen terdaftar, jadwal matakuliah ditemukan (tidak ada kelas)";
                break;
            default:
                return "Mac address tidak terdaftar";
                break;
        }
    }


}
