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
 * Model Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/config.html
 */
class CI_Model {

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		log_message('info', 'Model Class Initialized');
	}

	// --------------------------------------------------------------------

	/**
	 * __get magic
	 *
	 * Allows models to access CI's loaded classes using the same
	 * syntax as controllers.
	 *
	 * @param	string	$key
	 */
	public function __get($key)
	{
		// Debugging note:
		//	If you're here because you're getting an error message
		//	saying 'Undefined Property: system/core/Model.php', it's
		//	most likely a typo in your model code.
		return get_instance()->$key;
	}

}

interface iMy_CI_Model
{
	public function GetData($filter_or_id);
	public function GetDataById($id);
	public function GetCount($filter = null);
	public function Insert($entity);
	public function Update($id, $entity);
	public function Delete($condition_or_id);
}

class My_CI_Model extends CI_Model implements iMy_CI_Model {

	protected $entityName = null;
	protected $entityColId = null;

	public function __construct($entityName, $entityColId)
	{
		parent::__construct();

		$this->entityName = $entityName;
		$this->entityColId = $entityColId;
	}

	public function GetData($filter = null)	{
		if ($filter == null) {
			//nothing to do

		} else if (is_array($filter)) {
			$this->db->where($filter);

		} else {
			$this->db->where($this->entityColId, $filter);
		}
		return $this->db->get($this->entityName)->result();
	}

	public function GetDataById($id) {
		return $this->db->where($this->entityColId, $id)->get($this->entityName)->row();
	}

	public function GetCount($filter = null){
		if ($filter != null)
			$this->db->where($filter);

		return $this->db->get($this->entityName)->num_rows();
	}

	public function Insert($entity)	{
		$this->db->insert($this->entityName, $entity);
	}

	public function Update($id, $entity) {
		$this->db->where($this->entityColId, $id);
		$this->db->update($this->entityName, $entity);
	}

	public function Delete($condition)	{
		if (is_array($condition)){
			$this->db->where($condition);
		} else {
			$this->db->where($this->entityColId, $condition);
		}
		$this->db->delete($this->entityName);
	}

}
