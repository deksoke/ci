<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class Bogies extends REST_Controller
{
    var $authorization = null;

    function __construct()
    {
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['bogie_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['bogie_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['bogie_put']['limit'] = 50; // 50 requests per hour per user/key
        $this->methods['bogie_delete']['limit'] = 50; // 50 requests per hour per user/key

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

        if ($_SERVER['REQUEST_METHOD'] === "OPTIONS")
            die();
        /*
        if(!$this->input->get_request_header('Authorization'))
            $this->response(null, 400);
        $this->authorization = $this->input->get_request_header('Authorization');
        */

        $this->load->model("Bogie_Model");
    }

    public function bogies_get()
    {
        $bogies = null;

        $id = $this->get('id');

        if ($id === NULL) {
            $bogies = $this->Bogie_Model->GetData();
            $dataItem = [
                'next' => '',
                'prev' => '',
                'count' => sizeof($bogies),
                'results' => $bogies
            ];
            $this->response($dataItem, REST_Controller::HTTP_OK); // OK (200)

            if ($bogies == null) {
                $this->response([
                    'status' => FALSE,
                    'message' => 'No data were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404)
            }
        }

        $id = (int)$id;
        if ($id <= 0) {
            $message = [
                'status' => false,
                'message' => 'incorrect id'
            ];
            $this->response($message, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400)
        }

        $bogie = $this->Bogie_Model->GetDataById($id);
        if (!empty($bogie)) {
            $this->set_response($bogie, REST_Controller::HTTP_OK); // OK (200)
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'data could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404)
        }
    }

    public function bogies_post()
    {

        $entity = $this->_post_args;
        $entity['ID'] = NULL;
        $entity['CREATE_DATE'] = getDateNow();
        $entity['CREATE_USER'] = GetCurr_UserLoginID();
        $entity['UPDATE_DATE'] = NULL;
        $entity['UPDATE_USER'] = NULL;

        $this->Bogie_Model->Insert($entity);
        $entity['ID'] = $this->Bogie_Model->GetInsertId();

        $message = [
            'status' => true,
            'message' => 'data was added',
            'entity' => $entity
        ];

        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201)
    }

    public function bogies_put()
    {
        $id = (int)$this->get('id');

        if ($id <= 0) {
            $message = [
                'status' => false,
                'message' => 'incorrect id'
            ];
            $this->response($message, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400)
        }

        $entity = $this->_put_args;
        $entity['UPDATE_DATE'] = getDateNow();
        $entity['UPDATE_USER'] = GetCurr_UserLoginID();
        $this->Bogie_Model->Update($entity, $id);

        $message = [
            'status' => true,
            'message' => 'data was updated',
            'result' => $entity
        ];

        $this->set_response($message, REST_Controller::HTTP_OK); // OK (200)
    }

    public function bogies_delete()
    {
        $id = (int)$this->get('id');

        if ($id <= 0) {
            $message = [
                'status' => false,
                'message' => 'incorrect id'
            ];
            $this->response($message, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400)
        }

        $this->Bogie_Model->Delete($id);
        $message = [
            'status' => true,
            'message' => 'data was deleted'
        ];

        $this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204)
    }
}