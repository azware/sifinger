<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Template {

    public $_ci;
    protected $brand_name = 'UGM Framework';
    protected $title_separator = ' - ';
    protected $ga_id = FALSE;
    protected $layout_folder = 'layouts/default/';
    protected $layout = 'template';
    protected $title = FALSE;
    protected $body_class = '';
    protected $metadata = array();
    protected $js = array();
    protected $css = array();

    function __construct() {
        $this->_ci = & get_instance();

        if ($this->_ci->session->userdata('__platform') === 'app') {
            $this->set_layout('android');
        }
    }

    public function set_layout($layout) {
        $this->layout = $layout;
    }

    public function set_body_class($bodyClass) {
        $this->body_class = $bodyClass;
    }

    public function set_layout_folder($path) {
        $this->layout_folder = $path;
    }

    public function set_title($title) {
        $this->title = $title;
    }

    public function add_metadata($name, $content) {
        $name = htmlspecialchars(strip_tags($name));
        $content = htmlspecialchars(strip_tags($content));

        $this->metadata[$name] = $content;
    }

    public function add_js($js) {
        $this->js[$js] = $js;
    }

    public function add_css($css) {
        $this->css[$css] = $css;
    }

    public function load_view($view, $data = array(), $return = FALSE) {
        if ($this->_ci->input->is_ajax_request()) {
            $this->_ci->load->view($view, $data);
        } else {
            if (empty($this->title)) {
                $title = $this->brand_name;
            } else {
                $title = $this->title . $this->title_separator . $this->brand_name;
            }

            $metadata = array();
            foreach ($this->metadata as $name => $content) {
                if (strpos($name, 'og:') === 0) {
                    $metadata[] = '<meta property="' . $name . '" content="' . $content . '">';
                } else {
                    $metadata[] = '<meta name="' . $name . '" content="' . $content . '">';
                }
            }
            $metadata = implode('', $metadata);

            $js = array();
            foreach ($this->js as $js_file) {
                $js[] = '<script src="' . base_url() . 'ugmfw-assets/javascripts/' . $js_file . '" type="text/javascript"></script>';
            }
            $js = implode('', $js);

            $css = array();
            foreach ($this->css as $css_file) {
                $css[] = '<link type="text/css" rel="stylesheet" href="' . base_url() . 'ugmfw-assets/stylesheets/' . $css_file . '"/>';
            }
            $css = implode('', $css);
            $main_content = $this->_ci->load->view($view, $data, TRUE);

            return $this->_ci->load->view($this->layout_folder . $this->layout, array(
                        'title' => $title,
                        'metadata' => $metadata,
                        'js' => $js,
                        'css' => $css,
                        'body_class' => $this->body_class,
                        'content' => $main_content,
                            ), $return);
        }
    }

    function is_ajax() {
        return(
                $this->_ci->input->server('HTTP_X_REQUESTED_WITH') && ($this->_ci->input->server('HTTP_X_REQUESTED_WITH') == 'XMLHttpRequest'));
    }

}

/* End of file Template.php */
/* Location: ./application/libraries/Template.php */