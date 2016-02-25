<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bogie extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Bogie_Model");
	}

	private function getData_Pagination($per_page, $segment)
	{
		return $this->db->select("*")->from($this->Bogie_Model->GetEntityName())->limit($per_page, $segment)->get()->result();
	}

	public function index()
	{
		setHeaderTitle('ข้อมูลโบกี้');

		//authorize
		//$this->aauth->allow_group('public','travel');

		//load plug-in
		$this->load->library('pagination');
		$config['base_url'] = base_url()."bogie/index";
		$config['per_page'] = 10;
		$config['total_rows'] = $this->Bogie_Model->GetCount();

		/*
		$config["full_tag_open"] = "<div class='pagination'>";
		$config["full_tag_close"] = "</div>";
		*/


		$config["full_tag_open"] = "<div class='btn-group'>";
		$config["full_tag_close"] = "</div>";
		$config["cur_tag_open"] = "<div class='btn btn-danger disabled'>";
		$config["cur_tag_close"] = "</div>";
		$config['attributes'] = array('class' => 'btn btn-default');


		$config["first_url"] = "";
		$this->pagination->initialize($config);

		//query data
		$data['bogies'] = $this->getData_Pagination($config['per_page'], $this->uri->segment(3));

		loadHeader();
		$this->load->view('bogie/index', $data);
		loadFooter();
	}

	public function add()
	{
		setHeaderTitle('Member - Add New');

		//authorize
		//$this->aauth->allow_group('admin');

		//post
		if($this->input->post('btsave') != null) {
			$data = array(
					'BOGIE_NAME_TH' => $this->input->post('name_th'),
					'BOGIE_NAME_EN' => $this->input->post('name_en'),
					'BOGIE_SHORT_NAME_TH' => $this->input->post('short_name_th'),
					'BOGIE_SHORT_NAME_EN' => $this->input->post('short_name_en'),
					'CREATE_DATE' => $this->Now(),
					'CREATE_USER' => GetCurr_UserLoginID()
			);

			$this->Bogie_Model->Insert($data);

			redirect('bogie', 'refresh');
			exit();
		}

		//get
		loadHeader();
		$this->load->view('bogie/add');
		loadFooter();
	}

	public function edit($id)
	{
		setHeaderTitle('แก้ไขข้อมูลโบกี้');

		if($this->input->post('btsave') != null) {
			$data = array(
					'BOGIE_NAME_TH' => $this->input->post('name_th'),
					'BOGIE_NAME_EN' => $this->input->post('name_en'),
					'BOGIE_SHORT_NAME_TH' => $this->input->post('short_name_th'),
					'BOGIE_SHORT_NAME_EN' => $this->input->post('short_name_en'),
					'UPDATE_DATE' => $this->Now(),
					'UPDATE_USER' => GetCurr_UserLoginID()
			);

			$this->Bogie_Model->Update($id, $data);

			redirect('bogie', 'refresh');
			exit();
		}

		$bogie = $this->Bogie_Model->GetData($id);

		loadHeader();
		$this->load->view('bogie/edit', array('bogie' => $bogie));
		loadFooter();
	}

	public function del($id, $page = null)
	{
		$this->Bogie_Model->Delete($id);
		if ($page == null){
			redirect('bogie/index', 'refresh');
		} else {
			redirect('bogie/index/' . $page, 'refresh');
		}
		exit();
	}
}
