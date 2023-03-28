<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Dialog {

    private $_ci;
    protected $data;

    function __construct() {
        $this->_ci = & get_instance();
    }

    public function set_id($id) {
        $this->data['id'] = $id;
    }

    public function set_title($title) {
        $this->data['title'] = $title;
    }

    public function set_body($body) {
        $this->data['body'] = $body;
    }

    public function set_content($content) {
        $this->data['content'] = $content;
    }

    public function add_button($type, $label = '', $class = null) {
        $button = '';
        switch ($type) {
            case 'ok':
                $label = (!empty($label)) ? $label : 'OK';
                $button = '<button class="btn btn-primary" type="button" data-dismiss="modal">' . $label . '</button>';
                break;
            case 'close':
                $label = (!empty($label)) ? $label : 'Close';
                $button = '<button class="btn btn-default" type="button" data-dismiss="modal">' . $label . '</button>';
                break;
            case 'submit':
                $label = (!empty($label)) ? $label : 'Submit';
                $button = '<button class="btn btn-' . $class . '" type="submit">' . $label . '</button>';
                break;
        }

        if (!empty($button)) {
            $this->data['buttons'][] = $button;
        }
    }

    public function set_footer($footer) {
        $this->data['footer'] = $footer;
    }

    public function set_size($size) {
        switch ($size) {
            case 'small':
                $this->data['size'] = 'modal-sm';
                break;
            case 'large':
                $this->data['size'] = 'modal-lg';
                break;
        }
    }

    public function html() {
        if (empty($this->data['id'])) {
            $this->data['id'] = 'dialog-' . mt_rand(1000000, 9999999);
        }
        return $this->_ci->load->view('dialog/dialog', $this->data, TRUE);
    }

    public function html_full() {
        if (empty($this->data['id'])) {
            $this->data['id'] = 'dialog-' . mt_rand(1000000, 9999999);
        }
        return $this->_ci->load->view('dialog/dialog_full', $this->data, TRUE);
    }

    public function html_alert() {
        if (empty($this->data['id'])) {
            $this->data['id'] = 'dialog-' . mt_rand(1000000, 9999999);
        }
        return $this->_ci->load->view('dialog/dialog_alert', $this->data, TRUE);
    }

}

/* End of file Dialog.php */
/* Location: ./application/libraries/Dialog.php */