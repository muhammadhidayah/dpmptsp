<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_galleri extends CI_Controller{

  public function __construct() {
    parent::__construct();
    if ($this->session->userdata('jenis_user') != "Contributor") {
      $this->session->set_flashdata('msg', 'Oppss! Anda harus LogIn sebgaia Contributor');
      redirect(base_url('login'));
    }
    $this->load->model('Kategori_model');
  }

  function index() {
    $data['title'] 		= 'Kategori Galeri';
		$data['galeri'] 	= $this->Kategori_model->getAllKategori();
		$data['breadcrumb'] = '<li><a href="'.base_url('contributor/dashboard').'"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Category Gallery</li>';
    $this->template->load('layout/static','contributor/kategorigaleri',$data);
  }

  function insertkategori() {
    $this->form_validation->set_rules('kategori_galleri','kategori_galleri','required',
								array(	'required' 	=> 'Judul Harus di Isi')
			);

		$this->form_validation->set_rules('keterangan_katgalleri','keterangan_katgalleri','required',
								array('required' => 'Keterang harus di isi')
			);

		if($this->form_validation->run() === FALSE) {

      $data['title'] 		= 'Kategori Galeri';
			$data['galeri'] 	= $this->Kategori_model->getAllKategori();
			$data['breadcrumb'] = '<li><a href="'.base_url('contributor/dashboard').'"><i class="fa fa-dashboard"></i> Home</a></li>
	        <li class="active">Category Gallery</li>';
	    $this->template->load('layout/static','contributor/kategorigaleri',$data);

		} else {

			$slug = url_title($this->input->post('kategori_galleri'), 'dash', TRUE);
			$data = array( 	'kategori_galleri'		    =>	$this->input->post('kategori_galleri'),
        							'keterangan_katgalleri'	  =>	$this->input->post('keterangan_katgalleri'),
        							'slug_katgaleri'		      =>	$slug,
        							'status_katgaleri'	=> 	'unpublish'
				);

			$this->Kategori_model->insertkategori($data);
			$this->session->set_flashdata('sukses', 'Kategori berhasil ditambahkan');
			redirect(base_url('contributor/kategori_galleri'));
		}
  }

  function deletekategori($id_kategori_galleri) {

    $result = $this->Kategori_model->deletekategori($id_kategori_galleri);

    if($result == TRUE) {
      $this->session->set_flashdata('sukses', 'Kategori Berhasil di Hapus');
    } else {
      $this->session->set_flashdata('gagal', 'Kategori Tidak di Temukan');
    }

    redirect(base_url('contributor/kategori_galleri'));

  }

}
