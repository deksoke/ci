<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

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
	}

	private function getData()
	{
		return $this->db
				->get('tb_member')
				->result();
	}
	private function getDataById($id)
	{
		return $this->db
				->select('*')
				->from('tb_member')
				->where('id', $id)
				->get()
				->row();
	}
	private function getData_Pagination($per_page, $segment)
	{
		return $this->db->select("*")->from("tb_member")->limit($per_page, $segment)->get()->result();
	}

	public function index()
	{
		setHeaderTitle('Member');


		//authorize
		//$this->aauth->allow_group('public','travel');

		//load plug-in
		$this->load->library('pagination');
		$config['base_url'] = base_url()."member/index";
		$config['per_page'] = 10;
		$config['total_rows'] = $this->db->count_all("tb_member");

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
		$data['members'] = $this->getData_Pagination($config['per_page'], $this->uri->segment(3));

		loadHeader();
		$this->load->view('member/index', $data);
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
					'member_name' => $this->input->post('member_name'),
					'member_tel' => $this->input->post('member_tel'),
					'member_addr' => $this->input->post('member_addr')
			);
			$this->db->insert('tb_member', $data);
			redirect('member', 'refresh');
			exit();
		}

		//get
		loadHeader();
		$this->load->view('member/add');
		loadFooter();
	}

	public function edit($id)
	{
		setHeaderTitle('Member - Edit');

		if($this->input->post('btsave') != null) {
			$data = array(
					'member_name' => $this->input->post('member_name'),
					'member_tel' => $this->input->post('member_tel'),
					'member_addr' => $this->input->post('member_addr')
			);

			$this->db->where('id', $id);
			$this->db->update('tb_member', $data);
			redirect('member', 'refresh');
			exit();
		}

		$member = $this->getDataById($id);

		loadHeader();
		$this->load->view('member/edit', array('member' => $member));
		loadFooter();
	}

	public function del($id, $page)
	{
		$this->db->where('id', $id);
		$this->db->delete('tb_member');
		redirect('member/index/'.$page, 'refresh');
		exit();
	}
}
