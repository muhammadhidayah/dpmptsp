<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informasi extends CI_Controller{

  public function __construct() {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('Informasi_model');
  }

  function index() {

  }

  function berita() {
    $berita = $this->Informasi_model->getInformasiPublish("berita");

    $data = array('berita' => $berita);

    $this->template->load('portal/static', 'portal/informasi', $data);
  }

  function read($slug) {
    $informasi = $this->Informasi_model->getInformasiBySlug($slug);

    $data = array('title' => $informasi->judul_informasi,
                  'deskripsi' => $informasi->deskripsi_informasi,
                  'informasi' => $informasi);

    $this->template->load('portal/static', 'portal/viewinformasi', $data);
  }

}
