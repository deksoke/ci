<?php
class NotFound extends CI_Controller
{
  public function __construct()
  {
      parent::__construct();
  }
    public function Index()
    {
        loadHeader();
        $this->load->view('NotFound');
        loadFooter();
    }
}

?>