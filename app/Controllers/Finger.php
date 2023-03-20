<?php

namespace App\Controllers;

use App\Models\FingerDeviceModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Finger extends BaseController
{
    public function index()
    {
    // buat object model $device
    $device = new FingerDeviceModel();

    /*
     siapkan data untuk dikirim ke view dengan nama device
     dan isi datanya dengan data yang sudah terbit
    */
    $data['devices'] = $device->findAll();

    // kirim data ke view
    echo view('finger_device', $data);
    }

    public function viewFingerDevice($id)
    {
        $device = new FingerDeviceModel();
        $data['devices'] = $device->where([
            'devid_auto' => $id
        ])->first();

        // tampilkan 404 error jika data tidak ditemukan
        if (!$data['devices']) {
            throw PageNotFoundException::forPageNotFound();
        }

        echo view('finger_device', $data);
    }
}
