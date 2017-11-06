<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard extends CI_Controller{

  public function __construct() {
    parent::__construct();
    if ($this->session->userdata('jenis_user') != "Contributor") {
      $this->session->set_flashdata('msg', 'Oppss! Anda harus LogIn sebgaia Contributor');
      redirect(base_url('login'));
    }
  }

  function index() {
    $data['title'] = 'Dashboard Contributor';
    $data['breadcrumb'] = '<li> <a href = "'. base_url('contributor/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li>';
    $this->template->load('layout/static', 'contributor/content', $data);
  }

}
