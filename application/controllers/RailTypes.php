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

        $this->load->model("RailType_Model");
        $this->load->model("Bogie_Model");
    }


    public function railtypes_get()
    {
        $datas = null;
        $id = $this->get("id");

        if ($id === NULL)
        {
            $datas = $this->RailType_Model->GetData();
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

        $id = (int)$id;
        if ($id <= 0)
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code

        $rail = $this->RailType_Model->GetDataById($id);
        if (!empty($rail))
        {
            $rail->BOGIES_USAGE = $this->Bogie_Model->GetBogiesUsage_By_RailTypeId($id);
            $this->set_response($rail, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Data could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }


    public function railtypes_post()
    {
        $entity = $this->_post_args;
        $bogies = $entity['BOGIES_USAGE'];
        $this->Bogie_Model->Insert($entity);
        $id = $this->Bogie_Model->GetInsertId();

        foreach ($bogies as $key => $bogie) {
            $bogie_usage = array(
                "RAILTYPE_ID" => $id,
                "BOGIE_ID" => $bogie['BOGIE_ID'],
            );
            $this->RailType_Bogies->Insert($bogie_usage); //insert new bogie
        }

        $message = [
            'status' => true,
            'message' => 'Added a resource'
        ];

        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }

    public function railtypes_put()
    {
        $id = (int)$this->get('id');
        $entity = $this->_put_args;
        $bogies = $entity['BOGIES_USAGE'];
        $this->Bogie_Model->Insert($entity);

        $condition = array('RAILTYPE_ID' => $id);
        $this->RailType_Bogies->Delete($condition); //clear all old bogie of this railtype

        foreach ($bogies as $key => $bogie) {
            $bogie_usage = array(
                "RAILTYPE_ID" => $id,
                "BOGIE_ID" => $bogie->ID,
            );
            $this->RailType_Bogies->Insert($bogie_usage); //insert new bogie
        }

        $message = [
            'status' => true,
            'message' => 'Added a resource'
        ];

        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }
}