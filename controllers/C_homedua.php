<?php

class C_homedua extends CI_Controller {
	
    
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form'));
    }
    
    function index(){
        $this->load->view('file_upload_demo');
    }

    function multiple_upload(){
         
         // //$config['max_size']      = 100; 
         // //$config['max_width']     = 1024; 
         // //$config['max_height']    = 768;  
         // $this->load->library('upload', $config);
         // // // script upload file pertama
         // $this->upload->do_upload('file1');
         // $file1 = $this->upload->data();
         // echo "<pre>";
         // print_r($file1);
         // echo "</pre>";
         
         // // script uplaod file kedua
         // $this->upload->do_upload('file2');
         // $file2 = $this->upload->data();
         // echo "<pre>";
         // print_r($file2);
         // echo "</pre>";

         	if (!empty($_FILES['file1']['name'])) {
                $gambar = $_FILES['file1']['name'];
                // $gambar2 = $_FILES['foto2']['name'];
                $gambar_type = $_FILES['file1']['type'];
                $gambar_size = $_FILES['file1']['size'];
                if ($gambar_type != "") {
                    $file_type = explode("/", $gambar_type);
                }

                // $config = $this->path_prestasi();
                $config['upload_path']   = 'upload'; 
         		$config['allowed_types'] = 'gif|jpg|png'; 
                $config['file_name'] = "prestasi_" . date('YmdHis') . "." . $file_type[1];
                // $config2['file_name'] = "prestasi_" . date('YmdHis') . "." . $file_type[1];


                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('file1')) {
                    // $message .= $this->upload->display_errors();
                    $succes = FALSE;
                } else {
                    // $data = array('upload_data' => $this->upload->data());
                    $upload_data = $this->upload->data(); 
					echo $file_name = $upload_data['file_name'];
					echo "<br/>";
                }
            }

            if (!empty($_FILES['file2']['name'])) {
                $gambar = $_FILES['file2']['name'];
                // $gambar2 = $_FILES['foto2']['name'];
                $gambar_type = $_FILES['file2']['type'];
                $gambar_size = $_FILES['file2']['size'];
                if ($gambar_type != "") {
                    $file_type = explode("/", $gambar_type);
                }

                // $config = $this->path_prestasi();
                $config2['upload_path']   = 'upload'; 
         		$config2['allowed_types'] = 'gif|jpg|png'; 
                $config2['file_name'] = "prestasi_2" . date('YmdHis') . "." . $file_type[1];
                // $config2['file_name'] = "prestasi_" . date('YmdHis') . "." . $file_type[1];


                $this->load->library('upload', $config2);

                if (!$this->upload->do_upload('file2')) {
                    // $message .= $this->upload->display_errors();
                    $succes = FALSE;
                } else {
                    $upload_data = $this->upload->data(); 
					echo $file_name = $upload_data['file_name'];
                     
                }
            }
    }
}