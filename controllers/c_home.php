<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if (!class_exists('modelTemplate')) {
    require __DIR__ . '/C_master.php';
}

class C_home extends C_master {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
        $year = $this->session->userdata("year");
        $semester = $this->session->userdata("semester");
        $this->data['action'] = base_url() . 'index.php/' . $this->router->fetch_class() . '/';
        $this->data['class'] = $this->router->fetch_class();
        $this->data['segment2'] = "";
        $this->data['segment'] = "";
        $this->data['semester'] = $semester;
        $this->data['year'] = $year;
        $this->data['getSemester'] = array('1' => 'Ganjil', '2' => 'Genap');
        $type = $this->session->userdata("type");
        $nama = $this->session->userdata("nama");

        if ($type) {
            $this->data['type'] = $type;
            $this->data['nama'] = $nama;
        } else {
            $this->session->set_flashdata('error', 'Halaman Tidak Bisa Diakses');
            redirect('c_tamu/index');
        }
    }

    public function index() {
        $data = array('title' => 'Home');
        $data = $this->data + $data;
        $data['method'] = $this->router->fetch_method();
        $data['content'] = "bp/home";
        $data['segment'] = $this->uri->segment(2);
        $where = array('type' => 2,'semester'=> $this->data['semester'],'year'=>$this->data['year']);
        $data['list_berkas'] = $this->berkas->selectTable($where)->result_array();
        $this->load->view('home', $data);
    }

    public function tata_tertib($id_aspek) {
        $data = array('title' => 'Input Pelanggaran', 'id_aspek' => $id_aspek);
        $data = $this->data + $data;
        $data['method'] = $this->router->fetch_method();
        $data['segment'] = $this->uri->segment(2);
        $data['segment2'] = $this->uri->segment(3);
        $where = array('id_aspek' => $id_aspek);
        $data['list_tata_tertib'] = $this->pelanggaran->selectTable($where)->result_array();
        $whereAspek = array('id_aspek' => $id_aspek);
        $resultAsepek = $this->aspek->selectTable($whereAspek)->row();
        $data['nama_aspek'] = $resultAsepek->nama_aspek;
        $data['content'] = "TblKerapihan";
        $this->load->view('home', $data);
    }

    public function tata_tertib_tambah($id_aspek) {
        $type = 'tambah';
        $judul = 'Tambah Tata Tertib';
        $segment = $this->uri->segment(2);
        $id_aspek = $this->uri->segment(3);
        $this->tata_tertib_form($judul, $type, $id_aspek, $segment, $id_aspek);
    }

    public function tata_tertib_edit($id_aspek, $idpelanggaran) {
        $type = 'ubah';
        $judul = 'Ubah Tata Tertib';
        $segment = $this->uri->segment(2);
        $id_aspek = $this->uri->segment(3);
        $this->tata_tertib_form($judul, $type, $id_aspek, $segment);
    }

    public function tata_tertib_form($judul, $type, $id_aspek, $segment) {
        if ($type == 'tambah') {
            $metadata = $this->pelanggaran->getMetadata();
            foreach ($metadata['columns'] as $value) {
                $data['valueData'][$value->name] = '';
                $this->data['title'] = $judul;
            }
        } else {
            $where = array('idpelanggaran' => $this->uri->segment(4));
            $result = $this->pelanggaran->selectTable($where)->result_array();
            $data['valueData'] = $result[0];
        }
        $whereAspek = array('id_aspek' => $id_aspek);
        $resultAsepek = $this->aspek->selectTable($whereAspek)->row();

        $this->data['segment'] = $segment;
        $this->data['id_aspek'] = $id_aspek;
        $this->data['nama_aspek'] = $resultAsepek->nama_aspek;
        $data = $this->data + $data;
        if ($_POST) {
            $jenis_pelanggaran = $this->input->post('jenis_pelanggaran');
            $poin_pelanggaran = $this->input->post('poin_pelanggaran');
            $sanksi_pelanggaran = $this->input->post('sanksi_pelanggaran');
            $postData = array(
                'jenis_pelanggaran' => $jenis_pelanggaran,
                'poin_pelanggaran' => $poin_pelanggaran,
                'sanksi_pelanggaran' => $sanksi_pelanggaran,
                'id_aspek' => $id_aspek,
            );

            $dataASpek = $this->aspek->selectTable(array('id_aspek' => $id_aspek))->row();
            $nama_aspek = $dataASpek->nama_aspek;
            if ($this->pelanggaran->validate()) {
                if ($type == 'tambah') {
                    $this->pelanggaran->insertTable($postData);
                    $data['message_alert'] = 'alert alert-success';
                    $this->session->set_flashdata('success', 'Tambah Tata Tertib Berhasil');
                    $aktivitas = 'Tambah Data ' . $nama_aspek;
                    $this->log_aktivitas($aktivitas);
                } else { //update data aspek
                    $where = array('idpelanggaran' => $this->uri->segment(4));
                    $this->session->set_flashdata('success', 'Edit Tata Tertib Berhasil');
                    $aktivitas = 'Ubah Data ' . $nama_aspek;
                    $this->log_aktivitas($aktivitas);
                    $this->pelanggaran->updateTable($postData, $where);
                }
                redirect("c_home/tata_tertib/" . $id_aspek);
            } else {
                $message = validation_errors();
                $this->session->set_flashdata('error', $message);
                if ($type == 'tambah') {
                    redirect("c_home/tata_tertib_tambah/" . $id_aspek);
                } else {
                    $idpelanggaran = $this->uri->segment(4);
                    redirect("c_home/tata_tertib_edit/" . $id_aspek . "/" . $idpelanggaran);
                }
            }
        }


        $data['content'] = "bp/pelanggaran/pelanggaran_form";


        $this->load->view('home', $data);
    }

    public function tata_tertib_hapus($id_aspek, $idpelanggaran) {
        $where = array('idpelanggaran' => $idpelanggaran);
        $jumlahData = $this->pelanggaran_siswa->countTable($where);
        if ($jumlahData > 0) {
            $this->session->set_flashdata('error', 'Tata Tertib Tidak bisa dihapus');
        } else {
            $dataASpek = $this->aspek->selectTable(array('id_aspek' => $id_aspek))->row();
            $nama_aspek = $dataASpek->nama_aspek;
            $this->pelanggaran->deleteTable($where);
            $this->session->set_flashdata('success', 'Tata Tertib Terhapus');
            $aktifitas = 'Hapus Data ' . $nama_aspek;
            $this->log_aktivitas($aktifitas);
        }
        redirect("c_home/tata_tertib/" . $id_aspek);
    }

    public function pelanggaran() {
        $data = $this->data;
        $data['title'] = 'Data Pelanggaran Siswa';
        $data['segment'] = $this->uri->segment(2);
        $data['method'] = $this->router->fetch_method();
        $type = $this->data['type'];

        if ($type == 3) {
            $nis = $this->session->userdata("nis");
            redirect('c_home/pelanggaran_detail/' . $nis);
        }
        $join = array(
            'siswa' => 'siswa.nis = pelanggaran_siswa.nis',
            'aspek' => 'aspek.id_aspek = pelanggaran_siswa.id_aspek',
            'pelanggaran' => 'pelanggaran.idpelanggaran = pelanggaran_siswa.idpelanggaran'
        );
        $where = array(
            'pelanggaran_siswa.year' => $this->session->userdata("year"),
            'pelanggaran_siswa.semester' => $this->session->userdata("semester"),
        );
        $groupBY = 'pelanggaran_siswa.nis';
        $data['list_pelanggaran_siswa'] = $this->pelanggaran_siswa->selectTableWithJoin($where, $join, $groupBY)->result_array();
        $data['content'] = "LpPelanggaran";
        $this->load->view('home', $data);
    }

    public function pelanggaran_detail() {
        $nis = $this->uri->segment(3);
        $type = $this->data['type'];
        $year = $this->data['year'];
        $semester = $this->data['semester'];
        if ($type == 3) {
            $nis = $this->session->userdata("nis");
        }
        $segment = $this->uri->segment(2);
        $this->data['list_jurusan'] = $this->list_jurusan();
        $this->data['segment'] = $segment;
        $TotalPoinPelanggaranByNis = "SELECT *, (select sum(poin_pel) from pelanggaran_siswa where nis = siswa.nis  and year=$year and semester = $semester) as 'total_poin' FROM `siswa` where nis=$nis";
        $this->data['dataSiswa'] = $this->pelanggaran_siswa->findBySql($TotalPoinPelanggaranByNis)->row();
        $this->data['url'] = base_url() . 'images/';
        $this->data['title'] = "Data Pelanggaran";
        $this->data['content'] = "bp/pelanggaran/pelanggaran_by_siswa";
        $this->load->view('home', $this->data);
    }

    public function pelanggaran_laporan($nis = null) {

        if (isset($nis)) {
            $where = "where nis=$nis";
            echo $nis;
        } else {
            $where = "";
        }
        $this->data['list_jurusan'] = $this->list_jurusan();
        $TotalPoinPelanggaranByNis = "SELECT *, (select sum(poin_pel) from pelanggaran_siswa where nis = siswa.nis) as 'total_poin' FROM `siswa` $where";
        $this->data['dataSiswa'] = $this->pelanggaran_siswa->findBySql($TotalPoinPelanggaranByNis)->result_array();

        $this->data['title'] = "Laporan Dari Guru Bk";
        $this->data['url'] = base_url() . 'images/';
        $html = "bp/pelanggaran/laporan_pelanggaran";
        $this->renderpdf($html, $this->data);
    }

    public function pelanggaran_input() {
        $data = $this->data;
        $data = $this->data;
        $segment = $this->uri->segment(2);
        $type = 'tambah';
        $judul = 'Pelanggaran Siswa';
        $this->pelanggaran_form($judul, $type, $segment);
    }

    public function pelanggaran_edit($nis) {
        $type = 'ubah';
        $judul = 'Ubah Pelanggaran Siswa';
        $segment = $this->uri->segment(2);
        $this->pelanggaran_form($judul, $type, $segment);
    }

    public function pelanggaran_form($judul, $type, $segment) {

        $data = $this->data;
        $data['type'] = $this->data['type'];
        $data['list_tata_tertib'] = $this->aspek->selectTable()->result_array();
        $data['pelanggaran'] = $this->pelanggaran->selectTable()->result_array();
        $data['list_siswa'] = $this->siswa->selectTable()->result_array();
        if ($type == 'tambah') {
            $metadata = $this->pelanggaran_siswa->getMetadata();
            foreach ($metadata['columns'] as $value) {
                $data['valueData'][$value->name] = '';
                $this->data['title'] = $judul;
            }
        } else {
            $where = array(
                'pelanggaran_siswa.id_pelanggaran_siswa' => $this->uri->segment(3)
            );
            $result = $this->pelanggaran_siswa->selectTable($where)->result_array();
            $data['valueData'] = $result[0];
        }

        if ($_POST) {

            $nis = $this->input->post('nis');
            $id_aspek = $this->input->post('id_aspek');
            $idpelanggaran = $this->input->post('idpelanggaran');
            $poin_pelanggaran = $this->input->post('poin_pelanggaran');
            $tgl_pelanggaran = $this->input->post('tgl_pelanggaran');


            $postData = array(
                'nis' => $nis,
                'id_aspek' => $id_aspek,
                'idpelanggaran' => $idpelanggaran,
                'poin_pel' => $poin_pelanggaran,
                'tgl_pelanggaran' => $tgl_pelanggaran,
            );

            if ($this->pelanggaran_siswa->validate()) {
                if ($type == 'tambah') {
                    $this->pelanggaran_siswa->insertTable($postData);
                    $data['message_alert'] = 'alert alert-success';
                    $this->log_aktivitas('Tambah Pelanggaran Siswa');
                    $this->session->set_flashdata('success', 'Tambah Pelanggaran Siswa Berhasil');
                } else { //update pelanggaran
                    $where = array('id_pelanggaran_siswa' => $this->uri->segment(3));
                    $this->pelanggaran_siswa->updateTable($postData, $where);
                    $this->log_aktivitas('Update Pelanggaran Siswa');
                    $this->session->set_flashdata('success', 'Edit Pelanggaran Siswa Berhasil');
                }
                redirect("c_home/pelanggaran/");
            } else {
                $message = validation_errors();

                $this->session->set_flashdata('error', $message);
                if ($type == 'tambah') {
                    redirect("c_home/pelanggaran_input");
                } else {
                    $id_pelanggaran_siswa = $this->uri->segment(3);
                    redirect("c_home/pelanggaran_edit" . $id_pelanggaran_siswa);
                }
            }
        }

        $data['segment'] = $segment;
        $data['title'] = $judul;
        $data['content'] = "InpPelanggaran";
        $data['typeForm'] = $type;
        $this->load->view('home', $data);
    }

    public function pelanggaran_siswa_hapus() {
        $where = array('id_pelanggaran_siswa' => $this->uri->segment(3));

        $this->pelanggaran_siswa->deleteTable($where);
        $this->session->set_flashdata('success', 'Tata Tertib Terhapus');
        $this->log_aktivitas('Hapus Pelanggaran Siswa');
        redirect("c_home/pelanggaran/" . $id_aspek);
    }

    public function prestasi() {
        $data = $this->data;
        $year = $this->session->userdata("year");
        $semester = $this->session->userdata("semester");
        $data['segment'] = $this->uri->segment(2);
        $type = $this->data['type'];
        $data['list_jurusan'] = $this->list_jurusan();
        if ($type == 3) {
            $nis = $this->session->userdata("nis");
            redirect("c_home/prestasi_detail/" . $nis);
        }
        $join = array(
            'siswa' => 'siswa.nis = prestasi.nis',
        );
        $grouBy = 'prestasi.nis';
        $where = array('prestasi.year' => $year, 'prestasi.semester' => $semester);
        $data['list_prestasi'] = $this->prestasi->selectTableWithJoin($where, $join, $grouBy)->result_array();
        $data['title'] = 'Data Prestasi';
        $data['content'] = "LpPrestasi";
        $this->load->view('home', $data);
    }

    public function prestasi_laporan($nis = null) {
        $data = $this->data;
        $data['segment'] = $this->uri->segment(2);
        $join = array(
            'siswa' => 'siswa.nis = prestasi.nis',
        );
        if (isset($nis)) {
            $nis = $this->uri->segment(3);
            $where = array('prestasi.nis' => $nis);
        } else {
            $where = null;
        }
        $grouBy = 'prestasi.nis';
        $dataSiswa = $this->prestasi->selectTableWithJoin($where, $join, $grouBy)->result_array();

        $data['title'] = 'Data Prestasi';
        $data['dataSiswa'] = $dataSiswa;
        $data['url'] = base_url() . 'images/';
         $data['list_jurusan'] = $this->list_jurusan();
        $html = "bp/prestasi/laporan_Prestasi";

        $this->renderpdf($html, $data);
    }

    public function prestasi_detail() {
        $data = $this->data;
        $data['segment'] = $this->uri->segment(2);
        $nis = $this->uri->segment(3);
        $where = array('nis' => $nis);
        $dataSiswa = $this->siswa->selectTable($where)->result_array();
        $data['dataSiswa'] = $dataSiswa;
        $data['title'] = 'Data Prestasi';
        $data['content'] = "bp/prestasi/Detail_Prestasi";
         $data['list_jurusan'] = $this->list_jurusan();
        $this->load->view('home', $data);
    }

    public function prestasi_input() {
        $segment = $this->uri->segment(2);
        $judul = "Input Prestasi";
        $type = "tambah";

        $this->prestasi_form($judul, $type, $segment);
    }

    public function prestasi_edit() {
        $segment = $this->uri->segment(2);
        $judul = "Edit Prestasi";
        $type = "ubah";
        $this->prestasi_form($judul, $type, $segment);
    }

    public function prestasi_form($judul, $type, $segment) {
        $data = $this->data;
        $data['segment'] = $segment;
        $data['title'] = $judul;

        $data['list_siswa'] = $this->siswa->selectTable()->result_array();
        $data['list_prestasi'] = $this->list_prestasi();
        if ($type == 'tambah') {
            $metadata = $this->prestasi->getMetadata();
            foreach ($metadata['columns'] as $value) {
                $data['valueData'][$value->name] = '';
                $this->data['title'] = $judul;
            }
        } else {
            $idprestasi = $this->uri->segment(3);
            $where = array(
                'idprestasi' => $idprestasi
            );
            $result = $this->prestasi->selectTable($where)->result_array();
            $data['valueData'] = $result[0];
        }

        if ($_POST) {
            $nis = $this->input->post('nis');
            $kategori_prestasi = $this->input->post('kategori_prestasi');
            $keterangan = $this->input->post('keterangan');
            $apresiasi = $this->input->post('apresiasi');
            $tanggal = $this->input->post('tanggal');
            $file = $this->input->post('foto');
            $file2 = $this->input->post('foto2');

            $postData = array(
                'nis' => $nis,
                'kategori_prestasi' => $kategori_prestasi,
                'keterangan' => $keterangan,
                'apresiasi' => $apresiasi,
                'tanggal' => $tanggal,
            );
            $succes = true;
            $message = "";
            if(!empty($_FILES['foto1']['name'])) {
                $gambar = $_FILES['foto1']['name'];
                // $gambar2 = $_FILES['foto2']['name'];
                $gambar_type = $_FILES['foto1']['type'];
                $gambar_size = $_FILES['foto1']['size'];
                if ($gambar_type != "") {
                    $file_type = explode("/", $gambar_type);
                }

                $config['upload_path']   = './images/prestasi'; 
                $config['allowed_types'] = 'gif|jpg|png'; 
                $config['file_name'] = "prestasi_" . date('YmdHis') . "." . $file_type[1];
                // $config2['file_name'] = "prestasi_" . date('YmdHis') . "." . $file_type[1];


                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('foto1')) {
                    $message .= $this->upload->display_errors();
                    $succes = FALSE;
                } else {
                    $upload_data = $this->upload->data(); 
                    $data = array('upload_data' => $upload_data);
                    $postData['foto'] = $upload_data['file_name'];
                }
            }

            if(!empty($_FILES['foto2']['name'])){
                $gambar = $_FILES['foto2']['name'];
                // $gambar2 = $_FILES['foto2']['name'];
                $gambar_type = $_FILES['foto2']['type'];
                $gambar_size = $_FILES['foto2']['size'];
                if ($gambar_type != "") {
                    $file_type = explode("/", $gambar_type);
                }

                // $config = $this->path_prestasi();
                $config2['upload_path']   = 'upload'; 
                $config2['allowed_types'] = 'gif|jpg|png'; 
                $config2['file_name'] = "prestasi_2" . date('YmdHis') . "." . $file_type[1];
                // $config2['file_name'] = "prestasi_" . date('YmdHis') . "." . $file_type[1];


                $this->load->library('upload', $config2);

                if (!$this->upload->do_upload('foto2')) {
                    // $message .= $this->upload->display_errors();
                    $succes = FALSE;
                } else {
                    $upload_data = $this->upload->data(); 
                    $file_name = $upload_data['file_name'];
                    $postData['foto2'] = $upload_data['file_name'];
                     
                }

            }

            // if (!empty($_FILES['foto']['name'])) {
            //     $gambar = $_FILES['foto']['name'];
            //     // $gambar2 = $_FILES['foto2']['name'];
            //     $gambar_type = $_FILES['foto']['type'];
            //     $gambar_size = $_FILES['foto']['size'];
            //     if ($gambar_type != "") {
            //         $file_type = explode("/", $gambar_type);
            //     }

            //     $config = $this->path_prestasi();
            //     $config2 = $this->path_prestasi2();
            //     $config['file_name'] = "prestasi_" . date('YmdHis') . "." . $file_type[1];
            //     // $config2['file_name'] = "prestasi_" . date('YmdHis') . "." . $file_type[1];


            //     $this->load->library('upload', $config);

            //     if (!$this->upload->do_upload('foto')) {
            //         $message .= $this->upload->display_errors();
            //         $succes = FALSE;
            //     } else {
            //         $data = array('upload_data' => $this->upload->data());
            //         $postData['foto'] = $config['file_name'];
            //         // $postData['foto2'] = $config['file_name'];
            //     }

            //     $this->load->library('upload', $config2);
            //     if (!$this->upload->do_upload('foto2')) {
            //         $message .= $this->upload->display_errors();
            //         $succes = FALSE;
            //     } else {
            //         $data = array('upload_data' => $this->upload->data());
            //         $postData['foto2'] = $config['file_name'];
            //         // $postData['foto2'] = $config['file_name'];
            //     }
            // }

          
            // if (!empty($_FILES['foto2']['name'])) {
            //     $gambar2 = $_FILES['foto2']['name'];
            //     $gambar_type2 = $_FILES['foto2']['type'];
            //     $gambar_size2 = $_FILES['foto2']['size'];
            //     if ($gambar_type2 != "") {
            //         $file_type2 = explode("/", $gambar_type);
            //     }

            //     $config2 = $this->path_prestasi2();
            //     $config2['file_name2'] = "prestasi_" . date('YmdHis') . "." . $file_type[1];


            //     $this->load->library('upload', $config2);

            //     if (!$this->upload->do_upload('foto2')) {
            //         $message .= $this->upload->display_errors();
            //         $succes = FALSE;
            //     } else {
            //         $data = array('upload_data' => $this->upload->data());
            //         $postData['foto2'] = $config2['file_name2'];
            //     }
            // }

            // $path = 
            // $config = array(
            //     'upload_path'   => $path,
            //     'allowed_types' => 'jpg|gif|png'               
            // );

            $config = $this->path_prestasi();

            $this->load->library('upload', $config);

            $images = array();

            foreach ($files['name'] as $key => $image) {
                $_FILES['foto[]']['name']= $files['name'][$key];
                $_FILES['foto[]']['type']= $files['type'][$key];
                $_FILES['foto[]']['tmp_name']= $files['tmp_name'][$key];
                $_FILES['foto[]']['error']= $files['error'][$key];
                $_FILES['foto[]']['size']= $files['size'][$key];

                $fileName = $title .'_'. $image;

                $images[] = $fileName;

                $config['file_name'] = $fileName;

                $this->upload->initialize($config);

                if ($this->upload->do_upload('foto[]')) {
                    $this->upload->data();
                } else {
                    return false;
                }
            }



            if ($this->prestasi->validate() && $succes) {
                if ($type == 'tambah') {
                    $this->prestasi->insertTable($postData);
                    $data['message_alert'] = 'alert alert-success';
                    $this->log_aktivitas('Tambah Prestasi Siswa');
                    $this->session->set_flashdata('success', 'Tambah Prestasi Berhasil');
                } else {
                    $where = array('idprestasi' => $this->uri->segment(3));
                    $this->prestasi->updateTable($postData, $where);
                    $this->log_aktivitas('Update Pelanggaran Siswa');
                    $this->session->set_flashdata('success', 'Edit Prestasi Siswa Berhasil');
                }
                redirect("c_home/prestasi/");
            } else {
                $message .= validation_errors();
                $this->session->set_flashdata('error', $message);
                if ($type == 'tambah') {
                    redirect("c_home/prestasi_input/");
                } else {
                    $id = $this->uri->segment(4);
                    redirect("c_home/prestasi_edit/" . $idprestasi);
                }
            }
        }
        $data['content'] = "InpPrestasi";
        $data['typeForm'] = $type;
        $this->load->view('home', $data);
    }

    public function prestasi_hapus() {
        $idprestasi = $this->uri->segment(3);
        $where = array('idprestasi' => $idprestasi);
        $this->prestasi->deleteTable($where);
        $this->session->set_flashdata('success', 'Prestasi Siswa Terhapus');
        $this->log_aktivitas('Hapus Prestasi Siswa');
        redirect("c_home/prestasi/");
    }

    public function siswa() {
        $data = $this->data;
        $judul = 'Data Siswa';
        $data['segment'] = $this->uri->segment(2);
        $data['title'] = $judul;
        $join = array(
            'user' => 'user.nis = siswa.nis'
        );
        $data['list_jurusan'] = $this->list_jurusan();
        $data['list_siswa'] = $this->siswa->selectTableWithJoin(null, $join)->result_array();
        $data['list_status_aktif'] = $this->list_status();
        $data['content'] = "bp/siswa/siswa_admin";
        $this->load->view('home', $data);
    }

    public function siswa_dua() {
        $data = $this->data;
        $judul = 'Data Siswa';
        $data['segment'] = $this->uri->segment(2);
        $data['title'] = $judul;
        $join = array(
            'user' => 'user.nis = siswa.nis'
        );
        $data['list_jurusan'] = $this->list_jurusan();
        $data['list_siswa'] = $this->siswa->selectTableWithJoin(null, $join)->result_array();
        $data['list_status_aktif'] = $this->list_status();
        $data['content'] = "bp/siswa/siswa_admin_dua";
        $this->load->view('home', $data);
    }

    public function siswa_tiga() {
        $data = $this->data;
        $judul = 'Data Siswa';
        $data['segment'] = $this->uri->segment(2);
        $data['title'] = $judul;
        $join = array(
            'user' => 'user.nis = siswa.nis'
        );
        $data['list_jurusan'] = $this->list_jurusan();
        $data['list_siswa'] = $this->siswa->selectTableWithJoin(null, $join)->result_array();
        $data['list_status_aktif'] = $this->list_status();
        $data['content'] = "bp/siswa/siswa_admin_tiga";
        $this->load->view('home', $data);    
    }

    public function siswa_tambah() {
        $data = $this->data;
        $segment = $this->uri->segment(2);
        $type = 'tambah';
        $judul = 'tambah Data Siswa';
        $this->siswa_form($judul, $type, $segment);
    }

    public function siswa_edit($nis) {
        $type = 'ubah';
        $judul = 'Ubah Data Siswa';
        $segment = $this->uri->segment(2);
        $this->siswa_form($judul, $type, $segment);
    }

    public function siswa_form($judul, $type, $segment) {
        $data = $this->data;
        $data['user_status'] = $this->list_status();
        $data['list_jurusan'] = $this->list_jurusan();

        if ($type == 'tambah') {
            $metadata = $this->siswa->getMetadata();
            foreach ($metadata['columns'] as $value) {
                $data['valueData'][$value->name] = '';
                $this->data['title'] = $judul;
            }
            $metadatauser = $this->user->getMetadata();
            foreach ($metadatauser['columns'] as $valueu) {
                $data['valueData'][$valueu->name] = '';
            }
        } else {
            $where = array('nis' => $this->uri->segment(3));
            $result = $this->siswa->selectTable($where)->result_array();
            $resultUser = $this->user->selectTable($where)->result_array();
            $data['valueData'] = $result[0] + $resultUser[0];
            $usernamedb = $resultUser[0]['username'];
        }

        if ($_POST) {
            $nis = $this->input->post('nis');
            $namasiswa = $this->input->post('namasiswa');
            $kelas = $this->input->post('kelas');
            $jurusan = $this->input->post('jurusan');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $user_active = $this->input->post('user_active');
            $user_desc = $this->input->post('user_desc');
            $postData = array(
                'nis' => $nis,
                'namasiswa' => $namasiswa,
                'kelas' => $kelas,
                'jurusan' => $jurusan,
            );
            $success = true;
            $message = "";
            if (empty($password) || empty($username)) {
                $success = FALSE;
                $message .="username atau password harus diisi";
            }
            if ($type == 'tambah') {
                $cekUser = $this->cekuser($username);
                if ($cekUser) {
                    $message .="Username sudah ada";
                    $success = FALSE;
                }
            } else {
                if ($username != $usernamedb) {
                    $cekUser = $this->cekuser($username);
                    if ($cekUser) {
                        $message .="Username sudah ada";
                        $success = FALSE;
                    }
                }
            }
            if ($this->siswa->validate() && $success) {
                if ($type == 'tambah') {

                    $where = array('nis' => $nis);
                    $jumlah_nis = $this->siswa->countTable($where);
                    if ($jumlah_nis > 0) {
                        $this->session->set_flashdata('error', 'nis sudah digunakan');
                        redirect("c_home/siswa_tambah");
                    } else {
                        $this->siswa->insertTable($postData);
                        $datauser = array(
                            'nis' => $nis,
                            'password' => $password,
                            'status' => 3,
                            'username' => $username,
                            'user_active' => $user_active,
                            'user_desc' => $user_desc,
                        );
                        $insertUser = $this->db->insert('user', $datauser);
                        $data['message_alert'] = 'alert alert-success';
                        $this->session->set_flashdata('success', 'Tambah Siswa Berhasil');
                        $this->log_aktivitas('Tambah Data Siswa');
                    }
                } else { //update data Siswa
                    $where = array('nis' => $this->uri->segment(3));
                    $this->session->set_flashdata('success', 'Edit Siswa Berhasil');
                    $this->siswa->updateTable($postData, $where);
                    $datauser = array(
                        'password' => $password,
                        'username' => $username,
                        'user_active' => $user_active,
                        'user_desc' => $user_desc,
                    );
                    if ($this->data['type'] == '3') {
                        $datauser['user_active'] = 1;
                    }
                    $this->user->updateTable($datauser, $where);
                    $this->log_aktivitas('Ubah Data Siswa');
                }
                if ($this->data['type'] == '3') {
                    redirect("c_home/");
                } else {
                    redirect("c_home/siswa/");
                }
            } else {
                $message .= validation_errors();
                $this->session->set_flashdata('error', $message);
                if ($type == 'tambah') {
                    redirect("c_home/siswa_tambah");
                } else {
                    redirect("c_home/siswa_edit/" . $nis);
                }
            }
        }
        $data['segment'] = $segment;
        $data['title'] = $judul;
        $data['typeForm'] = $type;
        $data['type'] = $this->data['type'];
        $data['content'] = "bp/siswa/siswa_form";
        $this->load->view('home', $data);
    }

    public function siswa_hapus() {
        $nis = $this->uri->segment(3);
        $where = array('nis' => $nis);
        $jumlahData = $this->pelanggaran_siswa->countTable($where);
        if ($jumlahData > 0) {
            $this->session->set_flashdata('error', 'Data Tidak bisa dihapus');
        } else {
            $deleteUser = $this->db->delete('user', $where);
            $this->siswa->deleteTable($where);
            $this->session->set_flashdata('success', 'Tata Tertib Terhapus');
        }
        redirect("c_home/siswa/");
    }

    public function guru() {
        $data = $this->data;
        $judul = 'Data Guru';
        $data['segment'] = $this->uri->segment(2);
        $data['title'] = $judul;
        $join = array(
            'user' => 'user.nip = guru.nip'
        );
        $data['list_guru'] = $this->guru->selectTableWithJoin(null, $join)->result_array();
        $data['list_status'] = $this->list_user();
        $data['list_status_aktif'] = $this->list_status();
        $data['content'] = "bp/guru/guru_admin";
        $this->load->view('home', $data);
    }

    public function guru_tambah() {
        $data = $this->data;
        $segment = $this->uri->segment(2);
        $type = 'tambah';
        $judul = 'tambah Data Guru';
        $this->guru_form($judul, $type, $segment);
    }

    public function guru_hapus() {
        $nip = $this->uri->segment(3);
        $where = array('nip' => $nip);

        $deleteUser = $this->db->delete('user', $where);
        $this->guru->deleteTable($where);
        $this->session->set_flashdata('success', 'User Guru Terhapus');

        redirect("c_home/guru/");
    }

    public function guru_edit() {
        $data = $this->data;
        $type = 'ubah';
        $judul = 'Ubah Data Guru';
        $segment = $this->uri->segment(2);
        $this->guru_form($judul, $type, $segment);
    }

    public function guru_form($judul, $type, $segment) {
        $data = $this->data;
        $data['list_status'] = $this->list_user();
        $data['user_status'] = $this->list_status();
        $user_active = $this->input->post('user_active');
        $user_desc = $this->input->post('user_desc');
        if ($type == 'tambah') {
            $metadata = $this->guru->getMetadata();
            foreach ($metadata['columns'] as $value) {
                $data['valueData'][$value->name] = '';
                $this->data['title'] = $judul;
            }
            $metadatauser = $this->user->getMetadata();
            foreach ($metadatauser['columns'] as $valueu) {
                $data['valueData'][$valueu->name] = '';
            }
        } else {
            $where = array(
                'guru.nip' => $this->uri->segment(3)
            );
            $join = array(
                'user' => 'user.nip = guru.nip'
            );
            $result = $this->guru->selectTableWithJoin($where, $join)->result_array();
            $whereuser = array(
                'nip' => $this->uri->segment(3)
            );
            $resultUser = $this->user->selectTable($whereuser)->result_array();
            $data['valueData'] = $result[0] + $resultUser[0];
            $usernamedb = $resultUser[0]['username'];
        }

        if ($_POST) {
            $nip = $this->input->post('nip');
            $nama = $this->input->post('nama');
            $status = $this->input->post('status');
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $postData = array(
                'nip' => $nip,
                'nama' => $nama,
            );
            $datauser = array(
                'nip' => $nip,
                'password' => $password,
                'status' => $status,
                'username' => $username,
                'user_active' => $user_active,
                'user_desc' => $user_desc,
            );

            $success = true;
            $message = "";
            if (empty($password) || empty($username)) {
                $success = FALSE;
                $message .="username atau password harus diisi";
            }

            if ($type == 'tambah') {
                $cekUser = $this->cekuser($username);
                if ($cekUser) {
                    $message .="Username sudah ada";
                    $success = FALSE;
                }
            } else {
                if ($username != $usernamedb) {
                    $cekUser = $this->cekuser($username);
                    if ($cekUser) {
                        $message .="Username sudah ada";
                        $success = FALSE;
                    }
                }
            }

            if ($this->guru->validate() && $success) {
                if ($type == 'tambah') {

                    $where = array('nip' => $nip);
                    $jumlah_nip = $this->guru->countTable($where);
                    if ($jumlah_nip > 0) {
                        $this->session->set_flashdata('error', 'nip sudah digunakan');
                        redirect("c_home/guru_tambah");
                    } else {
                        $this->guru->insertTable($postData);
                        $this->user->insertTable($datauser);
                        $this->log_aktivitas('Tambah Data Guru');
                        $data['message_alert'] = 'alert alert-success';
                        $this->session->set_flashdata('success', 'Tambah Guru Berhasil');
                    }
                } else { //update Guru
                    $where = array('nip' => $this->uri->segment(3));
                    if ($this->uri->segment(4)) {
                        $datauser['user_active'] = 1;
                        $datauser['user_desc'] = NULL;
                    }
                    $this->user->updateTable($datauser, $where);
                    $this->guru->updateTable($postData, $where);
                    $this->session->set_flashdata('success', 'Edit Guru Berhasil');
                    $this->log_aktivitas('Ubah Data Guru');
                }
                if ($this->data['type'] == '2') {
                    redirect("c_home/");
                } else {
                    redirect("c_home/guru/");
                }
            } else {
                $message .= validation_errors();
                $this->session->set_flashdata('error', $message);
                if ($type == 'tambah') {
                    redirect("c_home/guru_tambah");
                } else {
                    redirect("c_home/guru_edit/" . $nip);
                }
            }
        }
        $data['segment'] = $segment;
        $data['title'] = $judul;
        $data['typeForm'] = $type;
        $data['content'] = "bp/guru/guru_form";
        $data['type'] = $this->data['type'];
        $this->load->view('home', $data);
    }

    public function get_pelanggaran() {
        $id_aspek = $_POST['id_aspek'];
        $where = array('id_aspek' => $id_aspek);
        $result = $this->pelanggaran->selectTable($where)->result_array();
        foreach ($result as $value) {
            echo "  <option value=" . $value['idpelanggaran'] . ">" . $value['jenis_pelanggaran'] . "</option>
";
        }
    }

    public function get_poin() {

        $idpelanggaran = $_POST['idpelanggaran'];
        $where = array('idpelanggaran' => $idpelanggaran);
        $result = $this->pelanggaran->selectTable($where)->row();
        echo $result->poin_pelanggaran;
    }

    public function get_siswa() {

        $nis = $_POST['nis'];
        $where = array('nis' => $nis);
        $result = $this->siswa->selectTable($where)->row();
        $dataJurusan = $this->list_jurusan();
        $jurusan = $dataJurusan[$result->jurusan];
        $data = array('namasiswa' => $result->namasiswa, 'kelas' => $result->kelas, 'jurusan' => $jurusan);
        echo json_encode($data);
    }

    public function download() {
        $year = $this->session->userdata("year");
        $semester = $this->session->userdata("semester");
        $data = $this->data;
        $data['method'] = $this->router->fetch_method();
        $data['segment'] = $this->uri->segment(2);

        $where = array('type' => 1, 'semester' => $semester, 'year' => $year);
        $data['list_berkas'] = $this->berkas->selectTable($where)->result_array();
        $data['content'] = "bp/berkas/download";
        $data['title'] = 'Download Berkas Konseling';
        $data['tipeberkas'] = 1;
        $this->load->view('home', $data);
    }

    public function peraturan() {
        $data = $this->data;
        $data['method'] = $this->router->fetch_method();
        $data['segment'] = $this->uri->segment(2);
        $year = $this->session->userdata("year");
        $semester = $this->session->userdata("semester");
        $where = array('type' => 2, 'year' => $year, 'semester' => $semester);
        $data['list_berkas'] = $this->berkas->selectTable($where)->result_array();
        $data['content'] = "bp/berkas/download";
        $data['title'] = 'Download Peraturan';
        $data['tipeberkas'] = 2;
        $this->load->view('home', $data);
    }

    public function download_hapus() {
        $id_konseling = $this->uri->segment(3);
        $tipeberkas = $this->uri->segment(4);
        $where = array('id_konseling' => $id_konseling);
        $this->berkas->deleteTable($where);
        if ($tipeberkas == 1) {
            $this->log_aktivitas('Hapus Berkas Konseling');
        } else {
            $this->log_aktivitas('Hapus Berkas Peraturan');
        }
        $this->session->set_flashdata('success', 'Berkas Terhapus');

        redirect("c_home/download/");
    }

    public function upload() {
        $data = $this->data;
        $segment = $this->uri->segment(2);
        $type = 'tambah';
        $judul = "Upload Berkas";
        $tipe_berkas = $this->uri->segment(3);
        $this->upload_form($judul, $type, $segment, $tipe_berkas);
    }

    public function peraturan_tambah() {
        $data = $this->data;
        $segment = $this->uri->segment(2);
        $type = 'tambah';
        $judul = "Upload Peraturan";
        $tipe_berkas = $this->uri->segment(3);
        $this->upload_form($judul, $type, $segment, $tipe_berkas);
    }

    public function upload_edit() {
        $data = $this->data;
        $segment = $this->uri->segment(2);
        $type = 'ubah';
        $tipe_berkas = $this->uri->segment(4);
        if ($tipe_berkas == 1) {
            $judul = "ubah Berkas";
        } else {
            $judul = "ubah Peraturan";
        }
        $this->upload_form($judul, $type, $segment, $tipe_berkas);
    }

    public function upload_form($title, $type, $segment, $tipe_berkas) {
        if ($type == 'tambah') {
            $metadata = $this->berkas->getMetadata();
            foreach ($metadata['columns'] as $value) {
                $data['valueData'][$value->name] = '';
            }
        } else {
            $where = array('id_konseling' => $this->uri->segment(3));
            $result = $this->berkas->selectTable($where)->result_array();
            $data['valueData'] = $result[0];
        }
        $this->data['title'] = $title;
        $data = $this->data + $data;
        $data['segment'] = $segment;
        $data['content'] = "bp/berkas/upload";

        if ($_POST) {
            $message = "";
            $keterangan = $this->input->post('keterangan');
            $tgl_upload = $this->input->post('tgl_upload');
            $judul = $this->input->post('judul');
            $succes = true;
            $postData = array('keterangan' => $keterangan, 'tgl_upload' => $tgl_upload, 'judul' => $judul, 'type' => $tipe_berkas);
            if (!empty($_FILES['berkas']['name'])) {
                $gambar = $_FILES['berkas']['name'];
                $gambar_type = $_FILES['berkas']['type'];
                $gambar_size = $_FILES['berkas']['size'];
                if ($gambar_type != "") {
                    $file_type = explode("/", $gambar_type);
                }
                $config = $this->path_konseling();
                if ($tipe_berkas == 1) {
                    $awal = "konseling_";
                } else {
                    $awal = "peraturan_";
                    $config['allowed_types'] = 'gif|jpg|jpeg|png|JPG|doc|docx|pdf';
                }
                $config['file_name'] = $awal . date('YmdHis') . "." . $file_type[1];
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('berkas')) {
                    $message .= $this->upload->display_errors();
                    $succes = FALSE;
                } else {
                    $data = array('upload_data' => $this->upload->data());
                    $postData['berkas'] = $config['file_name'];
                }
            }else{
                $message .="File Upload Harus Diisi";
                $succes = false;
            }

            if ($this->berkas->validate() && $succes) {
                if ($type == 'tambah') {
                    $this->berkas->insertTable($postData);
                    $data['message_alert'] = 'alert alert-success';
                    if ($tipe_berkas == 1) {
                        $this->log_aktivitas('Tambah Berkas Konseling');
                    } else {
                        $this->log_aktivitas('Tambah Berkas Peraturan');
                    }
                    $this->session->set_flashdata('success', 'Tambah Data konseling Berhasil');
                } else { //update data aspek
                    $where = array('id_konseling' => $this->uri->segment(3));
                    $this->session->set_flashdata('success', 'Edit Berkas Berhasil');
                    if ($tipe_berkas == 1) {
                        $this->log_aktivitas('Ubah Berkas Konseling');
                    } else {
                        $this->log_aktivitas('Ubah Berkas Peraturan');
                    }
                    $this->berkas->updateTable($postData, $where);
                }

                if ($tipe_berkas == 1) {
                    redirect("c_home/download");
                } else {
                    redirect("c_home/peraturan");
                }
            } else {
                $message .= validation_errors();
                $this->session->set_flashdata('error', $message);
                if ($tipe_berkas == 1) {

                    redirect("c_home/upload/1");
                } else {
                    redirect("c_home/peraturan_tambah/2");
                }
            }
        }
        $this->load->view('home', $data);
    }

    public function logout() {
        $this->pesan_log();

        redirect("c_tamu");
    }

    public function profile() {
        $data = $this->list_session();
    }

    public function cekuser($username) {
        $where = array('username' => $username);
        $jumlah_nis = $this->user->countTable($where);
        if ($jumlah_nis > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function list_status() {
        $data = array(
            '1' => 'Aktif',
            '2' => 'Tidak Aktif',
        );
        return $data;
    }

    public function aktivitas() {
        $year = $this->session->userdata("year");
        $semester = $this->session->userdata("semester");
        $data = $this->data;
        $judul = 'Data Aktivitas';
        $data['segment'] = $this->uri->segment(2);
        $data['title'] = $judul;
        $join = array(
            'user_activity' => 'user_activity.iduser = user.iduser'
        );
        $type = $this->session->userdata("type");
        $iduser = $this->session->userdata("iduser");
        $where = array('user_activity.semester' => $semester, 'user_activity.year' => $year);

        if ($type != 1) {
            $where = $where + array('user_activity.iduser' => $iduser);
        } else {
            $where = array('user_activity.semester' => $semester, 'user_activity.year' => $year);
        }
        $data['list_status'] = $this->list_user_full();
        $data['list_aktifitas'] = $this->user->selectTableWithJoin($where, $join, NULL, NULL, NULL, 'tgl', 'desc')->result_array();
        $data['content'] = "bp/aktivitas/aktivitas_admin";
        $this->load->view('home', $data);
    }

    public function startsemester() {
        $year = $this->session->userdata("year");
        $semester = $this->session->userdata("semester");
        $data = $this->data;
        $judul = 'Data Aktivitas';
        $data['list_semester'] = $this->list_semester();
        $data['content'] = "bp/aktivitas/startsemester";
        $where = array('start_semester' => $semester, 'start_year' => $year);
        $model = $this->_getStartSemester($where);
        $data['segment'] = $this->uri->segment(2);
        $data = $data + $model;
        $message = "";
        $succes = true;
        $data['disabled'] = "";
        if ($_POST) {
            $start_semester = $this->input->post('start_semester');
            $start_year = $this->input->post('start_year');
            $from_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $where = array('start_semester' => $start_semester, 'start_year' => $start_year);
            $jumlahStartSemester = $this->start_semester->countTable($where);
            $postData = array(
                'start_semester' => $start_semester,
                'start_year' => $start_year,
                'from_date' => $from_date,
                'to_date' => $to_date,
            );
            if ($from_date > $to_date) {
                $succes = false;
                $message .= "Dari  : $from_date tidak boleh lebih dari Sampai : $to_date.";
            }

            if ($this->start_semester->validate() && $succes) {
                if ($jumlahStartSemester > 0) {
                    $this->start_semester->updateTable($postData, $where);
                    $this->log_aktivitas('Ubah Tahun Ajaran');
                } else {
                    $this->start_semester->insertTable($postData, $where);
                    $this->log_aktivitas('Tambah Tahun Ajaran');
                }
                $school_setting_id = $this->session->userdata("school_setting_id");
                $whereSchoolSetting = array('school_setting_id' => $school_setting_id);
                $dataSchoolSetting = array('year' => $start_year, 'semester' => $start_semester);
                $this->school_setting->updateTable($dataSchoolSetting, $whereSchoolSetting);
                $this->session->set_userdata('year', $start_year);
                $this->session->set_userdata('semester', $start_semester);
            } else {
                $message .= validation_errors();
                $this->session->set_flashdata('error', $message);
            }
            redirect("c_home/startsemester");
        }
        $this->load->view('home', $data);
    }

    public function getFromToDate() {
        $where = array(
            'start_year' => $_POST['start_year'],
            'start_semester' => $_POST['start_semester'],
        );

        $model = $this->_getStartSemester($where);

        echo json_encode(array('from_date' => $model['valueData']['from_date'], 'to_date' => $model['valueData']['to_date'], 'next_year' => $model['valueData']['next_year']));
    }

    public function _getStartSemester($where) {
        $jumlahStartSemester = $this->start_semester->countTable($where);
        if ($jumlahStartSemester > 0) {
            $result = $this->start_semester->selectTable($where)->result_array();
            $data['valueData'] = $result[0];
        } else {
            $metadata = $this->start_semester->getMetadata();
            foreach ($metadata['columns'] as $value) {
                $data['valueData'][$value->name] = '';
            }
            $data['valueData']['start_year'] = date('Y');
        }
        $data['valueData']['next_year'] = $data['valueData']['start_year'] + 1;
        return $data;
    }

    public function list_semester() {
        $data = array('1' => 'Ganjil', '2' => 'Genap');
        return $data;
    }

    public function tahun_ajaran() {
        $year = $this->session->userdata("year");
        $semester = $this->session->userdata("semester");
        $data = $this->data;
        $judul = 'Data Aktivitas';
        $data['list_semester'] = $this->list_semester();
        $data['content'] = "bp/aktivitas/startsemester";
        $where = array('start_semester' => $semester, 'start_year' => $year);
        $model = $this->_getStartSemester($where);
        $data['segment'] = $this->uri->segment(2);
        $data = $data + $model;
        $message = "";
        $disabled = "disabled";
        $data['disabled'] = $disabled;
        $succes = true;
        if ($_POST) {
            $start_semester = $this->input->post('start_semester');
            $start_year = $this->input->post('start_year');
            $next_year = $this->input->post('nextYear');
            $from_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $where = array('start_semester' => $start_semester, 'start_year' => $start_year);
            $jumlahStartSemester = $this->start_semester->countTable($where);
            $postData = array(
                'start_semester' => $start_semester,
                'start_year' => $start_year,
                'from_date' => $from_date,
                'to_date' => $to_date,
            );
            if ($from_date > $to_date) {
                $succes = false;
                $message .= "Dari  : $from_date tidak boleh lebih dari Sampai : $to_date.";
            }

            if ($succes) {
                if ($jumlahStartSemester > 0) {
                    $this->session->set_userdata('year', $start_year);
                    $this->session->set_userdata('semester', $start_semester);
                    $this->session->set_flashdata('success', 'Tahun Ajaran Diubah');
                } else {
                    $succes = false;
                    $message .= "Tahun Ajaran Belum Diset untuk Tahun " . $start_year . '/' . $nextYear . 'semester ' . $start_semester;
                    $this->session->set_flashdata('error', $message);
                }
                redirect("c_home/tahun_ajaran");
            }
        }
        $this->load->view('home', $data);
    }

    function list_jurusan() {
        $data = array(
            1 => 'Kelas 7',
            2 => 'Kelas 8',
            3 => 'Kelas 9',
           // 4 => 'Akuntansi',
            // 5 => 'Pemasaran'
        );
        return $data;
    }
    public function tes(){
    $dataAsepk  =  $this->aspek->selectTable()->result_array();
    $listAspek = "";
        $year = $this->session->userdata("year");
        if(!empty($_GET['year'])){
           $year = $_GET['year'];
        }
        
     foreach ($dataAsepk as $aspek) {
          $listAspek .= " SUM(CASE WHEN id_aspek = ".$aspek['id_aspek']."  THEN 1 ELSE 0 END ) AS '".$aspek['id_aspek']."',";
    }
    $where = "";
    if($this->session->userdata("nis")){
        $nis = $this->session->userdata("nis");
        $where .=" and  nis = $nis";
    }
        $sql = "SELECT nis,id_aspek ,year, $listAspek semester  
FROM `pelanggaran_siswa`  where year = $year  $where group by semester";
        $data = $this->pelanggaran_siswa->findBySql($sql)->result_array();
$dataSemester =  $this->list_semester();
        $semester = array();
        $semester['name'] = 'Semester';
        $rows['name'] = 'Aspek Kerapihan';
        $rows2['name'] = 'Aspek Kerajinan';
        $rows3['name'] = 'Aspek Kelakuan';
        $rows4['name'] = 'Aspek Lain-Lain';
        foreach ($data as $value) {
            $semester['data'][] = $dataSemester[$value['semester']];
            $rows['data'][] = $value['1'];
            $rows2['data'][] = $value['2'];
            $rows3['data'][] = $value['3'];
            $rows4['data'][] = $value['4'];
        }
        
        $result = array();
        array_push($result, $semester);
        array_push($result, $rows);
        array_push($result, $rows2);
        array_push($result, $rows3);
        array_push($result, $rows4);
        
    print json_encode($result, JSON_NUMERIC_CHECK);

    }
    public function tesgrafik(){
        $this->load->view('bp/pelanggaran/grafik');
    }
    
    public function grafikPelanggaran(){
        $data = array('title' => 'Home');
        $sql = "SELECT year FROM `pelanggaran_siswa` group by year";
        $dataTahun = $this->pelanggaran_siswa->findBySql($sql)->result_array();        
        $data = $this->data + $data;
        $data['method'] = $this->router->fetch_method();
        $data['segment'] = $this->uri->segment(2);
        $where = array('type' => 2,'semester'=> $this->data['semester'],'year'=>$this->data['year']);
        $data['list_tahun'] = $dataTahun;
        $data['content'] = "bp/pelanggaran/grafik";
        $data['list_berkas'] = $this->berkas->selectTable($where)->result_array();
        $this->load->view('home', $data);
    }
}

/* End of file welcome.php */
    /* Location: ./application/controllers/welcome.php */    