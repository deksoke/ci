<?php

class Default_Model extends CI_Model implements iModel_Custom
{
    protected $tablename = 'user';
    protected $identity_col = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public function Get($id=null)
    {
        if ($id != null)
        {
            return $this->db->where($this->identity_col, $id)->get($this->tablename)->row();
        }
        return $this->db->get($this->tablename)->result();
    }

    public function Add($model)
    {
        if (is_null($model))
        {
            return false;
        }

    }

    public function Edit($model)
    {

    }

    public function Del($model)
    {

    }
}