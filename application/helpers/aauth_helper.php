<?php

function GetCurr_UserLogin()
{
    $ci = new ciHelper();
    return $ci->get_ci()->aauth->get_user();
}

function GetCurr_UserLoginID()
{
    //$ci = new ciHelper();
    //return $ci->get_ci()->aauth->get_user()->id;
    return 3;
}

?>
