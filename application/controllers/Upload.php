<?php

class Upload extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        loadHeader();
        $this->load->view("upload/upload_form");
        loadFooter();
    }

    private function generateFileName($uploaded_object)
    {
        $data = $uploaded_object;
        return $data['file_path']
                .date("YmdHis")
                .$data['file_ext'];
    }
    private function resizeImage($file_path, $width, $height, $create_thumb)
    {
        $config['image_library'] = 'gd2';
        $config['source_image'] = $file_path;
        $config['create_thumb'] = $create_thumb;
        $config['width'] = $width;
        $config['height'] = $height;

        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
    }

    public function upload_file()
    {
        $config['upload_path'] = 'images/';
        $config['allowed_types'] = 'jpg|gif|png';
        $config['max_size'] = 102400; //kb
        //$config['max_height'] = 1024; //pixel
        //$config['max_width'] = 1024; //pixel

        $this->load->library('upload', $config);

        if($this->upload->do_upload("picture")) //ถ้า upload ไม่มีปัญหา
        {
            $data = $this->upload->data();
            //print_r($data);

            $new_filename = $this->generateFileName($data);
            rename($data['full_path'], $new_filename);

            $this->resizeImage($new_filename, 150, 200, true);

            redirect("upload", array('complete' => 'ok!'));
        }
        else
        {
            echo $this->upload->display_errors();
        }
    }

}