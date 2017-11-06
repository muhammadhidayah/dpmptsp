<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller{

  public function __construct() {
    parent::__construct();
    //Codeigniter : Write Less Do More
    if($this->session->userdata('jenis_user') != "Operator"
      && $this->session->userdata('logged_id') != TRUE) {
      $this->session->set_flashdata('msg', 'Oppss! Anda harus LogIn sebagai Operator');

      redirect(base_url('login'));
    }

    $this->load->model('Perizinan_model');

  }

  function index() {
    $nip = $this->session->userdata('nip');
    $data['title'] = "Dashboard Operator";
    $data['breadcrumb'] = '<li> <a href = "'. base_url('operator/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li>';
    $data['bulan'] = $this->Perizinan_model->getAllPerizinanByNipMonth($nip);
    $data['hari'] = $this->Perizinan_model->getAllPerizinanByNipDay($nip);

    $this->template->load('layout/static','operator/content', $data);
  }

}
