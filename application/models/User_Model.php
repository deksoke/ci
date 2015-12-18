<?php

class User_Model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function AddUser($name, $city)
    {
        $data = array(
            'name' => $name,
            'city' => $city
        );
        $this->db->insert('user', $data);
        $identity_id = $this->db->insert_id();
        return $identity_id;
    }
}
