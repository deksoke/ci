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

function getDateNow()
{
    return date("Y-m-d H:i:s");
}

?>
