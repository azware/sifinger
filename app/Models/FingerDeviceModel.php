<?php

namespace App\Models;

use CodeIgniter\Model;

class FingerDeviceModel extends Model
{
    protected $table      = 'device';
    protected $primaryKey = 'devid_auto';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['devid_auto', 'ip_address', 'device_name', 'comm_type', 'sn', 'dev_type', 'comm_key', 'serial_port', 'baud_rate', 'ethernet_port', 'lastupdate_date', 'lastupdate_user', 'dev_id', 'activation_code', 'auto_dl_time', 'auto_dl_enable', 'layar', 'ver_alg', 'web_stamp', 'web_user_stamp', 'web_template_stamp', 'group_realtime', 'use_realtime', 'cloud_id', 'last_download_web'];
}