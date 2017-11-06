<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class galeri extends CI_Controller{

  public function __construct() {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('Kategori_model');
    $this->load->model('Galeri_model');
  }

  function index() {
    $data = array('galeri' => $this->Kategori_model->getAllKategoriPublish(),
                  'deskripsi' => '');

    $this->template->load('portal/static', 'portal/galeri', $data);
  }

  function view($slug_galeri) {
    $kategori = $this->Kategori_model->getKategoriBySlug($slug_galeri);
    $galeri = $this->Galeri_model->viewGaleriByKategori($kategori->id_kategori_galleri);

    $data = array('title'     => $kategori->kategori_galleri,
                  'deskripsi' => $kategori->keterangan_katgalleri,
                  'galeri'    => $galeri);

    $this->template->load('portal/static', 'portal/viewgaleri', $data);
  }

}
