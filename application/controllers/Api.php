<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Api extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['user_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; // 50 requests per hour per user/key


        $this->load->model("Bogie_Model");
        $this->load->model("RailType_Model");
    }

    public function bogies_get()
    {
        $bogies = null;

        $id = $this->uri->segment(3);

        if ($id === NULL)        {
            $bogies = $this->Bogie_Model->GetData();
            if ($bogies)            {
                $this->response($bogies, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }            else            {
                $this->response([
                    'status' => FALSE,
                    'message' => 'No data were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        $id = (int) $id;
        if ($id <= 0)
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code

        $bogie = $this->Bogie_Model->GetDataById($id);
        if (!empty($bogie)) {
            $this->set_response($bogie, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'User could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function bogies_post() {

        $entity = $this->post('data');
        $this->Bogie_Model->Insert($entity);

        $message = [
            'id' => 100, // Automatically generated by the model
            'name' => $this->post('name'),
            'email' => $this->post('email'),
            'message' => 'Added a resource'
        ];

        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }

    public function bogies_put() {
        $id = (int) $this->uri->segment(3);
        if ($id <= 0)
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code

        $entity = $this->post('data');

        $this->Bogie_Model->Update($id, $entity);

        $message = [
            'id' => 100, // Automatically generated by the model
            'name' => $this->post('name'),
            'email' => $this->post('email'),
            'message' => 'A resource has updated'
        ];

        $this->set_response($message, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
    }

    public function bogies_delete() {
        $id = (int) $this->uri->segment(3);

        if ($id <= 0)
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code

        $this->Bogie_Model->Delete($id);
        $message = [
            'id' => $id,
            'message' => 'the resource was deleted'
        ];

        $this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
    }


    //RailType
    public function railtypes_get()
    {
        $railTypes = null;

        $id = $this->uri->segment(3);
        if ($id === NULL)        {
            $railTypes = $this->RailType_Model->GetData();

            if ($railTypes) {
                foreach($railTypes as $key => $rail){
                    $rail->BOGIES_USAGE = $this->Bogie_Model->GetBogiesUsage_By_RailTypeId($rail->ID);
                }
                $this->response($railTypes, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'No data were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        $id = (int) $id;
        if ($id <= 0)
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code


        $rail = $this->RailType_Model->GetDataById($id);
        if (!empty($rail)) {
            $rail->BOGIES_USAGE = $this->Bogie_Model->GetBogiesUsage_By_RailTypeId($id);
            $this->set_response($rail, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Data could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }
}
