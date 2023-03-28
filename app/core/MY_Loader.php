<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Loader class */
require APPPATH . "third_party/MX/Loader.php";

class MY_Loader extends MX_Loader {

    protected $_controller;

    public function __construct() {
        parent::__construct();
        $this->_controller = CI::$APP->router->class;
    }

    public function view($view, $vars = array(), $return = FALSE) {
        if ($this->_controller === 'modal') {
            $this->_controller = $this->session->userdata('_controller');
        }

        list($path, $_view) = Modules::find($view, $this->_module, 'views/' . $this->_controller . '/');

        if ($path != TRUE) {
            list($path, $_view) = Modules::find($view, $this->_module, 'views/');
        }

        if ($path != FALSE) {
            $this->_ci_view_paths = array($path => TRUE) + $this->_ci_view_paths;
            $view = $_view;
        }

        return $this->_ci_load(array('_ci_view' => $view, '_ci_vars' => $this->_ci_prepare_view_vars($vars), '_ci_return' => $return));
    }

    public function get_user_image() {
        return ($this->session->userdata('__img')) ?
                (file_exists($this->config->item('upload_simaster_user') . '' . $this->session->userdata('__img')) === true) ?
                $this->data_uri($this->config->item('upload_simaster_user') . '' . $this->session->userdata('__img'), mime_content_type($this->config->item('upload_simaster_user') . '' . $this->session->userdata('__img'))) :
                site_url('ugmfw-assets/images/user-icon.png') : site_url('ugmfw-assets/images/user-icon.png');
    }

    protected function data_uri($file, $mime) {
        $contents = file_get_contents($file);
        $base64 = base64_encode($contents);

        return ('data:' . $mime . ';base64,' . $base64);
    }

    protected function header() {
        $data['access'] = $this->user_auth_lib->select_user_access_by_user_id($this->session->userdata('__user_id'));
        $data['user_image'] = $this->get_user_image();

        $this->load->view('ugmfw/header/view_header', $data);
    }

    protected function menu() {
        $data['menu'] = $this->get_menu();
        $data['user_image'] = $this->get_user_image();
        
        $this->load->view('ugmfw/nav_menu/view_nav_menu', $data);
    }

    protected function breadcrump() {
        $module = $this->router->module;
        $controller = $this->router->class;
        $function = $this->router->method;

        $data['function'] = $this->user_auth_lib->select_function($module, $controller, $function);

        $this->load->view('ugmfw/breadcrump/view_breadcrump', $data);
    }

    private function get_menu() {
        $module = $this->router->module;
        $controller = $this->router->class;
        $function = $this->router->method;

        $menu = $this->user_auth_lib->menu();

        while (1) {
            foreach ($menu as $row) {
                if (isset($idMenu)) {
                    if ($row->id === $idMenu) {

                        if (isset($aktif)) {
                            $row->open = 1;
                        } else {
                            $row->aktif = 1;
                            $aktif = 1;
                        }

                        if ($row->parent_id != 0) {
                            $idMenu = $row->parent_id;
                            break;
                        }
                        return $menu;
                    }
                } else {
                    // ambil id menu aktif
                    if ($row->module === $module && $row->controller === $controller && $row->function === $function) {
                        $idMenu = $row->id;
                        break;
                    }

                    if ($row->module === $module && $row->controller === $controller && $row->function === '') {
                        $idControllerMenu = $row->id;
                    }
                }
            }

            if (!isset($idMenu)) {
                //jika id menu aktif tidak ketemu ambil id module
                if (isset($idControllerMenu)) {
                    $idMenu = $idControllerMenu;
                } else {
                    return $menu;
                }
            }
        }
    }

}
