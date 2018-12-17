<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if (!class_exists('modelTemplate')) {
    require __DIR__ . '/C_master.php';
}

class c_tamu extends C_master {

    public function __construct() {
        parent::__construct();
        $this->data['action'] = base_url() . 'index.php/' . $this->router->fetch_class() . '/';
        $this->data['class'] = $this->router->fetch_class();
        $this->data['segment2'] = "";
        $this->data['segment'] = "";
    }

    public function index() {

        if (!empty($_POST)) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $where = array('username' => $username, 'password' => $password,'user_active'=>1);
            $result = $this->user->selectTable($where)->row();
            if ($result) {
                $username = $result->username;
                $type = $result->status;
                $iduser = $result->iduser;
                $this->session->set_userdata('iduser', $iduser);
                $school_setting = $this->school_setting->selectTable()->row();
                $this->session->set_userdata('year', $school_setting->year);
                $this->session->set_userdata('semester', $school_setting->semester);
                $this->session->set_userdata('school_setting_id', $school_setting->school_setting_id);
                if ($type == '3') {
                    $nis = $result->nis;
                    $wheresiswa = array('nis' => $nis);
                    $dataSiswa = $this->siswa->selectTable($wheresiswa)->row();
                    $nis = $dataSiswa->nis;
                    $namasiswa = $dataSiswa->namasiswa;
                    $jurusan = $dataSiswa->jurusan;
                    $kelas = $dataSiswa->kelas;
                    $this->session->set_userdata('nis', $nis);
                    $this->session->set_userdata('nama', $namasiswa);
                    $this->session->set_userdata('jurusan', $jurusan);
                    $this->session->set_userdata('kelas', $kelas);
                } else {
                    $nip = $result->nip;
                    $whereGuru = array('nip' => $nip);
                    $dataGuru = $this->guru->selectTable($whereGuru)->row();
                   
                    $nama = $dataGuru->nama;
                    $this->session->set_userdata('nip', $nip);
                    $this->session->set_userdata('nama', $nama);
                }
                $this->session->set_userdata('type', $type);
                $this->session->set_userdata('username', $username);
                $this->session->set_flashdata('success', 'Login Berhasil');
                $this->log_aktivitas('Login');
                $this->list_session();
                

                redirect("c_home");
            } else {
                $this->session->set_flashdata('error', 'Username tidak cocok');
                redirect('c_tamu/index');
            }
        }
        $this->load->view('login', $this->data);
    }

}

?>