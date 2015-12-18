<?php

class Member extends MY_API_CI_Controller
{
    /**
     * Member constructor.
     */
    public function __construct()
    {
        parent::__construct('tb_member', 'id');
    }

}