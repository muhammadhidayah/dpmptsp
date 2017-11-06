<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class konfigurasi extends CI_Controller{

  public function __construct() {
    //Codeigniter : Write Less Do More
    parent::__construct();
		if($this->session->userdata('logged_id') != TRUE
			&& $this->session->userdata('jenis_user') != "Admin") {
			$this->session->set_flashdata('msg', 'Ooopppss... Anda Harus Login Sebagai <br />Admin Terlebih Dahulu');

			redirect(base_url('login'));
		}

    $this->load->model('Konfigurasi_model');
  }

  function index() {
    $data['title'] 		= 'Konfigurasi Umum';
		$data['breadcrumb'] = '<li> <a href = "'. base_url('admin/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li><i class="active"></i> Konfigurasi</li>';
		$data['konfigurasi']= $this->Konfigurasi_model->getKonfigurasi();

		$this->template->load('layout/static', 'admin/konfigurasi', $data);
  }

  public function simpankonfigurasiumum() {
		$this->form_validation->set_rules('nama_kantor', 'Nama Organisasi', 'required',
			array('required' => 'Nama Organisasi Tidak Boleh di Kosongkan'));

		if($this->form_validation->run() === FALSE) {
      $data['title'] 		= 'Konfigurasi Umum';
  		$data['breadcrumb'] = '<li> <a href = "'. base_url('admin/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li><i class="active"></i> Konfigurasi</li>';
  		$data['konfigurasi']= $this->Konfigurasi_model->getKonfigurasi();

  		$this->template->load('layout/static', 'admin/konfigurasi', $data);
		} else {
			$data = array('nama_kantor'		   => $this->input->post('nama_kantor'),
						        'tagline_kantor'	 => $this->input->post('tagline_kantor'),
						        'urlweb_kantor'		 => $this->input->post('urlweb_kantor'),
						        'email_kantor'		 => $this->input->post('email_kantor'),
						        'telp_kantor'			 => $this->input->post('telp_kantor'),
						        'alamat_kantor'    => $this->input->post('alamat_kantor'),
						        'keyword_web'			 => $this->input->post('keyword_web'),
						        'deskripsi_web'		 => $this->input->post('deskripsi_web'),
						        'koordinat_kantor' => $this->input->post('koordinat_kantor'),
						        'metatext_web'		 => $this->input->post('metatext_web')
				);
			$this->Konfigurasi_model->updateKonfigurasi($data);
			$this->session->set_flashdata('sukses', 'Konfigurasi web berhasil di simpan');
			redirect(base_url('admin/konfigurasi'));
		}
	}

  public function logo() {
		$data['konfigurasi'] = $this->Konfigurasi_model->getKonfigurasi();

		if(!isset($_POST['submit'])) {
			$data['title'] 		= 'Ganti Logo';
			$data['breadcrumb'] = '<li> <a href = "'. base_url('admin/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li><a href="'.base_url('admin/konfigurasi').'"><i></i> Konfigurasi</li><li><i class="active"></i> Logo</li>';

			$this->template->load('layout/static', 'admin/konfiglogo', $data);
		} else {

			$config['upload_path'] 		= './assets/img';
			$config['allowed_types'] 	= 'jpg|png|jpeg';
			$config['max_size']  		= '12000';
			$config['max_width']  		= '1024';
			$config['max_height']  		= '768';

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('logo')){
				$data['error'] 		= $this->upload->display_errors();
				$data['title'] 		= 'Ganti Logo';
				$data['breadcrumb'] = '<li> <a href = "'. base_url('admin/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li><a href="'.base_url('admin/konfigurasi').'"><i></i> Konfigurasi</li><li><i class="active"></i> Logo</li>';

				$this->template->load('layout/static', 'admin/konfiglogo', $data);
			}
			else{
				$upload_data = array('uploads' => $this->upload->data());

				// Image Editor
				$config['image_library']	= 'gd2';
				$config['source_image'] 	= './assets/img/'.$upload_data['uploads']['file_name'];
				$config['new_image'] 		= './assets/img/thumbs/';




    		$config['create_thumb'] 	= TRUE;
				$config['quality'] 			= "100%";
				$config['maintain_ratio'] 	= FALSE;
				$config['width'] 			= 360; // Pixel
				$config['height'] 			= 200; // Pixel
				$config['x_axis'] 			= 0;
				$config['y_axis'] 			= 0;
				$config['thumb_marker'] 	= '';
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				$datamasuk = array('logo_web'				=> $upload_data['uploads']['file_name']);

				$this->Konfigurasi_model->updateKonfigurasi($datamasuk);
				$this->session->set_flashdata('sukses', 'Logo berhasil di perbarui');

				redirect(base_url('admin/konfigurasi/logo'));
			}
		}
	}

  public function icon() {
    $data['konfigurasi'] = $this->Konfigurasi_model->getKonfigurasi();

		if(!isset($_POST['submit'])) {
			$data['title'] 		= 'Ganti Icon';
			$data['breadcrumb'] = '<li> <a href = "'. base_url('admin/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li><a href="'.base_url('admin/konfigurasi').'"><i></i> Konfigurasi</li><li><i class="active"></i> Icon</li>';

			$this->template->load('layout/static', 'admin/konficon', $data);
		} else {

			$config['upload_path'] 		= './assets/img';
			$config['allowed_types'] 	= 'jpg|png|jpeg';
			$config['max_size']  		= '12000';
			$config['max_width']  		= '1024';
			$config['max_height']  		= '768';

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('icon')){
				$data['error'] 		= $this->upload->display_errors();
				$data['title'] 		= 'Ganti Icon';
				$data['breadcrumb'] = '<li> <a href = "'. base_url('admin/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li><a href="'.base_url('admin/konfigurasi').'"><i></i> Konfigurasi</li><li><i class="active"></i> Icon</li>';

				$this->template->load('layout/static', 'admin/konficon', $data);
			}
			else{
				$upload_data = array('uploads' => $this->upload->data());
				// Image Editor
				$config['image_library']	= 'gd2';
				$config['source_image'] 	= './assets/img/'.$upload_data['uploads']['file_name'];
				$config['new_image'] 		= './assets/img/thumbs/';
				$config['create_thumb'] 	= TRUE;
				$config['quality'] 			= "100%";
				$config['maintain_ratio'] 	= FALSE;
				$config['width'] 			= 360; // Pixel
				$config['height'] 			= 200; // Pixel
				$config['x_axis'] 			= 0;
				$config['y_axis'] 			= 0;
				$config['thumb_marker'] 	= '';
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				$datamasuk = array('icon_web'			=> $upload_data['uploads']['file_name']);

				$this->Konfigurasi_model->updateKonfigurasi($datamasuk);
				$this->session->set_flashdata('sukses', 'Icon berhasil di perbarui');

				$this->session->set_flashdata('sukses', 'Icon Berhasil di Ganti!');
        redirect(base_url('admin/konfigurasi/icon'));
			}
		}
  }

}
