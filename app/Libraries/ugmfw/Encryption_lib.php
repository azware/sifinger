<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Encryption_lib {

    public $CI;
    private $params;

    function __construct() {
        $this->CI = & get_instance();
        $this->params = array(
            'cipher' => $this->CI->encryption->cipher,
            'mode' => $this->CI->encryption->mode,
            'key' => config_item('encryption_key'),
            'raw_data' => FALSE,
            'hmac' => FALSE,
            'hmac_digest' => 'sha224',
            'hmac_key' => config_item('encryption_key')
        );
    }

    public function urlencode($str) {
        $encrypt = strtr($this->CI->encryption->encrypt($str, $this->params), '+/=', '-_');
        return $encrypt;
    }

    public function urldecode($str) {
        $decrypt = $this->CI->encryption->decrypt(strtr($str, '-_,', '+/='), $this->params);
        return $decrypt;
    }

}
