<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{

  public function __construct() {
    parent::__construct();
    //Codeigniter : Write Less Do More
    if($this->session->userdata('logged_id') != TRUE
			&& $this->session->userdata('jenis_user') != "Admin") {
			$this->session->set_flashdata('msg', 'Ooopppss... Anda Harus Login Sebagai <br />Admin Terlebih Dahulu');

			redirect(base_url('login'));
		}

    $this->load->model('User_model');

  }

  function index() {
    $data['title'] = 'Data Pegawai';
    $data['breadcrumb'] = '<li> <a href = "'. base_url('admin/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li><i class="active"></i> User</li>';
    $data['user'] = $this->User_model->getAllUser();

    $this->template->load('layout/static', 'admin/user', $data);
  }

  function insertuser() {
    if(!isset($_POST['submit'])) {
      $data['title'] = 'Data User';
      $data['breadcrumb'] = '<li> <a href = "'. base_url('admin/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li><a href="'.base_url('admin/user').'"><i></i> User</a></li><li><i class="active"></i> Tambah User</li>';

      $this->template->load('layout/static', 'admin/insertuser', $data);
    } else {

      $this->form_validation->set_rules('nip', 'Nomor Induk Pegawai', 'required|exact_length[18]',
                                  array('required'  => 'Nomor Induk Pegawai Harus di Isi',
                                        'exact_length' => 'Nomor Induk Pegawai Salah'));
      $this->form_validation->set_rules('username_pegawai', 'Username Pegawai', 'required|is_unique[tbl_user.username_pegawai]',
                                  array('required'  => 'Username Harus di Isi',
                                        'is_unique' => 'Ooppss! Username Telah Digunakan. Gunakan Username lain'));
      $this->form_validation->set_rules('password_pegawai', 'Password Username', 'required',
                                  array('required'  => 'Password Harus di Isi'));
      $this->form_validation->set_rules('jenis_user', 'Jenis User', 'required',
                                  array('required'  => 'Jenis User Harus di Isi'));

      if($this->form_validation->run() === FALSE) {
        $data['title'] = 'Data User';
        $data['breadcrumb'] = '<li> <a href = "'. base_url('admin/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li><a href="'.base_url('admin/user').'"><i></i> User</a></li><li><i class="active"></i> Tambah User</li>';

        $this->template->load('layout/static', 'admin/insertuser', $data);
      } else {
        $data = array('nip'              => $this->input->post('nip'),
                      'username_pegawai' => $this->input->post('username_pegawai'),
                      'password_pegawai' => $this->input->post('password_pegawai'),
                      'jenis_user'       => $this->input->post('jenis_user'));

        $this->User_model->insertuser($data);

        $this->session->set_flashdata('sukses', 'Yeesss! User Login Berhasil di Tambahkan');
        redirect(base_url('admin/user'));
      }

    }

  }

  function updateUser($id_user, $nip) {
    $data['user'] = $this->User_model->getDetailUser($id_user, $nip);

    if(!isset($_POST['submit'])) {
      $data['title'] = 'Data User';
      $data['breadcrumb'] = '<li> <a href = "'. base_url('admin/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li><a href="'.base_url('admin/user').'"><i></i> User</a></li><li><i class="active"></i> Edit User</li>';

      $this->template->load('layout/static', 'admin/updateuser', $data);
    } else {

      if($data['user']->username_pegawai != $this->input->post('username_pegawai')) {
        $this->form_validation->set_rules('username_pegawai', 'Username Pegawai', 'required|is_unique[tbl_user.username_pegawai]',
                                    array('required'  => 'Username Harus di Isi',
                                          'is_unique' => 'Ooppss! Username Telah Digunakan. Gunakan Username lain'));
      }

      $this->form_validation->set_rules('nip', 'Nomor Induk Pegawai', 'required|exact_length[18]',
                                  array('required'  => 'Nomor Induk Pegawai Harus di Isi',
                                        'exact_length' => 'Nomor Induk Pegawai Salah'));

      $this->form_validation->set_rules('jenis_user', 'Jenis User', 'required',
                                  array('required'  => 'Jenis User Harus di Isi'));

      if($this->form_validation->run() === FALSE) {
        $data['title'] = 'Data User';
        $data['breadcrumb'] = '<li> <a href = "'. base_url('admin/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li><a href="'.base_url('admin/user').'"><i></i> User</a></li><li><i class="active"></i> Edit User</li>';

        $this->template->load('layout/static', 'admin/updateuser', $data);
      } else {
        if($this->input->post('password_pegawai') != "") {
          $data = array('nip'              => $this->input->post('nip'),
                        'username_pegawai' => $this->input->post('username_pegawai'),
                        'password_pegawai' => $this->input->post('password_pegawai'),
                        'jenis_user'       => $this->input->post('jenis_user'));

          $this->User_model->updatelogin($id_user, $data);

        } else {
          $data = array('nip'              => $this->input->post('nip'),
                        'username_pegawai' => $this->input->post('username_pegawai'),
                        'jenis_user'       => $this->input->post('jenis_user'));

          $this->User_model->updatelogin($id_user, $data);
        }

        $this->session->set_flashdata('sukses', 'Yeesss! User Login Berhasil di Update');
        redirect(base_url('admin/user'));

      }
    }
  }

  function deleteuser($id_user) {
    $result = $this->User_model->deleteUser($id_user);
    $this->session->set_flashdata('sukses', 'Yeesss! User Login Berhasil di Hapus');
    redirect(base_url('admin/user'));
  }
}
