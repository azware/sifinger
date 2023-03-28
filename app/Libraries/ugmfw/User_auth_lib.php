<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Library User_Auth_Lib
 * @created on : 2015-04-07 10:01:00
 * @author Cicuk Kriswanto <cicuk.kriswanto@ugm.ac.id>,
 * Farid GS <farid@ugm.ac.id> 
 * Bayu Prasetiyo Utomo <bayuprasetiyo.utomo@ugm.ac.id>
 * DSSDI-UGM
 */
require 'BO.php';

class User_auth_lib extends BO {

    public function is_login() {
        if ($this->CI->session->userdata('__user_id')) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function username() {
        return $this->CI->session->userdata('__username');
    }

    public function do_login($param = null, $metode = 'basic') {
        switch ($metode) {
            case 'basic':
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
            case 'hybrid':
                return $this->_hybrid_login($param); 
            case 'cas':
                return $this->_cas_login($param);
            default:
                show_error('Metode login belum ditentukan.');
                break;
        }
    }

    public function pwd_encrypt($pwd) {
        $encrytKey = $this->CI->config->item('encryption_key');
        return MD5(SHA1($pwd . $encrytKey));
    }

    protected function _set_init_session($data) {
        $sessionData = [
            '__user_id' => $data->user_id,
            '__username' => $data->user_username,
            '__img' => $data->user_image,
            '__unit_id' => $data->user_unit_id,
            '__group_menu_id' => $data->group_menu_id,
            '__group_menu_nama' => $data->group_menu_nama,
            '__user_tipe_nomor' => $data->user_tipe_nomor,
            '__nama_lengkap' => $data->user_nama_lengkap,
            '__email' => $data->user_email,
            '__platform' => $data->platform
        ];

        $this->CI->session->set_userdata($sessionData);
    }

    public function restrict($module = null, $controller = null, $function = null) {
        if ($function) {
            if ($function == 'view_' . $controller) {
                redirect(base_url());
            } else {
                redirect($module . '/' . $controller);
            }
        } elseif ($controller) {
            redirect(site_url($module . '/' . $controller));
        } elseif ($module) {
            redirect(base_url());
        } else {
            $arrMenu = $this->menu();

            if (!empty($arrMenu[0]->id)) {
                foreach ($arrMenu as $menu) {
                    if (!empty($menu->controller)) {
                        redirect($menu->module . '/' . $menu->controller
                                . '/' . $menu->function);
                        break;
                    }
                }
            } else {
                show_404('', FALSE);
            }
        }
    }

    public function usermenu($groupId) {
        $this->CI->db->select("m.`menu_id` AS id,
				m.`menu_parent_id` AS parent_id,
				m.`menu_nama` AS menu,
				m.`menu_sequence` AS sequence,,
				m.`menu_css_clip` AS css_clip,
				m.`menu_label` AS label,
				m.`menu_css_label` AS css_label,								
				IF(ISNULL(m.`controller_id`),mo.`module_nama`,mo1.`module_nama`) AS `module`,
				IF(ISNULL(m.`controller_id`),c.`controller_nama`,c1.`controller_nama`) AS `controller`,
  				md.`module_detil_function` AS `function`,
  				0 AS `open`,
  				0 AS `aktif`", FALSE);
        $this->CI->db->from('ugmfw_group_menu as gm');
        $this->CI->db->join('ugmfw_group_menu_detil as gmd', 'gm.group_menu_id = gmd.group_menu_id', 'left');
        $this->CI->db->join('ugmfw_menu as m', 'gmd.menu_id = m.menu_id', 'left');
        $this->CI->db->join('ugmfw_module_detil as md', 'm.module_detil_id = md.module_detil_id', 'left');
        $this->CI->db->join('ugmfw_controller as c', 'md.controller_id = c.controller_id', 'left');
        $this->CI->db->join('ugmfw_module as mo', 'c.module_id = mo.module_id', 'left');
        $this->CI->db->join('ugmfw_controller as c1', 'm.controller_id = c1.controller_id', 'left');
        $this->CI->db->join('ugmfw_module as mo1', 'c1.module_id = mo1.module_id', 'left');
        $this->CI->db->where('gm.group_menu_id', $groupId);
        $this->CI->db->group_by('m.menu_id');
        $this->CI->db->order_by("IF(m.`menu_parent_id` = 0, CONCAT(m.`menu_parent_id`,'.',m.`menu_sequence`), 
                                CONCAT(0,'.',(SELECT menu_sequence FROM ugmfw_menu WHERE menu_id = m.menu_parent_id),'.',m.`menu_sequence`))");

        return $this->CI->db->get()->result();
    }

    public function usermenu_app($groupId) {
        $this->CI->db->select("m.`menu_id` AS identifier, m.`menu_parent_id` AS parent_id,
                                m.`menu_nama` AS menu,
                                m.`menu_css_clip` AS css_clip,,
                                IF(ISNULL(m.`controller_id`),mo.`module_nama`,mo1.`module_nama`) AS `module`", FALSE);
        $this->CI->db->from('ugmfw_group_menu as gm');
        $this->CI->db->join('ugmfw_group_menu_detil as gmd', 'gm.group_menu_id = gmd.group_menu_id', 'left');
        $this->CI->db->join('ugmfw_menu as m', 'gmd.menu_id = m.menu_id', 'left');
        $this->CI->db->join('ugmfw_module_detil as md', 'm.module_detil_id = md.module_detil_id', 'left');
        $this->CI->db->join('ugmfw_controller as c', 'md.controller_id = c.controller_id', 'left');
        $this->CI->db->join('ugmfw_module as mo', 'c.module_id = mo.module_id', 'left');
        $this->CI->db->join('ugmfw_controller as c1', 'm.controller_id = c1.controller_id', 'left');
        $this->CI->db->join('ugmfw_module as mo1', 'c1.module_id = mo1.module_id', 'left');
        $this->CI->db->where('gm.group_menu_id', $groupId);
        $this->CI->db->group_by('m.menu_id');
        $this->CI->db->order_by("IF(m.`menu_parent_id` = 0, CONCAT(m.`menu_parent_id`,'.',m.`menu_sequence`), 
                                CONCAT(0,'.',(SELECT menu_sequence FROM ugmfw_menu WHERE menu_id = m.menu_parent_id),'.',m.`menu_sequence`))");

        return $this->CI->db->get()->result();
    }

    public function user_access_right($groupId) {
        $this->CI->db->select("	mo.`module_nama` AS module,
				c.`controller_nama` AS controller,
				md.`module_detil_function` AS `function`,							  	
				'crud' AS controller_permissions,							  	
				md.`module_detil_is_ajax` AS is_ajax,
				md.`module_detil_permissions` AS function_permissions ", FALSE);
        $this->CI->db->from('ugmfw_group_menu as gm');
        $this->CI->db->join('ugmfw_group_menu_detil as gmd', 'gm.group_menu_id = gmd.group_menu_id');
        $this->CI->db->join('ugmfw_menu as m', 'gmd.menu_id = m.menu_id');
        $this->CI->db->join('ugmfw_controller c', 'm.controller_id = c.controller_id');
        $this->CI->db->join('ugmfw_module_detil as md', 'c.controller_id = md.controller_id');
        $this->CI->db->join('ugmfw_module as mo', 'md.module_id = mo.module_id');
        $this->CI->db->where('gm.group_menu_id', $groupId);
        $this->CI->db->group_by(['md.module_detil_id']);

        return $this->CI->db->get()->result();
    }

    public function menu() {
        return $this->usermenu($this->CI->session->userdata('__group_menu_id'));
    }

    public function access_right() {
        return $this->user_access_right(
                        ($this->CI->session->userdata('__group_menu_id')) ?
                        $this->CI->session->userdata('__group_menu_id') : 3);
    }

    public function select_function($module, $controller, $function) {
        $this->CI->db->select("md.*");
        $this->CI->db->from('ugmfw_module_detil as md');
        $this->CI->db->join('ugmfw_controller as c', 'md.controller_id = c.controller_id');
        $this->CI->db->join('ugmfw_module as mo', 'c.module_id = mo.module_id');
        $this->CI->db->where('mo.module_nama', $module);
        $this->CI->db->where('c.controller_nama', $controller);
        $this->CI->db->where('module_detil_function', $function);

        $query = $this->CI->db->get();
        $rs = [];
        if ($query->num_rows() > 0) {
            $rs = $query->row();
        }

        return $rs;
    }

    public function log_login($data) {
        if ($this->CI->db->get_where('ugmfw_log_login', ['user_id' => $data['user_id'], 'created_time' => $data['created_time']])->num_rows() === 0) {
            $this->CI->db->insert('ugmfw_log_login', $data);
        }
    }

    public function check_user_agent($param, $user) {
        $_ = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'Unidentified user agent';

        $__ = $this->CI->db->get_where('ugmfwm_sessions', ['user_id' => $user->user_id,
            'device_id' => $param['device_id']]);

        if ($param['device_id']) {
            if ($__->num_rows() > 0 && $__->row_array()['is_blacklist'] !== '1') {
                $this->CI->db->where('user_id', $user->user_id);
                $this->CI->db->where('device_id', $param['device_id']);
                $this->CI->db->update('ugmfwm_sessions', ['updated_by' => $user->user_id,
                    'updated_time' => $param['date_today']]);
                return ['uagent' => $_, 'platform' => 'app', 'sesId' => $__->row_array()['id']];
            } else if ($__->num_rows() > 0 && $__->row_array()['is_blacklist'] === '1') {
                return ['uagent' => $_, 'platform' => 'app', 'sesId' => 0];
            } else {
                $this->CI->db->insert('ugmfwm_sessions', ['user_id' => $user->user_id,
                    'device_id' => $param['device_id'], 'created_time' => $param['date_today']]);
                return ['uagent' => $_, 'platform' => 'app', 'sesId' => $this->CI->db->insert_id()];
            }
        } else {
            return ['uagent' => $_, 'platform' => 'browser', 'sesId' => NULL];
        }
    }

}
