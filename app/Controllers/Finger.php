<?php

namespace App\Controllers;

use App\Models\FingerDeviceModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Finger extends BaseController
{
    public function index($id = false)
    {
        // buat object model $device
        $device = new FingerDeviceModel();

        /*
         siapkan data untuk dikirim ke view dengan nama device
         dan isi datanya dengan data yang sudah terbit
        */
        if($id === false){
            $data['devices'] = $device->findAll();
        } else {
            $data['devices'] = $device->where([ 'devid_auto' => $id ])->first();
        }
        
        // tampilkan 404 error jika data tidak ditemukan
        //if (!$data['devices']) {
        //   throw PageNotFoundException::forPageNotFound();
        //}

        // kirim data ke view
        echo view('finger_device', $data);
    }

    public function get_mesin($id)
    {
        $device = new FingerDeviceModel();
        $data['devices'] = $device->where([
            'devid_auto' => $id
        ])->first();

        // tampilkan 404 error jika data tidak ditemukan
        //if (!$data['devices']) {
        //   throw PageNotFoundException::forPageNotFound();
        //}
        $data['id'] = $id;
        echo view('finger_device', $data);
    }


    public function get_log()
    {   
        $data['csrf_token'] = csrf_token();
        $data['csrf_hash'] = csrf_hash();
        $datelog = $_POST['datelog'];
        $device = new FingerDeviceModel();

        $data['devices'] = $device->findAll();

        $datelog_exp = explode(' - ', $datelog);
        $date_awal_str = $datelog_exp[0];
        $date_akhir_str = $datelog_exp[1];

        $date_awal = strtotime($date_awal_str);
        $date_akhir = strtotime($date_akhir_str);

        $date_awal_ready = date('Y-m-d',$date_awal);
        $date_akhir_ready = date('Y-m-d',$date_awal);

        echo $date_awal_ready." Sampai ".$date_akhir_ready;
        echo json_encode($data);
    }
}
