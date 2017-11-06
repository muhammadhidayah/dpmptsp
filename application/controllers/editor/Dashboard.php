<?php
defined('BASEPATH') or exit('No direct script access allowed');

class dashboard extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('jenis_user') != "Editor") {
            $this->session->set_flashdata('msg', 'Oppss! Anda harus LogIn sebgaia Editor');
            redirect(base_url('login'));
        }

    }

    public function index() {
        $this->load->model('Informasi_model');
        $this->load->model('Kategori_model');
        $this->load->model('Galeri_model');

        $data['title'] = 'Dashboard Contributor';
        $data['breadcrumb'] = '<li> <a href = "'. base_url('editor/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li>';
        $data['jumlah_artikel'] = count($this->Informasi_model->getInformasiByJenis('artikel'));
        $data['jumlah_berita'] = count($this->Informasi_model->getInformasiByJenis('berita'));
        $data['jumlah_kategori'] = count($this->Kategori_model->getAllKategori());
        $data['informasi'] = $this->Informasi_model->getallinformasi();
        $this->template->load('layout/static', 'editor/content', $data);
    }


}
