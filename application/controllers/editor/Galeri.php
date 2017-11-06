<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galeri extends CI_Controller{

  public function __construct() {
    parent::__construct();
    if ($this->session->userdata('jenis_user') != "Editor") {
        $this->session->set_flashdata('msg', 'Oppss! Anda harus LogIn sebgaia Editor');
        redirect(base_url('login'));
    }
    $this->load->model('Galeri_model');
  }

  function index() {

    redirect(base_url('kategori_galleri'));

  }

  function viewgaleri($id_kategori_galleri) {
    //Cek Untuk Mengetahui Apakah Kategori Tersebut Ada di Database
    //Atau Tidak
    $this->load->model('Kategori_model');
    $cek = $this->Kategori_model->getKategoriById($id_kategori_galleri);

    if(count($cek) > 0) {
      $result = $this->Galeri_model->viewGaleriByKategori($id_kategori_galleri);

      $data['title'] = $result[0]->kategori_galleri;
      $data['breadcrumb'] = '<li><a href="'.base_url('editor/dashboard').'"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Galeri</li>';
      $data['galeri'] = $result;

      $this->template->load('layout/static', 'editor/viewgaleri', $data);
    } else {

      echo "Oopsss!!! Kategori Tidak di Temukan";

    }
  }

  function deletegaleri($id_kategori_galleri,$id_galeri) {
    $galeri  = $this->Galeri_model->getgaleribyid($id_galeri);

    unlink('./assets/upload/galeri/thumbs/'.$galeri->gambar);
    unlink('./assets/upload/galeri/'.$galeri->gambar);

    $this->Galeri_model->deletegaleri($id_galeri);
    $this->session->set_flashdata('sukses', 'Foto Berhasil di Hapus');
    redirect(base_url('editor/galeri/viewgaleri/'.$id_kategori_galleri));

  }

}
