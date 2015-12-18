<?php

class Sess extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array(
            "sess" => "taywan kamolwilad",
            "sess_type" => "admmin"
        );
        $this->session->set_userdata($data);
        $this->load->view("sess");
    }

}