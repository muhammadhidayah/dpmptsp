<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller{

  public function __construct() {
    parent::__construct();
    //Codeigniter : Write Less Do More
    if($this->session->userdata('logged_id') != TRUE
			&& $this->session->userdata('jenis_user') != "Admin") {
			$this->session->set_flashdata('msg', 'Ooopppss... Anda Harus Login Sebagai <br />Admin Terlebih Dahulu');

			redirect(base_url('login'));
		}

    $this->load->model('Pegawai_model');
    $this->load->model('Jabatan_model');
  }

  function index() {
    $data['title'] = 'Data Pegawai';
    $data['breadcrumb'] = '<li> <a href = "'. base_url('admin/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li><i class="active"></i> Pegawai</li>';
    $data['pegawai'] = $this->Pegawai_model->getAllPegawai();

    $this->template->load('layout/static', 'admin/pegawai', $data);
  }

  function insertpegawai() {
    if(!isset($_POST['submit'])) {
      $data['title'] = 'Tambah Pegawai';
      $data['breadcrumb'] = '<li> <a href = "'. base_url('admin/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li><a href="'.base_url('admin/pegawai').'"><i></i> Pegawai</a></li><li><i class="active"></i> Tambah Pegawai</li>';
      $data['jabatan'] = $this->Jabatan_model->getAllJabatan();
      $this->template->load('layout/static', 'admin/insertpegawai', $data);
    } else {
      $this->form_validation->set_rules('nip', 'Nomor Induk Pegawai', 'required|numeric|exact_length[18]|is_unique[tbl_pegawai.nip]',
                                  array('required'      => 'Nomor Induk Pegawai Harus di Isi',
                                        'numeric'       => 'Nomor Induk Pegawai Harus Angak',
                                        'exact_length'  => 'Nomor Induk Pegawai Salah',
                                        'is_unique'     => 'Nomor Induk Pegawai Sudah Terdaftar'));

      $this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'required',
                                  array('required'  => 'Nama Pegawai Harus di Isi'));

      $this->form_validation->set_rules('alamat_pegawai', 'Alamat Pegawai', 'required',
                                  array('required'  => 'Alamat Pegawai Harus di Isi Lengkap'));

      $this->form_validation->set_rules('tlp_pegawai', 'Nomor Telepon Pegawai', 'required|numeric',
                                  array('required'  => 'Nomor Telepon Pegawai Harus di Isi',
                                        'numeric'   => 'Nomor Telepon Yang Anda Masukkan Salah'));

      $this->form_validation->set_rules('email_pegawai', 'Email Pegawai', 'required|valid_email',
                                  array('required'    => 'Email Pegawai Harus di Isi',
                                        'valid_email' => 'Email Yang Anda Inputkan Tidak Valid'));

      $this->form_validation->set_rules('id_jabatan', 'Jabatan Pegawai', 'required',
                                  array('required'  => 'Jabatan Pegawai Harus di Isi'));

      if($this->form_validation->run() === FALSE) {
        $data['title'] = 'Tambah Pegawai';
        $data['breadcrumb'] = '<li> <a href = "'. base_url('admin/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li><a href="'.base_url('admin/pegawai').'"><i></i> Pegawai</a></li><li><i class="active"></i> Tambah Pegawai</li>';
        $data['jabatan'] = $this->Jabatan_model->getAllJabatan();
        $this->template->load('layout/static', 'admin/insertpegawai', $data);
      } else {
        if(!empty($_FILES['foto_pegawai']['name'])) {

          $config['upload_path'] = './assets/upload/fotouser';
          $config['allowed_types'] = 'jpg|png|img|jpeg';
          $config['max_size']  		= '12000';
    			$config['max_width']  		= '1024';
    			$config['max_height']  		= '768';

          $this->load->library('upload', $config);

          if(! $this->upload->do_upload('foto_pegawai')) {
            $data['title'] = 'Tambah Pegawai';
            $data['breadcrumb'] = '<li> <a href = "'. base_url('admin/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li><a href="'.base_url('admin/pegawai').'"><i></i> Pegawai</a></li><li><i class="active"></i> Tambah Pegawai</li>';
            $data['jabatan'] = $this->Jabatan_model->getAllJabatan();
            $this->template->load('layout/static', 'admin/insertpegawai', $data);
          } else {
            $foto_pegawai = array('upload' => $this->upload->data());

            $data = array('nip'             => $this->input->post('nip'),
                          'nama_pegawai'    => $this->input->post('nama_pegawai'),
                          'alamat_pegawai'  => $this->input->post('alamat_pegawai'),
                          'tlp_pegawai'     => $this->input->post('tlp_pegawai'),
                          'email_pegawai'   => $this->input->post('email_pegawai'),
                          'foto_pegawai'    => $foto_pegawai['upload']['file_name'],
                          'id_jabatan'      => $this->input->post('id_jabatan'));

            $this->Pegawai_model->insertPegawai($data);

            $this->session->set_flashdata('sukses', 'Data Pegawai Berhasil di Tambahkan');
            redirect(base_url('admin/pegawai'));

          }

        } else {
          $data = array('nip'             => $this->input->post('nip'),
                        'nama_pegawai'    => $this->input->post('nama_pegawai'),
                        'alamat_pegawai'  => $this->input->post('alamat_pegawai'),
                        'tlp_pegawai'     => $this->input->post('tlp_pegawai'),
                        'email_pegawai'   => $this->input->post('email_pegawai'),
                        'id_jabatan'      => $this->input->post('id_jabatan'));

          $this->Pegawai_model->insertPegawai($data);

          $this->session->set_flashdata('sukses', 'Data Pegawai Berhasil di Tambahkan');
          redirect(base_url('admin/pegawai'));

        }
      }


    }
  }

  function updatePegawai($nip) {
    if(!isset($_POST['submit'])) {
      $data['title'] = 'Edit Data Pegawai';
      $data['breadcrumb'] = $data['breadcrumb'] = '<li> <a href = "'. base_url('admin/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li><a href="'.base_url('admin/pegawai').'"><i></i> Pegawai</a></li><li><i class="active"></i> Tambah Pegawai</li>';
      $data['pegawai']  = $this->Pegawai_model->getDetailPegawai($nip);
      $data['jabatan'] = $this->Jabatan_model->getAllJabatan();
      $this->template->load('layout/static', 'admin/updatepegawai', $data);
    } else {
      if($nip != $this->input->post('nip')) {
        $this->form_validation->set_rules('nip', 'Nomor Induk Pegawai', 'required|numeric|exact_length[18]|is_unique[tbl_pegawai.nip]',
                                    array('required'      => 'Nomor Induk Pegawai Harus di Isi',
                                          'numeric'       => 'Nomor Induk Pegawai Harus Angak',
                                          'exact_length'  => 'Nomor Induk Pegawai Salah',
                                          'is_unique'     => 'Nomor Induk Pegawai Sudah Terdaftar'));
      } else {
        $this->form_validation->set_rules('nip', 'Nomor Induk Pegawai', 'required|numeric|exact_length[18]',
                                    array('required'      => 'Nomor Induk Pegawai Harus di Isi',
                                          'numeric'       => 'Nomor Induk Pegawai Harus Angak',
                                          'exact_length'  => 'Nomor Induk Pegawai Salah'));

      }

      $this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'required',
                                  array('required'  => 'Nama Pegawai Harus di Isi'));

      $this->form_validation->set_rules('alamat_pegawai', 'Alamat Pegawai', 'required',
                                  array('required'  => 'Alamat Pegawai Harus di Isi Lengkap'));

      $this->form_validation->set_rules('tlp_pegawai', 'Nomor Telepon Pegawai', 'required|numeric',
                                  array('required'  => 'Nomor Telepon Pegawai Harus di Isi',
                                        'numeric'   => 'Nomor Telepon Yang Anda Masukkan Salah'));

      $this->form_validation->set_rules('email_pegawai', 'Email Pegawai', 'required|valid_email',
                                  array('required'    => 'Email Pegawai Harus di Isi',
                                        'valid_email' => 'Email Yang Anda Inputkan Tidak Valid'));

      $this->form_validation->set_rules('id_jabatan', 'Jabatan Pegawai', 'required',
                                  array('required'  => 'Jabatan Pegawai Harus di Isi'));

      if($this->form_validation->run() === FALSE) {
        $data['title'] = 'Tambah Pegawai';
        $data['breadcrumb'] = '<li> <a href = "'. base_url('admin/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li><a href="'.base_url('admin/pegawai').'"><i></i> Pegawai</a></li><li><i class="active"></i> Tambah Pegawai</li>';
        $data['jabatan'] = $this->Jabatan_model->getAllJabatan();
        $this->template->load('layout/static', 'admin/updatepegawai', $data);
      } else {
        if(!empty($_FILES['foto_pegawai']['name'])) {

          $config['upload_path'] = './assets/upload/fotouser';
          $config['allowed_types'] = 'jpg|png|img|jpeg';
          $config['max_size']  		= '12000';
          $config['max_width']  		= '1024';
          $config['max_height']  		= '768';

          $this->load->library('upload', $config);

          if(! $this->upload->do_upload('foto_pegawai')) {
            $data['title'] = 'Tambah Pegawai';
            $data['breadcrumb'] = '<li> <a href = "'. base_url('admin/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li><a href="'.base_url('admin/pegawai').'"><i></i> Pegawai</a></li><li><i class="active"></i> Tambah Pegawai</li>';
            $data['jabatan'] = $this->Jabatan_model->getAllJabatan();
            $this->template->load('layout/static', 'admin/updatepegawai', $data);
          } else {
            $foto_pegawai = array('upload' => $this->upload->data());

            $data = array('nip'             => $this->input->post('nip'),
                          'nama_pegawai'    => $this->input->post('nama_pegawai'),
                          'alamat_pegawai'  => $this->input->post('alamat_pegawai'),

                          'tlp_pegawai'     => $this->input->post('tlp_pegawai'),
                          'email_pegawai'   => $this->input->post('email_pegawai'),
                          'foto_pegawai'    => $foto_pegawai['upload']['file_name'],
                          'id_jabatan'      => $this->input->post('id_jabatan'));

            $this->Pegawai_model->updatepegawai($data);

            $this->session->set_flashdata('sukses', 'Data Pegawai Berhasil di Update');
            redirect(base_url('admin/pegawai'));

          }

        } else {
          $data = array('nip'             => $this->input->post('nip'),
                        'nama_pegawai'    => $this->input->post('nama_pegawai'),
                        'alamat_pegawai'  => $this->input->post('alamat_pegawai'),
                        'tlp_pegawai'     => $this->input->post('tlp_pegawai'),
                        'email_pegawai'   => $this->input->post('email_pegawai'),
                        'id_jabatan'      => $this->input->post('id_jabatan'));

          $this->Pegawai_model->updatepegawai($nip, $data);

          $this->session->set_flashdata('sukses', 'Data Pegawai Berhasil di Update');
          redirect(base_url('admin/pegawai'));

        }
      }
    }
  }

  function deletePegawai($nip) {
    $pegawai = $this->Pegawai_model->getDetailPegawai($nip);

    if($pegawai->foto_pegawai != "") {
      unlink('./assets/upload/fotouser/'.$pegawai->foto_pegawai);
    }

    $this->Pegawai_model->deletePegawai($nip);

    $this->session->userdata('sukses', 'Data Pegawai Berhasil di Hapus');
    redirect(base_url('admin/pegawai'));
  }

  function searchPegawai() {
    $nip = $_GET['term'];

    $pegawai = $this->Pegawai_model->searchPegawai($nip);
    $data[] = array();

    foreach ($pegawai as $pegawai) {
      $data[] = array('label' => $pegawai->nip .' - '.$pegawai->nama_pegawai, 'value' => $pegawai->nip);
    }

    echo json_encode($data);
  }

}
