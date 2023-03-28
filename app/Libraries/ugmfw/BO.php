<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Library BO
 * @created on : 2017-04-27 10:10:10
 * @author Bayu Prasetiyo Utomo <bayuprasetiyo.utomo@ugm.ac.id>
 * DSSDI-UGM
 */
class BO {

    public $CI = NULL;

    public function __construct() {
        $this->CI = & get_instance();
    }

    protected function _basic_login($param) {
        $this->CI->db->select('a.user_id, a.user_username, a.user_unit_id,'
                . 'a.user_image, a.user_nama_lengkap, a.user_tipe_nomor,'
                . 'a.user_is_aktif, a.user_email,'
                . 'a.group_menu_id, b.group_menu_nama');
        $this->CI->db->from('ugmfw_user a');
        $this->CI->db->join('ugmfw_group_menu b', 'a.group_menu_id = b.group_menu_id');
        $this->CI->db->where('a.user_username', $param['username']);
        $this->CI->db->where('a.user_password="' . $this->pwd_encrypt($param['password']) . '"', '', false);
        $result = $this->CI->db->get();

        if ($result->num_rows() === 0) {
            return ['resId' => 0, 'sesId' => NULL];
        } else {
            $user = $result->row();

            $_ = $this->check_user_agent($param, $user);
            $user->platform = $_['platform'];

            if ($user->user_is_aktif === '1') {
                $this->_set_init_session($user);
                $this->log_login(['user_id' => $user->user_id,
                    'user_username' => $user->user_username,
                    'user_agent' => $_['uagent'],
                    'created_time' => $param['date_today']]);

                return ['resId' => 1, 'sesId' => $_['sesId']];
            } else {
                return ['resId' => 2, 'sesId' => $_['sesId']];
            }
        }
    }

    protected function _ldap_login($param) {
        $server = "ldap.ugm";
        $basedn = "ou=people,o=Universitas Gadjah Mada,dc=ugm,dc=ac,dc=id";
        $dn = "uid=" . $param['username'] . "," . $basedn;
        $ldapconn = ldap_connect($server, 389) or die("Not connected");

        ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
        if ($ldapconn) {
            $r = @ldap_bind($ldapconn, $dn, $param['password']);
            if ($r) {
                $sr = ldap_search($ldapconn, $basedn, "uid=" . $param['username']);
                $dataLdap = ldap_get_entries($ldapconn, $sr);

                $this->CI->db->select('a.user_id, a.user_username, a.user_unit_id,'
                        . 'a.user_image, a.user_nama_lengkap, a.user_tipe_nomor,'
                        . 'a.user_is_aktif, a.user_email,'
                        . 'a.group_menu_id, b.group_menu_nama');
                $this->CI->db->from('ugmfw_user a');
                $this->CI->db->join('ugmfw_group_menu b', 'a.group_menu_id = b.group_menu_id');
                $this->CI->db->where('a.user_username', $param['username']);
                $this->CI->db->where('a.user_email', $dataLdap[0]['mail'][0]);
                $result = $this->CI->db->get();

                if ($result->num_rows() === 0) {
                    return ['resId' => 0, 'sesId' => NULL];
                } else {
                    $user = $result->row();
                    $_ = $this->check_user_agent($param, $user);
                    $user->platform = $_['platform'];

                    if ($user->user_is_aktif === '1') {
                        $this->_set_init_session($user);
                        $this->log_login(['user_id' => $user->user_id,
                            'user_username' => $user->user_username,
                            'user_agent' => $_['uagent'],
                            'created_time' => $param['date_today']]);

                        return ['resId' => 1, 'sesId' => $_['sesId']];
                    } else {
                        return ['resId' => 2, 'sesId' => $_['sesId']];
                    }
                }
            } else {
                return ['resId' => 0, 'sesId' => NULL];
                // For Cek Error LDAP
                // return ['resId' => '<hr>ldapconn = '.$ldapconn.'<hr>dn = '.$dn.'<hr>param pass = '.$param['password'], 'sesId' => NULL];
            }
        }
    }

    protected function _hybrid_login($param) {
        $this->CI->db->select('user_is_sso');
        $this->CI->db->where('user_username', $param['username']);

        $result = $this->CI->db->get('ugmfw_user')->row();
        if (empty($result)) {
            return $this->_ldap_login($param);
        }
        if ($result->user_is_sso === '1') {
            return $this->_ldap_login($param);
        } else {
            return $this->_basic_login($param);
        }
    }

    protected function _cas_login($param) {
        if (!empty($param)) {
            return $this->get_user_cas($param);
        } else {
            return ['resId' => 0, 'sesId' => NULL];
        }
    }

