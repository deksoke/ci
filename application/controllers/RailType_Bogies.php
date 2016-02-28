<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class RailTypes extends REST_Controller
{
    function __construct()
    {
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['user_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; // 50 requests per hour per user/key

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, DELETE");

        if ($_SERVER['REQUEST_METHOD'] === "OPTIONS")
            die();

        $this->load->model("RailType_Model");
        $this->load->model("Bogie_Model");
    }


    public function railtype_bogies_get()
    {
        $datas = null;
        $id = (int) $this->get("id");

        if ($id === NULL)
        {
            $datas->BOGIES_USAGE = $this->Bogie_Model->GetBogiesUsage_By_RailTypeId($id);
            if ($datas)
            {
                $dataItem = [
                    'next' => '',
                    'prev' => '',
                    'count' => sizeof($datas),
                    'results' => $datas
                ];
                $this->response($dataItem, REST_Controller::HTTP_OK); // OK (200)
            }
            else
            {
                $this->response([
                    'status' => FALSE,
                    'message' => 'No data were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }
    }


    public function railtype_bogies_post()
    {
        $entity = $this->_post_args;
        $bogies = $entity['BOGIES_USAGE'];
        $this->Bogie_Model->Insert($entity);
        $id = $this->Bogie_Model->GetInsertId();

        $i = 1;
        foreach ($bogies as $key => $bogie) {
            $bogie_usage = array(
                "RAILTYPE_ID" => $id,
                "BOGIE_ID" => $bogie['BOGIE_ID'],
                "ORDER_SEQ" => $i
            );
            $i += 1;
            $this->RailType_Bogies->Insert($bogie_usage); //insert new bogie
        }

        $message = [
            'status' => true,
            'message' => 'Added a resource'
        ];

        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }

    public function railtype_bogies_delete()
    {
        $id = (int)$this->get('id');

        if ($id <= 0) {
            $message = [
                'status' => false,
                'message' => 'incorrect id'
            ];
            $this->response($message, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400)
        }

        $this->RailType_Bogies_Model->Delete($id);
        $message = [
            'status' => true,
            'message' => 'data was deleted'
        ];

        $this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204)
    }
}