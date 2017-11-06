<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perizinan extends CI_Controller{

  public function __construct() {
    parent::__construct();
    //Codeigniter : Write Less Do More
    if($this->session->userdata('logged_id') != TRUE
			&& $this->session->userdata('jenis_user') != "Kepala Dinas") {
			$this->session->set_flashdata('msg', 'Ooopppss... Anda Harus Login Sebagai <br />Kepala Dinas Terlebih Dahulu');

			redirect(base_url('login'));
		}
    $this->load->model('Perizinan_model');
  }

  function getPerizinanByYear() {
    $result = $this->Perizinan_model->getPerizinanByYear();

    $data = array();

    foreach ($result as $result) {
      $data[] = array($result->Bulan, $result->Jumlah_perizinan);
    }

    echo json_encode($data);
  }

  public function laporanperizinan() {
    $this->load->model('Izin_model');
    $data['title'] = 'Laporan Perizinan';
    $data['breadcrumb'] = $data['breadcrumb'] = '<li> <a href = "'. base_url('kepdinas/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li> <a href = "'. base_url('kepdinas/perizinan') .'">Perizinan</a></li><li class="active">Laporan Perizinan</li>';
    $data['izin'] = $this->Izin_model->getAllIzin();
    $this->template->load('layout/static', 'kepdinas/laporanperizinan', $data);
  }

  public function getLaporanIzin() {

    $tgl = $this->input->post('rangewaktu');
    // $data = array('id_izin' => $this->input->post('nama_izin'),
    //               'tgl_perizinan between' => date("Y-m-d",strtotime(substr($tgl,0,10))),'' => date("Y-m-d",strtotime(substr($tgl,13,23))));
    $data['id_izin'] = $this->input->post('nama_izin');
    $data['wkt_awal'] = date("Y-m-d",strtotime(substr($tgl,0,10)));
    $data['wkt_akhir'] = date("Y-m-d",strtotime(substr($tgl,13,23)));
    $data['sp'] = $this->input->post('status_perizinan');
    $result = $this->Perizinan_model->getLaporanPerizinan($data);

    echo json_encode($result);
  }

}
