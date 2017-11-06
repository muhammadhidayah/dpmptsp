<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{

  public function __construct() {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index() {
    $konfigurasi = $this->Konfigurasi_model->getKonfigurasi();
    $this->load->model('Informasi_model');
    $data = array('title'     => 'Portal Website',
                  'deskripsi' => $konfigurasi->deskripsi_web,
                  'berita'    => $this->Informasi_model->getInformasiPublish("berita"),
                  'artikel'   => $this->Informasi_model->getInformasiPublish("artikel"));
    $this->template->load('portal/static', 'portal/home', $data);
  }

}
