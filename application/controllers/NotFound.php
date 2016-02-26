<?php
class NotFound extends CI_Controller
{
  public function __construct()
  {
      parent::__construct();
  }
    public function Index()
    {
        $this->load->view('NotFound');
    }
}

?>