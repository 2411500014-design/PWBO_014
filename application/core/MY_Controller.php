<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    /**
     * Flip this to FALSE in child controllers that should remain publicly accessible.
     * Login and other guest-only pages can opt-out by setting $requires_auth = FALSE.
     */
    protected $requires_auth = TRUE;

    public function __construct()
    {
        parent::__construct();

        // Make sure session library is available even if a controller forgets to load it.
        $this->load->library('session');

        if ($this->requires_auth && !$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }
}



