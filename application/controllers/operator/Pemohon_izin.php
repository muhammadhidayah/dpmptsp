<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemohon_izin extends CI_Controller{

  public function __construct() {
    parent::__construct();
    //Codeigniter : Write Less Do More
    if($this->session->userdata('jenis_user') != "Operator") {
      $this->session->set_flashdata('msg', 'Oppss! Anda harus LogIn sebagai Operator');
      redirect(base_url('login'));
    }

    $this->load->model('Pemohonizin_model');
  }

  function index() {
    $data['title'] = 'Pemohon Izin';
    $data['breadcrumb'] = '<li> <a href = "'. base_url('operator/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Pemohon Izin</li>';
    $data['pemohon'] = $this->Pemohonizin_model->getAllPemohonIzin();

    $this->template->load('layout/static', 'operator/pemohonizin', $data);

  }

  function insertpemohonizin() {
    if(!isset($_POST['submit'])) {
      $data['title'] = 'Tambah Pemohon Izin';
      $data['breadcrumb'] = '<li> <a href = "'. base_url('operator/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li><a href="'. base_url('operator/Pemohon_izin') .'"><i></i> Pemohon Izin</a></li><li class="active">Tambah Pemohon</li>';

      $this->template->load('layout/static', 'operator/insertpemohonizin', $data);
    } else {
      // Memberikan Rules Pada setiap inputan
      $this->form_validation->set_rules('nik_pemohon_izin', 'NIK Pemohon Izin', 'required|numeric|exact_length[16]|is_unique[tbl_pemohon_izin.nik_pemohon_izin]',
                                  array('required'      => 'NIK User Pemohon Harus di Isi',
                                        'numeric'       => 'Mohon Masukkan NIK Yang Sebenarnya',
                                        'exact_length'  => 'Masukkan NIK Yang Benar Sesuai KTP',
                                        'is_unique'     => 'NIK Sudah Terdaftar'));

      $this->form_validation->set_rules('nama_pemohon_izin', 'Nama Pemohon Izin', 'required',
                                  array('required'  => 'Nama Pemohon Izin Harus di Isi'));

      $this->form_validation->set_rules('jk_pemohon_izin', 'Jenis Kelamin Pemohon Izin', 'required|in_list[L,P]',
                                  array('required'  => 'Jenis Kelamin Harus di Isi',
                                        'in_list'   => 'Jenis Kelamin Tidak Terdaftar'));

      $this->form_validation->set_rules('alamat_pemohon_izin', 'Alamat Pemohon Izin', 'required',
                                  array('required'  => 'Alamat Pemohon Izin Harus di Isi'));

      $this->form_validation->set_rules('tlp_pemohon_izin', 'Telepon Pemohon Izin', 'required|numeric',
                                  array('required'  => 'Nomor Telepon Pemohon Izin Harus di Isi',
                                        'numeric'   => 'Masukkan Nomor Telepon Dengan Benar'));

      $this->form_validation->set_rules('email_pemohon_izin', 'Email Pemohon Izin', 'valid_email',
                                  array('valid_email'  => 'Harap Masukkan E-mail Dengan Benar'));
      // End Memberikan Rules Pada setiap inputan

      //Memberikan validasi terhadap rules pada form
      if($this->form_validation->run() === FALSE) {
        $data['title'] = 'Tambah Pemohon Izin';
        $data['breadcrumb'] = '<li> <a href = "'. base_url('operator/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li><a href="'. base_url('operator/Pemohon_izin') .'"><i></i> Pemohon Izin</a></li><li class="active">Tambah Pemohon</li>';

        $this->template->load('layout/static', 'operator/insertpemohonizin', $data);
      } else {
        //Memasukkan Data Yang Terdapat KTP yang di Upload
        if(!empty($_FILES['ktp']['name'])) {
          $config['upload_path'] = './assets/upload/ktp';
          $config['allowed_types']  = 'jpg|png';
          $config['max_size'] = '12000';

          $this->load->library('upload', $config);

          /** Proses Upload ke Dalam DATABASE **/
          if(!$this->upload->do_upload('ktp')) {
            $data['title'] = 'Tambah Pemohon Izin';
            $data['breadcrumb'] = '<li> <a href = "'. base_url('operator/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li><a href="'. base_url('operator/Pemohon_izin') .'"><i></i> Pemohon Izin</a></li><li class="active">Tambah Pemohon</li>';

            $this->template->load('layout/static', 'operator/insertpemohonizin', $data);
          } else {
            $dataktp = array('uploads' => $this->upload->data());

            $data = array('nik_pemohon_izin'    => $this->input->post('nik_pemohon_izin'),
                          'nama_pemohon_izin'   => strtoupper($this->input->post('nama_pemohon_izin')),
                          'jk_pemohon_izin'     => $this->input->post('jk_pemohon_izin'),
                          'alamat_pemohon_izin' => $this->input->post('alamat_pemohon_izin'),
                          'tlp_pemohon_izin'    => $this->input->post('tlp_pemohon_izin'),
                          'email_pemohon_izin'  => $this->input->post('email_pemohon_izin'),
                          'ktp_pemohon_izin'    => $dataktp['uploads']['file_name']);

            //Semua Data Akan di Masukkan ke dalam Database
            $this->Pemohonizin_model->insertpemohonizin($data);
            $this->session->set_flashdata('sukses', 'Data Pemohon Izin Berhasil di Tambahkan');
            redirect(base_url('operator/Pemohon_izin'));

            /** END Proses Upload ke Dalam Database**/
          }
          //End Memasukkan Data Yang Terdapat KTP yang di Upload
        } else {
          // Memasukkan Data Yang Tidak Terdapat KTP untuk di Upload

          $data = array('nik_pemohon_izin'    => $this->input->post('nik_pemohon_izin'),
                        'nama_pemohon_izin'   => strtoupper($this->input->post('nama_pemohon_izin')),
                        'jk_pemohon_izin'     => $this->input->post('jk_pemohon_izin'),
                        'alamat_pemohon_izin' => $this->input->post('alamat_pemohon_izin'),
                        'tlp_pemohon_izin'    => $this->input->post('tlp_pemohon_izin'),
                        'email_pemohon_izin'  => $this->input->post('email_pemohon_izin'));

          $this->Pemohonizin_model->insertpemohonizin($data);
          $this->session->set_flashdata('sukses', 'Data Pemohon Izin Berhasil di Tambahkan');
          redirect(base_url('operator/Pemohon_izin'));
        }


      }

    }
  }

  function editpemohonizin($nik) {
    if(!isset($_POST['submit'])) {
      $data['title'] = 'Edit Pemohon Izin';
      $data['breadcrumb'] = '<li> <a href = "'. base_url('operator/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li><a href="'. base_url('operator/Pemohon_izin') .'"><i></i> Pemohon Izin</a></li><li class="active">Edit Pemohon</li>';
      $data['pemohon']  = $this->Pemohonizin_model->getDetailPemohonIzin($nik);

      $this->template->load('layout/static', 'operator/editpemohonizin', $data);
    } else {
      // Memberikan Rules Pada setiap inputan
      $this->form_validation->set_rules('nama_pemohon_izin', 'Nama Pemohon Izin', 'required',
                                  array('required'  => 'Nama Pemohon Izin Harus di Isi'));

      $this->form_validation->set_rules('jk_pemohon_izin', 'Jenis Kelamin Pemohon Izin', 'required|in_list[L,P]',
                                  array('required'  => 'Jenis Kelamin Harus di Isi',
                                        'in_list'   => 'Jenis Kelamin Tidak Terdaftar'));

      $this->form_validation->set_rules('alamat_pemohon_izin', 'Alamat Pemohon Izin', 'required',
                                  array('required'  => 'Alamat Pemohon Izin Harus di Isi'));

      $this->form_validation->set_rules('tlp_pemohon_izin', 'Telepon Pemohon Izin', 'required|numeric',
                                  array('required'  => 'Nomor Telepon Pemohon Izin Harus di Isi',
                                        'numeric'   => 'Masukkan Nomor Telepon Dengan Benar'));

      $this->form_validation->set_rules('email_pemohon_izin', 'Email Pemohon Izin', 'valid_email',
                                  array('valid_email'  => 'Harap Masukkan E-mail Dengan Benar'));
      // End Memberikan Rules Pada setiap inputan

      //Memberikan validasi terhadap rules pada form
      if($this->form_validation->run() === FALSE) {
        $data['title'] = 'Tambah Pemohon Izin';
        $data['breadcrumb'] = '<li> <a href = "'. base_url('operator/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li><a href="'. base_url('operator/Pemohon_izin') .'"><i></i> Pemohon Izin</a></li><li class="active">Edit Pemohon</li>';

        $this->template->load('layout/static', 'operator/insertpemohonizin', $data);
      } else {
        //Memasukkan Data Yang Terdapat KTP yang di Upload
        if(!empty($_FILES['ktp']['name'])) {
          $config['upload_path'] = './assets/upload/ktp';
          $config['allowed_types']  = 'jpg|png';
          $config['max_size'] = '12000';

          $this->load->library('upload', $config);

          /** Proses Upload ke Dalam DATABASE **/
          if(!$this->upload->do_upload('ktp')) {
            $data['title'] = 'Tambah Pemohon Izin';
            $data['breadcrumb'] = '<li> <a href = "'. base_url('operator/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li><a href="'. base_url('operator/Pemohon_izin') .'"><i></i> Pemohon Izin</a></li><li class="active">Edit Pemohon</li>';

            $this->template->load('layout/static', 'operator/insertpemohonizin', $data);
          } else {
            $dataktp = array('uploads' => $this->upload->data());


            if($data['pemohon']->ktp_pemohon_izin != "") {
              unlink('./assets/upload/ktp/'.$data['pemohon']->ktp_pemohon_izin);
            }

            $data = array('nama_pemohon_izin'   => strtoupper($this->input->post('nama_pemohon_izin')),
                          'jk_pemohon_izin'     => $this->input->post('jk_pemohon_izin'),
                          'alamat_pemohon_izin' => $this->input->post('alamat_pemohon_izin'),
                          'tlp_pemohon_izin'    => $this->input->post('tlp_pemohon_izin'),
                          'email_pemohon_izin'  => $this->input->post('email_pemohon_izin'),
                          'ktp_pemohon_izin'    => $dataktp['uploads']['file_name']);

            //Semua Data Akan di Masukkan ke dalam Database
            $this->Pemohonizin_model->updatepemohonizin($nik, $data);
            $this->session->set_flashdata('sukses', 'Data Pemohon Izin Berhasil di Update');
            redirect(base_url('operator/Pemohon_izin'));

            /** END Proses Upload ke Dalam Database**/
          }
          //End Memasukkan Data Yang Terdapat KTP yang di Upload
        } else {
          // Memasukkan Data Yang Tidak Terdapat KTP untuk di Upload

          $data = array('nama_pemohon_izin'   => strtoupper($this->input->post('nama_pemohon_izin')),
                        'jk_pemohon_izin'     => $this->input->post('jk_pemohon_izin'),
                        'alamat_pemohon_izin' => $this->input->post('alamat_pemohon_izin'),
                        'tlp_pemohon_izin'    => $this->input->post('tlp_pemohon_izin'),
                        'email_pemohon_izin'  => $this->input->post('email_pemohon_izin'));

           $this->Pemohonizin_model->updatepemohonizin($nik, $data);
           $this->session->set_flashdata('sukses', 'Data Pemohon Izin Berhasil di Update');
           redirect(base_url('operator/Pemohon_izin'));
        }

      }
    }
  }

  function deletepemohonizin($nik) {
    $pemohon = $this->Pemohonizin_model->getDetailPemohonIzin($nik);

    if($pemohon->ktp_pemohon_izin != "") {
      unlink('./assets/upload/ktp/'.$data['pemohon']->ktp_pemohon_izin);
    }

    $this->Pemohonizin_model->deletePemohonIzin($nik);
    $this->session->set_flashdata('sukses', 'Data Pemohon Izin Berhasil di Hapus');
    redirect(base_url('operator/Pemohon_izin'));

  }

  function searchPemohonIzin() {
    $nik = $_GET['term'];

    $pemohon = $this->Pemohonizin_model->searchPemohonIzin($nik);

    $data = array();
    foreach ($pemohon as $pemohon) {
      # code...
      $data[] = array('label' => $pemohon->nama_pemohon_izin.' - '. $pemohon->nik_pemohon_izin, 'value' => $pemohon->nik_pemohon_izin);
    }

    echo json_encode($data);
  }

  function detailpemohonizin($nik) {

    $data = $this->Pemohonizin_model->getDetailPemohonIzin($nik);

    echo json_encode($data);

  }

  function datapemohonizin($status_perizinan) {
    $status = "";

    if($status_perizinan == "dalamproses") {
        $status = "Dalam Proses";
    } elseif ($status_perizinan == "menunggu") {
        $status = "Menunggu";
    } else {
      $status = "Izin Terbit";
    }

    $pemohon = $this->Pemohonizin_model->getPemohonByStatus($status);

    $data['title'] = 'Pemohon Izin';
    $data['breadcrumb'] = '<li> <a href = "'. base_url('operator/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Pemohon Izin</li>';
    $data['pemohon'] = $pemohon;

    $this->template->load('layout/static', 'operator/pemohonizin', $data);

  }

}