    public function get_user_cas($param) {
//        $param = array('userlogin' => 'bayuprasetiyo.utomo',
//            'attributes' => array('kdUnitKerja' => 38, 'Name' => 'Bayu Prasetiyo Utomo',
//                'EmailAddress' => 'bayuprasetiyo.utomo@ugm.ac.id', 'tipePgawai' => 'Karyawan PNS',
//                'noID' => '19910124xxxxxxxxxx'), 'date_today' => $param['date_today']);
        $this->CI->db->select('a.user_id, a.user_is_aktif, a.user_username, a.user_image,'
                . 'a.user_unit_id, a.group_menu_id, b.group_menu_nama,'
                . 'a.user_tipe_nomor, a.user_nama_lengkap,a.user_email');
        $this->CI->db->from('ugmfw_user a');
        $this->CI->db->join('ugmfw_group_menu b', 'a.group_menu_id = b.group_menu_id');
        $this->CI->db->where('a.user_username', $param['userlogin']);
        $user = $this->CI->db->get();

        if ($user->num_rows() > 0) {
            $user = $user->row();

            if ($user->user_is_aktif === '0') {
                return 0;
            }

            $_ = $this->check_user_agent($param, $user);

            /* $user->user_unit_id = isset($user->user_unit_id) ? $user->user_unit_id :
              $param['attributes']['kdUnitKerja']; */
            $user->platform = $_['platform'];

            $this->_set_init_session($user);
            $this->log_login(['user_id' => $user->user_id,
                'user_username' => $user->user_username,
                'user_agent' => $_['uagent'],
                'created_time' => $param['date_today']]);

            $user = 1;
        } else {
            $user = 0;
        }

        return ['resId' => $user, 'sesId' => $_['sesId']];
    }

    public function select_user_access_by_user_id($userId) {
        return $this->CI->db->query("
            SELECT 
              c.`group_menu_id`,
              c.`group_menu_nama`,
              a.`user_tipe_nomor` 
            FROM
              `ugmfw_user` a 
              JOIN `ugmfw_user_access` b 
                ON a.`user_id` = b.`user_id` 
              JOIN `ugmfw_group_menu` c 
                ON b.`group_menu_id` = c.`group_menu_id` 
            WHERE a.`user_id` = '$userId'")->result_array();
    }

    public function change_session($userId, $groupMenuId, $groupMenuNama, $userTipeNomor) {
        $this->CI->db->select('a.user_id');
        $this->CI->db->from('ugmfw_user a');
        $this->CI->db->join('ugmfw_user_access d', 'a.user_id = d.user_id', 'left');
        $this->CI->db->join('ugmfw_group_menu e2', 'd.group_menu_id = e2.group_menu_id', 'left');
        $this->CI->db->where('a.user_id', $userId);
        $this->CI->db->where("(e2.group_menu_id = $groupMenuId)");
        $this->CI->db->where('a.user_is_aktif', 1);

        $_ = $this->CI->db->get();
        if ($_->num_rows() > 0) {
            $sessionData = [
                '__group_menu_id' => $groupMenuId,
                '__group_menu_nama' => $groupMenuNama,
                '__user_tipe_nomor' => $userTipeNomor,
            ];
            $this->CI->session->set_userdata($sessionData);
        }

        return TRUE;
    }

}

/**
For ldap connect & get Data


$server = "ldap.ugm";
$basedn = "ou=people,o=Universitas Gadjah Mada,dc=ugm,dc=ac,dc=id";
$dn = "uid=__username__," . $basedn;
$ldapconn = ldap_connect($server, 389) or die("Not connected");

ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
if ($ldapconn) {
  $r = @ldap_bind($ldapconn, $dn, $password);
  if ($r) {
      $sr = ldap_search($ldapconn, $basedn, "uid=__username__");
      $dataLdap = ldap_get_entries($ldapconn, $sr);
      echo $dataLdap[0]['mail'][0]."<br>";

      $entry = ldap_first_entry($ldapconn, $sr);
      $attrs = ldap_get_attributes($ldapconn, $entry);
      echo $attrs["count"]."<br> <br>";
      for ($j = 0; $j < $attrs["count"]; $j++){
          $attr_name = $attrs[$j];
          $attrs["$attr_name"]["count"] . "\n";
          for ($k = 0; $k < $attrs["$attr_name"]["count"]; $k++) {
            echo $attr_name.": ".$attrs["$attr_name"][$k]."<br>";
          }
       }
  }
} 

*/