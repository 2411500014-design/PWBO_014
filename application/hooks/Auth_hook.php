<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_hook
{
    /**
     * Controllers that can be accessed without authentication.
     *
     * @var array<int, string>
     */
    protected $public_controllers = ['login'];

    public function check_login(): void
    {
        if (is_cli()) {
            return;
        }

        $CI =& get_instance();

        if (!$CI) {
            return;
        }

        $router = $CI->router ?? null;
        if (!$router) {
            return;
        }

        $class = strtolower($router->fetch_class());

        if (in_array($class, $this->public_controllers, TRUE)) {
            return;
        }

        // Session is autoloaded but explicitly ensure it exists before checking.
        $CI->load->library('session');

        if (!$CI->session->userdata('logged_in')) {
            redirect('login');
            exit;
        }
    }
}

