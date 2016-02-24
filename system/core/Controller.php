<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		http://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

	/**
	 * Reference to the CI singleton
	 *
	 * @var	object
	 */
	private static $instance;

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		self::$instance =& $this;

		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');
		$this->load->initialize();
		log_message('info', 'Controller Class Initialized');
	}

	// --------------------------------------------------------------------

	/**
	 * Get the CI singleton
	 *
	 * @static
	 * @return	object
	 */
	public static function &get_instance()
	{
		return self::$instance;
	}

}


interface iMY_CI_Controller
{
	public function Get($id = null);
	public function GetCount();
	public function Insert($entity);
	public function Update($id, $entity);
	public function Delete($id);
}

class MY_CI_Controller extends CI_Controller implements iMY_CI_Controller
{
	protected $entity_name = '';
	protected $identity_col = '';

	function __construct($entityName, $identityCol)
	{
		parent::__construct();
		$this->entity_name = $entityName;
		$this->identity_col = $identityCol;
	}

	public function Now(){
		return date("Y-m-d H:i:s");
	}

	public function Get($id = null)
	{
		// TODO: Implement Get() method.
		if($id == null)
		{
			//____/Get

			return $this->db->get($this->entity_name)->result();
		}
		else
		{
			//____/Get/$id

			$result = $this->db->where($this->identity_col, $id)->get($this->entity_name)->row();
			if($result)
			{
				return $result;
			}
			Response_DataNotFound();
		}
	}

	public function GetCount()
	{
		// TODO: Implement GetCount() method.
		return $this->db->count_all($this->entity_name);
	}

	public function Insert($entity)
	{
		// TODO: Implement Add() method.
		$this->db->insert($this->entity_name, $entity);
		return $this->db->insert_id();
	}

	public function Update($id, $entity)
	{
		// TODO: Implement Edit() method.
		$this->db->where($this->identity_col, $id)
				->update($this->entity_name, $entity);
	}

	public function Delete($id)
	{
		// TODO: Implement Del() method.
		$this->db->where($this->identity_col, $id)
				->delete($this->entity_name);
	}

}

interface iMY_API_CI_Controller
{
	public function Get($id=null);
	public function Add($entity);
	public function Edit($id, $entity);
	public function Delete($id);
}

class MY_API_CI_Controller extends CI_Controller implements iMY_API_CI_Controller
{
	protected $entity_name = '';
	protected $identity_col = '';

	function __construct($entityName, $identityCol)
	{
		parent::__construct();
		$this->entity_name = $entityName;
		$this->identity_col = $identityCol;
	}

	private function CreateSuccessMessage($entities = null, $message='ทำรายการสำเร็จ')
	{
		return array (
				'status' => 'success',
				'message' => $message,
				'data' => $entities
		);
	}
	private function CreateFailMessage($message='เกิดข้อผิดพลาด ทำรายการไม่สำเร็จ')
	{
		return array (
				'status' => 'fail',
				'message' => $message
		);
	}
	private function IsPostRequest()
	{
		return $_SERVER['REQUEST_METHOD'] === 'POST' ? true : false;
	}
	private function IsGetRequest()
	{
		return $_SERVER['REQUEST_METHOD'] === 'GET' ? true : false;
	}


	public function Index()
	{
		$this->Get();
	}

	public function Get($id = null)
	{
		// TODO: Implement Get() method.
		try
		{
			if (!$this->IsPostRequest())
			{
				Response_Unauthorized();
				exit();
			}


			if($id == null)
			{
				//____/Get
				$results = $this->db->get($this->entity_name)->result();
				echo json_encode($this->CreateSuccessMessage($results));
			}
			else
			{
				//____/Get/$id
				$result = $this->db->where($this->identity_col, $id)->get($this->entity_name)->row();
				if($result != null)
				{
					echo json_encode($this->CreateSuccessMessage($result));
					exit();
				}
				echo json_encode($this->CreateFailMessage('ไม่พบข้อมูล'));
			}
		}
		catch(Exception $e)
		{
			echo json_encode($this->CreateFailMessage($e->getMessage()));
		}
	}

	public function Add($entity)
	{
		// TODO: Implement Add() method.
		try
		{
			if (!$this->IsPostRequest() || !$this->aauth->is_loggedin())
			{
				Response_Unauthorized();
				exit();
			}

			$this->db->insert($this->entity_name, $entity);
			echo json_encode($this->db->insert_id() > 0 ? $this->CreateSuccessMessage() : $this->CreateFailMessage());
		}
		catch(Exception $e)
		{
			echo json_encode($this->CreateFailMessage($e->getMessage()));
		}
	}

	public function Edit($id, $entity)
	{
		// TODO: Implement Edit() method.
		try
		{
			$this->db->where($this->identity_col, $id)
					->update($this->entity_name, $entity);
			return json_encode($this->db->affected_rows() > 0 ? $this->CreateSuccessMessage() : $this->CreateFailMessage());
		}
		catch(Exception $e)
		{
			echo json_encode($this->CreateFailMessage($e->getMessage()));
		}
	}

	public function Delete($id)
	{
		// TODO: Implement Del() method.
		try
		{
			$this->db->where($this->identity_col, $id)
					->delete($this->entity_name);
			return json_encode($this->db->affected_rows() > 0 ? $this->CreateSuccessMessage() : $this->CreateFailMessage());
		}
		catch(Exception $e)
		{
			echo json_encode($this->CreateFailMessage($e->getMessage()));
		}
	}

}