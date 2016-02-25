<?php

class ciHelper
{
    private $ci = null;
    function __construct()
    {
        $this->ci =& get_instance();
    }
    public function get_ci()
    {
        return $this->ci;
    }
    public function set_header_title($name)
    {
        $this->ci->header_title = $name;
    }
    public function get_header_title()
    {
        return $this->ci->header_title;
    }
}

function loadHeader()
{
    $ci = new ciHelper();
    $ci->get_ci()->load->view('header.php');
}

function loadFooter()
{
    $ci = new ciHelper();
    $ci->get_ci()->load->view('footer.php');
}

function setHeaderTitle($name)
{
    $ci = new ciHelper();
    $ci->set_header_title($name);
}

function getHeaderTitle()
{
    $ci = new ciHelper();
    return $ci->get_header_title();
}

function getDateNow()
{
    $ci = new ciHelper();
    return $ci->date('Y-m-d H:i:s');
}


?>
