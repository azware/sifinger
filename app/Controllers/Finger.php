<?php

namespace App\Controllers;

use App\Models\FingerDeviceModel;
use CodeIgniter\Exceptions\PageNotFoundException;

use TADPHP\TAD;
use TADPHP\TADFactory;

use ZKLib\ZKLibrary;

date_default_timezone_set('Asia/Jakarta');

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

        if (!EMPTY($devices)) { // Cek apakah ada device dengan ip ini di database
            $tad = (new TADFactory((['ip'=> $device_ip, 'com_key'=>0])))->get_instance();
            if (!EMPTY($tad)) { // Cek apakah data di device sesuai dengan filter
                $logs = $tad->get_att_log()->filter_by_date(
                            ['start' => $date_start_ready,'end' => $date_end_ready]
                        );

                $data_logs = $logs->to_json();
                $row_logs = json_decode($data_logs,true);
                $fp = fopen('download_log_mesin_'.$device_name.'__start_'.$date_start_ready.'__end_'.$date_end_ready.'__'.$date_now.'.csv', 'w');
                $header = array("pin","scan_date","verify_mode","io_mode","work_code");
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

    public function get_finger()
    { 
        $device_ip = $_POST['device_ip'];
        $device_name = $_POST['device_name'];

        $data['csrf_token'] = csrf_token();
        $data['csrf_hash'] = csrf_hash();
        $data['device_ip'] = $device_ip;
        $date_now = date("Y_m_d__H_i_s");
        $error = "";

        $device = new FingerDeviceModel();

        $devices = $device->where('ip_address', $device_ip)->findAll();

        if (!EMPTY($devices)) { // Cek apakah ada device dengan ip ini di database
            $tad = (new TADFactory((['ip'=> $device_ip])))->get_instance(); // using tad-php
            if (!EMPTY($tad)) { // Cek apakah data di device sesuai dengan filter
                $fingers = $tad->get_user_template(); // ex ['pin'=>16829]
                
                $data_fingers = $fingers->to_json();
                $row_fingers = json_decode($data_fingers,true);
                $fin = fopen('download_finger_mesin_'.$device_name.'__'.$date_now.'.csv', 'w');
                $header = array("pin","finger_idx","","","template1");
                fputcsv($fin, $header);
                foreach ($row_fingers['Row'] as $fields) {
                    fputcsv($fin, $fields);
                }

                fclose($fin); 
                exit; 
            } else $error = 1;
        } else $error = 1;

        if ($error==1) {
            die(json_encode([
                'status' => false,
                'response' => "Data Fingerprint tidak di temukan di Mesin !",
                'data' => $data
            ])); 
        }

        //echo $date_start_ready." Sampai ".$date_end_ready;
        echo json_encode($data);
    }

    public function set_user()
    {
        $device_ip = $_POST['device_ip'];
        $device_name = $_POST['device_name'];
        $csv = array();

        $data['csrf_token'] = csrf_token();
        $data['csrf_hash'] = csrf_hash();
        $data['device_ip'] = $device_ip;
        $error = "";

        $device = new FingerDeviceModel();

        $devices = $device->where('ip_address', $device_ip)->findAll();

        if (!EMPTY($devices)) { // Cek apakah ada device dengan ip ini di database
            $tad = (new TADFactory((['ip'=> $device_ip])))->get_instance();
            if (!EMPTY($tad)) { // Cek apakah data di device sesuai dengan filter

                // check there are no errors
                if($_FILES['file_upuser']['error'] == 0) {
                    $name = $_FILES['file_upuser']['name'];
                    //$ext = strtolower(end(explode('.', $_FILES['file_upuser']['name']))); // buat validasi file csv tapi masih error
                    $type = $_FILES['file_upuser']['type'];
                    $tmpName = $_FILES['file_upuser']['tmp_name'];

                    // check the file is a csv
                    //if($ext === 'csv') {
                        if(($handle = fopen($tmpName, 'r')) !== FALSE) {
                            // necessary if a large csv file
                            set_time_limit(0);

                            $row = 1;

                            while(($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                                // number of fields in the csv
                                $col_count = count($data);

                                // get the values from the csv
                                $pin = $data[0];
                                $name = $data[1];

                                if ($row!=1) {
                                    // Tambahkan User
                                    $r = $tad->set_user_info([
                                        'pin' => $pin,
                                        'name'=> $name,
                                        'privilege'=> 0,
                                        'password' => ''
                                    ]);
                                }

                                // inc the row
                                $row++;
                            }
                            fclose($handle);
                        }
                    //} else { $error = 1; $response = "File tidak kompatibel, Bukan file csv!"; }
                } else { $error = 1; $response = "File tidak terbaca!"; }
            } else { $error = 1; $response = "Data Fingerprint tidak ditemukan di Mesin!"; }
        } else { $error = 1; $response = "Mesin Fingerprint Hilang!"; }

        if ($error==1) {
            die(json_encode([
                'status' => false,
                'response' => $response,
                'data' => $data
            ])); 
        }

        //echo $date_start_ready." Sampai ".$date_end_ready;
        echo json_encode($data);
    }

    public function set_finger()
    {
        $device_ip = $_POST['device_ip'];
        $device_name = $_POST['device_name'];
        $csv = array();

        $data['csrf_token'] = csrf_token();
        $data['csrf_hash'] = csrf_hash();
        $data['device_ip'] = $device_ip;
        $error = "";

        $device = new FingerDeviceModel();

        $devices = $device->where('ip_address', $device_ip)->findAll();

        if (!EMPTY($devices)) { // Cek apakah ada device dengan ip ini di database
            $tad = (new TADFactory((['ip'=> $device_ip, 'com_key'=>0])))->get_instance();
            if (!EMPTY($tad)) { // Cek apakah data di device sesuai dengan filter

                $template1_vx9 = "TYdTUzIxAAAExMgECAUHCc7QAAAcxWkBAAAAhGkuzsQPABkPTQDoAGXKZQAvAG0OkwAyxOwO+gA2AGUPkcRAAIEOXQCGAFvKkwBIABAOWgBJxI8OawBOAD0PZcRQAFYPhQCXAG/LmwBZAIEOrgBtxOQPnACAAOkPRsSIAEcPmQBJADPLggChADoP+QCvxEAPagC1APIPfsTAADIPJgABAEzL8gDWAKcPtADTxLkPkQDYAHcPNcTeAD4PbwAnACnLswDmAB0PGADuxJ0PKwD4APwNqMQEAaAPQgDMAaLKxAAMAZYPqwAWxaUPWAATAVgPncQlAZgPXADsAY7LGwAsAf8OfgA0xYwMzwA2AYINksQ2AY4P8gD4AVHKeAA/AYoPWABXxXUO9ABVAYgO3MRWAdMOh3sOm8dLQXcl9kUHRIBl1ZgONI/BkESAe09aF18jUHLg9FneVAjNdD1phZKFQNSkRA+BgFAM+GMkmZGPIGMk+Fm3/Fwl7vXuFfeptYwaTZNd77t9pDMXrrL2ggnmZVvXFQ+q/Au57wSqwJMInvgK/Y4MYcEv/IKB6f1YfnZEaA8WCHcR+wxXSzYTEI+Zig8IVjhzgEaFjQcw+3JfHXci/Up9a3zyqZOLyvQ+C6+DFTtglwfx7Q9vhD7N7Ap1bwIesPsyzcf/XQo5H6MD5T4cFnX6MQ0zDcY9sO7R6xIBollLDoJ3AUmC9Qf5wXlzdUL1ufnsH27AaAq2EY6FK/yWxQ8axeui7i7o9T6wf9MIrYujjYpF3t1g7scf5UIFxnkgTAkAyMQQ+pD/wMAFANvEE/qBAgDxBBr/1QB2xgH9wP84wAVExJYCAD8Da8HBAFfBcYQMAKcF1j5XBTQTAGEN/QX9+4VXPmBVBQALDRc7NAkAWQ50TcDFXAQAzBIewY4UBJUr7f/8O8CFwE8F/sFhCgBJ6WnGQMHBcRIAaOj6+jr+//5EQkMFwQjETDFgwHfAsUEKxFM6YsHBwbXAX5MFAP46JP86EwSlPukh/v84BUNBO8EEAJBAgwTFC8RYQmSAwMEEwMShRgsAXEdgsnD7vBUAgU93xVzCcAXAwf+EkA7Fo1TTNMD+XWjDwABYllt1EABiVZbAxjvFWnR8wQzFnl7T/z3AQl0NxZZYRMXElsLAwQWWCcSZfHDKkMAEwMAEXgwAoIEnBf5mQGYeAAeCxjjAQ/Ex/v44Pv8FSkYECwCchC1MB8GFzAGVhkmTwE4HBPqNScD+lAzFRIiE/sL/wmaIyQCeVDvBb8DEcjsEBEemOngJADx1Q3xIwwcAescwBMCEwQEiyEn/UsMALAxB/v9BIgAq1qSEwcBcw8PCA6nEB8HB/8HD/1PDY/EFADTjOsIGDAS35Sv/xP/DQMBzzQFt5TTCwr1/AcS35hx7BQB36ilgGwD56pxU6sFqBsTJxMNpwgR+xsARyQ4MNArVHxAw+0pQwgUQmRYSBHwGEHIWGkHBAdUNJE/EJwfVVy1IZsXICBAd7wD7gTYEEO8yYl0IFN01BmhbBRAXNTM/xP8EEJo5w8H7wBHtP16nCtUkRMLBwMBZWgXVfUTCwXIEEPNBk5wH1CFFMMIHEP5OCAXD/X8GEDiWIMABQQQQnGD05wA=";

                $template1_data = [
                  'pin' => 42022,
                  'finger_id' => 0, // First fingerprint has 0 as index.
                  'size' => 514,    // Be careful, this is not string length of $template1_vx9 var.
                  'valid' => 1,
                  'template' => $template1_vx9
                ];

                $tad->set_user_template( $template1_data );

                // check there are no errors
                /* if($_FILES['file_upfin']['error'] == 0) {
                    $name = $_FILES['file_upfin']['name'];
                    //$ext = strtolower(end(explode('.', $_FILES['file_upfin']['name']))); // buat validasi file csv tapi masih error
                    $type = $_FILES['file_upfin']['type'];
                    $tmpName = $_FILES['file_upfin']['tmp_name'];

                    // check the file is a csv
                    //if($ext === 'csv') {
                        if(($handle = fopen($tmpName, 'r')) !== FALSE) {
                            // necessary if a large csv file
                            set_time_limit(0);

                            $row = 1;

                            while(($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                                // number of fields in the csv
                                $col_count = count($data);

                                // get the values from the csv
                                $pin = $data[0];
                                $template = $data[1]; // data fingerprint

                                if ($row!=1) {
                                    // Tambahkan Fingerprint
                                    //$r = $tad->set_user_template([
                                    //    'pin' => $pin,
                                    //    'finger_id' => 0,
                                    //    'size' => 514,
                                    //    'valid' => 1,
                                    //    'template' => $template
                                    //]);
                                }

                                // inc the row
                                $row++;
                            }
                            fclose($handle);
                        }
                    //} else { $error = 1; $response = "File tidak kompatibel, Bukan file csv!"; }
                } else { $error = 1; $response = "File tidak terbaca!"; } */
            } else { $error = 1; $response = "Data Fingerprint tidak ditemukan di Mesin!"; }
        } else { $error = 1; $response = "Mesin Fingerprint Hilang!"; }

        if ($error==1) {
            die(json_encode([
                'status' => false,
                'response' => $response,
                'data' => $data
            ])); 
        }

        //echo $date_start_ready." Sampai ".$date_end_ready;
        echo json_encode($data);
    }
}
