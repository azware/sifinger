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
}
