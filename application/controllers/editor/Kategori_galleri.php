<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_galleri extends CI_Controller {

	function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') != TRUE &&
			$this->session->userdata('jenis_user') != "Editor") {
			$this->session->set_flashdata('msg', 'Ooopppss... Anda Harus Login Sebagai <br />Editor Terlebih Dahulu');
			redirect(base_url('login'));
		}

		$this->load->model('Galeri_model');
		$this->load->model('Kategori_model');
	}

	public function index() {
		$data['title'] 		= 'Kategory Galeri';
		$data['galeri'] 	= $this->Kategori_model->getAllKategori();
		$data['breadcrumb'] = '<li><a href="'.base_url('editor/dashboard').'"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Category Gallery</li>';
        $this->template->load('layout/static','editor/kategorigaleri',$data);
	}

	public function editstatuskatgaleri($id_kategori_galleri, $status_category_gallery) {
		if($status_category_gallery == 'unpublish') {
			$data = array(	'id_kategori_galleri'		=> $id_kategori_galleri,
							'status_katgaleri'	=> 'publish'
					);

			$this->Kategori_model->updatekategori($id_kategori_galleri, $data);
			$this->session->set_flashdata('sukses', 'Kategori Berhasil di Publish.');
			redirect('editor/kategori_galleri');
		} else {
			$data = array(	'id_kategori_galleri'	=> $id_kategori_galleri,
							        'status_katgaleri'	  => 'unpublish'
					          );

			$this->Kategori_model->updatekategori($id_kategori_galleri, $data);
			$this->session->set_flashdata('sukses', 'Kategori Berhasil di Unpublish.');
			redirect('editor/kategori_galleri');
		}
	}

  function deletekategori($id_kategori_galleri) {

    $result = $this->Kategori_model->deletekategori($id_kategori_galleri);

    if($result == TRUE) {
      $this->session->set_flashdata('sukses', 'Kategori Berhasil di Hapus');
    } else {
      $this->session->set_flashdata('gagal', 'Kategori Tidak di Temukan');
    }

    redirect(base_url('editor/kategori_galleri'));

  }



}

/* End of file Kategori_galleri.php */
/* Location: ./application/controllers/editor/Kategori_galleri.php */
