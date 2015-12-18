<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function signIn()
    {
        setHeaderTitle('Login');

        if ($this->input->post('btSubmit') != null)
        {
            $result = $this->aauth->login($this->input->post('email'), $this->input->post('password'));
            if($result) {
                redirect('member');
                exit();
            }
            echo "password incorrect !!";
            exit();
        }

        loadHeader();
        $this->load->view('auth/signin');
        loadFooter();
    }
    public function signUp()
    {
        setHeaderTitle('Sign Up - Create New User');

        if ($this->input->post('btSubmit') != null)
        {
            $email = $this->input->post('email');
            $pass = $this->input->post('password');
            $name = $this->input->post('name');

            try
            {
                $this->aauth->create_user($email, $pass, $name);
            }
            catch (Exception $e)
            {
                redirect('auth/signup', array('err' => $e));
                exit();
            }

            redirect('auth/signin', 'refresh');
            exit();
        }

        loadHeader();
        $this->load->view('auth/signup');
        loadFooter();
    }
    public function signOut()
    {
        if($this->aauth->is_loggedin()){
            $this->aauth->logout();
            redirect('auth/signin', 'refresh');
        }
    }

    public function profile()
    {
        setHeaderTitle('Edit Profile');

        if ($this->input->post('btSubmit') != null)
        {
            //get user data
            $email = $this->input->post('email');
            $pass = $this->input->post('password');
            $name = $this->input->post('name');

            //get user_id from database
            $user_id = $this->aauth->get_user()->id;

            $this->aauth->update_user($user_id, $email);
            redirect('member','refresh');
            exit();
        }

        $data['member'] = $this->aauth->get_user();

        loadHeader();
        $this->load->view('auth/signup', $data);
        loadFooter();
    }

}