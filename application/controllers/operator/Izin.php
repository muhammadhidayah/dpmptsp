<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Izin extends CI_Controller{

  public function __construct() {
    parent::__construct();
    //Codeigniter : Write Less Do More
    if($this->session->userdata('jenis_user') != 'Operator') {
      $this->session->set_flashdata('msg', 'Oppss! Anda harus LogIn sebagai Operator');
      redirect(base_url('login'));
    }

    $this->load->model('Izin_model');
  }

  function index() {

    $data['title'] = 'Data Izin';
    $data['breadcrumb'] = '<li> <a href = "'. base_url('operator/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Daftar Izin</li>';
    $data['izin'] = $this->Izin_model->getAllIzin();

    $this->template->load('layout/static', 'operator/izin', $data);

  }

  function insertizin()  {
    $data['title'] = 'Tambah Izin';
    $data['breadcrumb'] = '<li> <a href = "'. base_url('operator/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li><a href = "'. base_url('operator/izin') .'"> Daftar Izin</a></li><li class="active">Tambah Izin</li>';
    $this->template->load('layout/static', 'operator/insertizin', $data);
  }

  function insertizindb() {
    $this->form_validation->set_rules('nama_izin', 'Nama Izin', 'required|is_unique[tbl_izin.nama_izin]',
                                array('required'  => 'Nama Izin Harus di Isi',
                                      'is_unique' => 'Izin Sudah di Input'));
    $this->form_validation->set_rules('masa_berlaku_izin', 'Masa Berlaku Izin', 'required|numeric',
                                array('required' => 'Masa Berlaku Harus di Isi',
                                      'numeric'  => 'Mohon Masukkan Angka'));

    if($this->form_validation->run() === FALSE) {
      $msg['error'] = validation_errors();
      echo json_encode($msg);
    } else {

      $dataizin = array('nama_izin' => $this->input->post('nama_izin'), 'masa_berlaku_izin' => $this->input->post('masa_berlaku_izin'));

      $id_izin = $this->Izin_model->insertizin($dataizin);

      $jumlahsyarat = count($_POST['id_syarat']);

      if($jumlahsyarat > 0) {
          for($i = 0; $i < $jumlahsyarat; $i++) {
            if($_POST['id_syarat'][$i] != '') {
              $datadetail = array('id_izin'   => $id_izin,
                                  'id_syarat' => $_POST['id_syarat'][$i]);

              $this->Izin_model->insertdetailizin($datadetail);
            }
          }
      }

      $msg['success'] = false;

			if($id_izin != '') {
				$msg['success'] = true;
			}

			echo json_encode($msg);

    }
  }

}
