<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Izin extends CI_Controller{

  public function __construct() {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('Perizinan_model');
  }

  function index()
  {

  }

  function cek_izin() {
    if(!isset($_POST['submit'])) {
      $data = array('deskripsi' => 'Lacak Perizinan Pada DPMPTSP Kabupaten Belitung','perizinan' => '');

      $this->template->load('portal/static', 'portal/cekizin', $data);
    } else {
      $data = array('perizinan' => $this->Perizinan_model->getDetailPerizinan($id_perizinan),
                    'deskripsi' => 'Lacak Perizinan Pada DPMPTSP Kabupaten Belitung');

      $this->template->load('portal/static', 'portal/cekizin', $data);
    }
  }

}
