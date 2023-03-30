<?php

namespace App\Controllers;

use App\Models\FingerDeviceModel;
use CodeIgniter\Exceptions\PageNotFoundException;

use TADPHP\TAD;
use TADPHP\TADFactory;

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
        $device_ip = $_POST['device_ip'];
        $device_name = $_POST['device_name'];
        $datelog = $_POST['datelog'];

        $data['csrf_token'] = csrf_token();
        $data['csrf_hash'] = csrf_hash();
        $data['device_ip'] = $device_ip;
        $date_now = date("Y_m_d__H_i_s");
        $error = "";

        $device = new FingerDeviceModel();

        $devices = $device->where('ip_address', $device_ip)->findAll();
        $data['devices'] = $devices;

        $datelog_exp = explode(' - ', $datelog);
        $date_start_str = $datelog_exp[0];
        $date_end_str = $datelog_exp[1];

        $date_start = strtotime($date_start_str);
        $date_end = strtotime($date_end_str);

        $date_start_ready = date('Y-m-d',$date_start);
        $date_end_ready = date('Y-m-d',$date_end);

        if (!EMPTY($devices)) {
            $tad = (new TADFactory((['ip'=> $device_ip, 'com_key'=>0])))->get_instance();
            if (!EMPTY($tad)) {
                $logs = $tad->get_att_log()->filter_by_date(
                            ['start' => $date_start_ready,'end' => $date_end_ready]
                        );
                //$logs = $tad->get_att_log();

                $data_logs = $logs->to_json();
                $row_logs = json_decode($data_logs,true);
                $fp = fopen('download_log_mesin_'.$device_name.'__start_'.$date_start_ready.'__end_'.$date_end_ready.'__'.$date_now.'.csv', 'w');
                $header = array("ID","Date"); 
                fputcsv($fp, $header);
                foreach ($row_logs['Row'] as $fields) {
                    fputcsv($fp, $fields);
                }

                fclose($fp); 
                exit; 
            } else $error = 1;
        } else $error = 1;

        if ($error==1) {
            die(json_encode([
                'status' => false,
                'response' => "Data Log Presensi tidak di temukan di Mesin !",
                'data' => $data
            ])); 
        }

        //echo $date_start_ready." Sampai ".$date_end_ready;
        echo json_encode($data);

    }
}
