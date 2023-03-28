<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function cas_show_config_error() {
    show_error("CAS authentication is not properly configured.<br /><br />
	Please, check your configuration for the following file:
	<code>config/cas.php</code>
	The minimum configuration requires:
	<ul>
	   <li><em>cas_server_url</em>: the <strong>URL</strong> of your CAS server</li>
	   <li><em>phpcas_path</em>: path to a installation of
	       <a href=\"https://wiki.jasig.org/display/CASC/phpCAS\">phpCAS library</a></li>
	    <li>and one of <em>cas_disable_server_validation</em> and <em>cas_ca_cert_file</em>.</li>
	</ul>
	");
}

/**
 * Cas
 * 
 * https://github.com/eliasdorneles/code-igniter-cas-library
 */
class Cas {

    public function __construct() {
        if (!function_exists('curl_init')) {
            show_error('<strong>ERROR:</strong> You need to install the PHP module
				<strong><a href="http://php.net/curl">curl</a></strong> to be able
				to use CAS authentication.');
        }
        $CI = & get_instance();
        $this->CI = $CI;
        $CI->config->load('cas');
        
        if (empty($CI->config->item('phpcas_path'))
                or filter_var($CI->config->item('cas_server_url'), FILTER_VALIDATE_URL) === FALSE) {
            cas_show_config_error();
        }
        
        if (!file_exists($CI->config->item('phpcas_path'))) {
            show_error("<strong>ERROR:</strong> Could not find a file <em>CAS.php</em> in directory
				<strong>phpcas_path</strong><br /><br />
				Please, check your config file <strong>config/cas.php</strong> and make sure the
				configuration <em>phpcas_path</em> is a valid phpCAS installation.");
        }
        require_once $CI->config->item('phpcas_path');
        if ($CI->config->item('cas_debug')) {
            phpCAS::setDebug();
        }
        
        $defaults = array('path' => $CI->config->item('cas_context'), 'port' => $CI->config->item('cas_port'));
        $cas_url = array_merge($defaults, parse_url($CI->config->item('cas_server_url')));
        phpCAS::client(CAS_VERSION_2_0, $CI->config->item('cas_host'), $CI->config->item('cas_port'), $CI->config->item('cas_context'), false);
        // configures SSL behavior
        if ($CI->config->item('cas_disable_server_validation')) {
            phpCAS::setNoCasServerValidation();
        } else {
            $ca_cert_file = $CI->config->item('cas_server_ca_cert');
            if (empty($ca_cert_file)) {
                cas_show_config_error();
            }
            phpCAS::setCasServerCACert($ca_cert_file);
        }
    }

    public function force_auth() {
        phpCAS::forceAuthentication();
    }

    public function user() {
        if (phpCAS::isAuthenticated()) {
            $userlogin = phpCAS::getUser();
            $attributes = phpCAS::getAttributes();
            return array('userlogin' => $userlogin,
                        'attributes' => $attributes);
        } else {
            show_error("User was not authenticated yet.");
        }
    }

    public function logout($url = '') {
        if (empty($url)) {
            $this->CI->load->helper('url');
            $url = base_url();
        }
        phpCAS::logoutWithRedirectService($url);
    }

    public function is_authenticated() {
        return phpCAS::isAuthenticated();
    }

}
