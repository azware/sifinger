<?php

namespace App\Controllers;

use App\Models\FingerDeviceModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Home extends BaseController
{
    public function index()
    {
        $device = new FingerDeviceModel();

        $data['devices'] = $device->findAll();

        return view('template', $data);
    }
}
