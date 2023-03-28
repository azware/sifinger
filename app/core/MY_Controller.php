<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'third_party/MX/Controller.php';

class MY_Controller extends MX_Controller {

    private $_ci;
    public $user_id;
    public $user_id_encrypt;
    public $date_today;
    public $user_email;

    public function __construct() {
        parent::__construct();
        $this->_ci = & get_instance();
        if ($this->config->item('layout_folder')) {
            $this->template->set_layout_folder($this->config->item('layout_folder'));
        }
        if ($this->config->item('layout')) {
            $this->template->set_layout($this->config->item('layout'));
        }

        $this->initialize();
    }

    public function debugToFile($params) {
        fwrite(fopen("debug.txt", "w"), print_r($params, TRUE));
    }

    public function info($m) {
        echo "<script language=\"javascript\">$('#subcontent-element').html('<div class=\"page-header\">"
        . "<div class=\"row\"><h1 class=\"col-xs-12 col-sm-12 text-center text-left-sm\">"
        . "<i class=\"fa fa-unlink page-header-icon\"></i>"
        . "&nbsp;Error Occured</h1></div></div>"
        . "<div class=\"note note-danger\">$m</div>');</script>";
        die($this->_ci->template->load_view('errors/html/error_info', array(
                    'title' => NULL,
                    'description' => NULL,
                    'metadata' => NULL,
                    'js' => NULL,
                    'css' => NULL,
                    'content' => $m,
                        ), TRUE));
    }

    private function initialize() {
        date_default_timezone_set($this->config->item('timezone'));
        $this->user_id = $this->session->userdata('__user_id');
        $this->user_email = $this->session->userdata('__email');
        $this->user_id_encrypt = $this->encryption_lib->urlencode($this->user_id);
        $this->date_today = date("Y-m-d H:i:s");
    }

}

/**
 * Class UGM_Controller
 * @created on : 2015-04-07 10:01:00
 * @author Cicuk Kriswanto <cicuk.kriswanto@ugm.ac.id>
 * Bayu Prasetiyo Utomo <bayuprasetiyo.utomo@ugm.ac.id>
 * DSDI-UGM
 */
class UGM_Controller extends MY_Controller {

    public function __construct() {
        parent::__construct();

        if ($this->config->item('debug')) {
            $this->output->enable_profiler(TRUE);
        }
        
        $this->access_right();
    }

    private function access_right() {
        $module = $this->router->module;
        $controller = $this->router->class;
        $function = $this->router->method;

        $arrayControllerByPass = array('modal');
        if (in_array($controller, $arrayControllerByPass)) {
            return TRUE;
        }
        
        if($function === 'index') {
            return TRUE;
        }

        $arrayModuleAndControllerByPass = array(
            array('module' => 'ugmfw', 'controller' => 'change_group'));

        foreach ($arrayModuleAndControllerByPass as $obj) {
            if ($obj['module'] === $module && $obj['controller'] === $controller) {
                return TRUE;
            }
        }

        $arrUserAccess = $this->user_auth_lib->access_right();

        $permission = TRUE;
        $modulePermission = FALSE;
        $controllerPermission = FALSE;
        $functionRegistered = FALSE;

        foreach ($arrUserAccess as $userAccess) {
            if ($userAccess->module === $module) {
                $modulePermission = TRUE;
                if ($userAccess->controller === $controller) {
                    if (!empty($userAccess->controller_permissions)) {
                        $controllerPermission = TRUE;
                        if ($function === "index") {
                            $functionRegistered = TRUE;
                            break;
                        } else {
                            if ($userAccess->function === $function) {
                                if (!empty($userAccess->function)) {
                                    $functionRegistered = TRUE;
                                    $arrFunctionPermissions = str_split(strtolower($userAccess->function_permissions));
                                    foreach ($arrFunctionPermissions as $functionPermission) {
                                        if ($functionPermission !== 'x') {
                                            if (!(strpos($userAccess->controller_permissions, $functionPermission) !== FALSE)) {
                                                $permission = FALSE;
                                                break;
                                            }
                                        }
                                    }
                                } else {
                                    $functionRegistered = FALSE;
                                }
                                break;
                            }
                        }
                    } else {
                        $controllerPermission = FALSE;
                        break;
                    }
                }
            }
        }

        if (!$modulePermission) {
            if (!$this->input->is_ajax_request()) {
                show_404('', FALSE);
            } else {
                $this->response_ajax_not_permission();
            }
        }

        if (!$controllerPermission) {
            if (!$this->input->is_ajax_request()) {
                show_404('', FALSE);
            } else {
                $this->response_ajax_not_permission();
            }
        }

        if (!$functionRegistered) {
            $permission = FALSE;
        }

        if (!$permission) {
            if (!$this->input->is_ajax_request()) {
                show_404('', FALSE);
            } else {
                $this->response_ajax_not_permission();
            }
        }
    }

    private function response_ajax_not_permission() {
        $this->load->library('ugmfw/response');
        $this->response->reload_page();
        $this->response->send();
    }

}
