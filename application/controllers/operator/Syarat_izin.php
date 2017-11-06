<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class syarat_izin extends CI_Controller{

  public function __construct() {
    parent::__construct();
    if($this->session->userdata('jenis_user') != "Operator"
      && $this->session->userdata('logged_id') != TRUE) {
      $this->session->set_flashdata('msg', 'Oppss! Anda harus LogIn sebagai Operator');

      redirect(base_url('login'));
    }

    $this->load->model('Syarat_model');
  }

  function index() {
    $data['title'] = 'Syarat Izin';
    $data['breadcrumb'] = '<li> <a href = "'. base_url('operator/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Master Syarat</li>';
    $data['syarat'] = $this->Syarat_model->getAllSyarat();
    $this->template->load('layout/static', 'operator/syarat', $data);
  }

  function searchsyarat() {
    $nama_syarat = $_GET['term'];
    $izin = $this->Syarat_model->searchsyarat($nama_syarat);
    $data = array();
    foreach ($izin as $izin) {
      # code...
      $data[] = array('key' => $izin->id_syarat, 'value' => $izin->nama_syarat);
    }
    echo json_encode($data);

  }

  function insertsyarat() {
    if(!isset($_POST['submit'])) {
      $data['title'] = 'Syarat';
      $data['breadcrumb'] = '<li> <a href = "'. base_url('operator/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li><a href = "'. base_url('operator/syarat_izin') .'"> Master Syarat</a></li><li class="active">Tambah Syarat</li>';
      $this->template->load('layout/static', 'operator/insertsyarat', $data);
    }
  }

  function tambahsyarat() {
    $number = count($_POST["syarat"]);

    if($number > 0) {

      for($i = 0; $i < $number; $i++) {
        if(trim($_POST['syarat'][$i]) != '') {
          $pesan['sukses'] = TRUE;
          $this->form_validation->set_rules('syarat['.$i.']', 'Syarat', 'is_unique[tbl_master_syarat.nama_syarat]', array('is_unique' => 'Syarat '.$_POST['syarat'][$i].' sudah ada'));

          if($this->form_validation->run() === FALSE) {
             $pesan['errors'] = validation_errors();
          } else {
            $data = array('nama_syarat' => $_POST['syarat'][$i],
                          'keterangan_syarat' => $_POST['ketsyarat'][$i],
                          'tanggal_dibuat_syarat' => $this->db->select('CURDATE() as tanggal')->get()->row()->tanggal
                  );
            $this->Syarat_model->insertsyarat($data);

          }
          // if(count($pesan['errors']) > 0) {
          //   echo json_encode($pesan['errors']);
          // } else {
          //   echo json_encode($pesan['sukses']);
          // }
          echo json_encode($pesan);
        }
      }

      // if(count($pesan['error']) > 0){
      //   echo json_encode($pesan['error']);
      // } else {
      //   echo json_encode($pesan['sukses']);
      // }

    } else {

    }
  }

  function deletesyarat($id_syarat) {
    $this->Syarat_model->deletesyarat($id_syarat);
    $this->session->set_flashdata('sukses', 'Syarat Berhasil di Hapus');
    redirect(base_url('operator/syarat_izin'));
  }

}
