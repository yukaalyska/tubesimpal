<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class c_master extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url', 'form'));
        $this->load->model('pelanggaran_model', 'pelanggaran', true);
        $this->load->model('aspek_model', 'aspek', true);
        $this->load->model('pelanggaran_siswa_model', 'pelanggaran_siswa', true);
        $this->load->model('m_siswa', 'siswa', true);
        $this->load->model('m_guru', 'guru', true);
        $this->load->model('m_user', 'user', true);
        $this->load->model('m_prestasi', 'prestasi', true);
        $this->load->model('m_berkas', 'berkas', true);
        $this->load->model('m_school_setting', 'school_setting', true);
        $this->load->model('m_start_semester', 'start_semester', true);
        $this->data = array('title' => 'Aplikasi Pengelolaan Data Non-Akademik Berbasis Web',
            'aselAlamat' => base_url() . 'assets/',
            'Url' => base_url() . 'images/',
            'urlberkas' => base_url() . 'images/konseling/',
            'urlprestasi' => base_url() . 'images/prestasi/',
            'id_aspek' => '',
        );
        $this->data['no_image'] = $this->data['Url'] . 'no-image.jpg';
    }

    public function profiler() {
        $this->output->enable_profiler(true);
    }

    public function pesan_log() {
        $array_items = array(
            'nis' => '',
            'namasiswa' => '',
            'jurusan' => '',
            'kelas' => '',
            'type' => '',
            'nip' => '',
            'nama' => '',
        );
        $this->log_aktivitas('logout');
        $this->session->unset_userdata($array_items);
        $this->session->set_flashdata('success', '<p>Berhasil Logout</p>');
    }

    public function path_prestasi() {
        $config = array();
        $config['upload_path'] = './images/prestasi'; //path dimana file yang akan disimpan
        $config['allowed_types'] = 'gif|jpg|jpeg|png|JPG';
        $config['overwrite'] = TRUE;
        $config['remove_spaces'] = TRUE;
        return $config;
    }
    public function path_prestasi2() {
        $config = array();
        $config['upload_path'] = './images/prestasi'; //path dimana file yang akan disimpan
        $config['allowed_types'] = 'gif|jpg|jpeg|png|JPG';
        $config['overwrite'] = TRUE;
        $config['remove_spaces'] = TRUE;
        return $config;
    }

    public function path_konseling() {
        $config = array();
        $config['upload_path'] = './images/konseling'; //path dimana file yang akan disimpan
//       
        $config['overwrite'] = TRUE;
        $config['remove_spaces'] = TRUE;
        $config['allowed_types'] = '*';
        return $config;
    }

    public function list_user() {
        $data = array(
            '1' => 'Kesiswaan',
            '2' => 'Guru BP',
//                        '3' => 'Orang Tua Siswa'
        );
        return $data;
    }
    public function list_user_full() {
        $data = array(
            '1' => 'Kesiswaan',
            '2' => 'Guru BP',
           '3' => 'Orang Tua Siswa'
        );
        return $data;
    }
    

    public function list_prestasi() {
        $data = array('Akademik', 'Non Akademik');
        return $data;
    }

    public function list_session() {
        echo '<pre>';
        echo print_r($this->session->userdata);
    }
    public function log_aktivitas($aktivitas) {
        $data = array(
            'iduser'=> $this->session->userdata("iduser"),
            'tgl'=> date('y-m-d h:i:sa'),
            'aktivitas'=> $aktivitas,
            'year'=> $this->session->userdata("year"),
            'semester'=> $this->session->userdata("semester"),
        );
        $insetdata =  $this->db->insert('user_activity', $data);
    }
    
    public function kondisiSemester(){
      $data = array(
            'year'=> $this->session->userdata("year"),
            'semester'=> $this->session->userdata("semester"),
        );
        return $data;
    }
    public function renderpdf($file, $data, $stream = array()) {

        $html = $this->load->view($file, $data, true);
        $html .=
                '<style> table{
        margin:0 auto;width:100%;border-collapse:collapse;
        margin-top:20px;
        font-size:12px;
        }
        th.header{
            font-weight: bold;
            color:white;
            background-color: #999999;
            text-align: left;
            padding:5px 10px;
        }
        table.detail{background:#ecf3eb;}
        th, td{border:1px solid #999;}
        table.none th,
        table.none td{border:none;text-align: center;}
        
        table.nonesiswa th,
        table.nonesiswa td{border:none;text-align: left;}
        
        th{padding:8px 0;background: #ccc;}
        td{padding:4px 8px;}
        .baris-ganjil{
            background:#fff;
        }
        h2,h5{
            text-align:center;
            margin: 0px;
            padding:0px;
        }
      </style>';
        //load mPDF library
        $this->load->library('m_pdf');
        //generate the PDF from the given html

        $this->m_pdf->pdf->WriteHTML($html);
        if (isset($stream['download']) && $stream['download']) {
            $name = (isset($stream['name'])) ? $stream['name'] : 'pdf';
            $this->m_pdf->pdf->Output($name . '.pdf', 'D');
        } else {
            $this->m_pdf->pdf->Output();
        }
    }
    
    

}
