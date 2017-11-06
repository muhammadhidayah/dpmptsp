<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informasi extends CI_Controller{

  public function __construct() {
    parent::__construct();
    if($this->session->userdata('jenis_user') != 'Contributor') {
      $this->session->set_flashdata('msg', 'Oppss! Anda harus LogIn sebgaia Contributor');
      redirect(base_url('login'));
    }
    $this->load->model('Informasi_model');
  }

  function index() {
    $data['title'] = 'Data Informasi';
		$data['informasi'] = $this->Informasi_model->getAllInformasi();
		$data['breadcrumb'] = '<li><a href="'.base_url('contributor/dashboard').'"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Informasi</li>';
		$this->template->load('layout/static', 'contributor/informasi', $data);
  }

  function viewInformasi($jenis_informasi) {
    $data['title'] = "Data Artikel";

    if($jenis_informasi == 'berita') {
      $data['title'] = 'Data Berita';
    }

    $data['breadcrumb'] = '<li><a href="'.base_url('contributor/dashboard').'"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Informasi</li>';
    $data['informasi'] = $this->Informasi_model->getInformasiByJenis($jenis_informasi);
    $this->template->load('layout/static', 'contributor/viewinformasi', $data);
  }

  function insertInformasi() {

    if(!isset($_POST['submit'])) {
      $data['title'] = "Tambah Informasi";
      $data['breadcrumb'] = '<li><a href="'.base_url('contributor/dashboard').'"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Informasi</li><li class="active">Tambah Informasi</li>';
      $this->template->load('layout/static', 'contributor/insertinformasi', $data);
    } else {

			$this->form_validation->set_rules(	'judul_informasi', 'Judul Informasi', 'required',
										array(
												'required' => 'Judul Informasi Harus Di Isi'
											));

			$this->form_validation->set_rules(	'deskripsi_informasi','Deskripsi Informasi','required',
										array(
												'required' => 'Deskripsi Informasi Harus Di Isi'
											));

			$this->form_validation->set_rules(	'isi_informasi', 'Isi Informasi', 'required',
										array(
												'required' => 'Isi Informasi Tidak Boleh Kosong'
											));

			if ($this->form_validation->run()) {
				//CONFIGURASI UPLOAD IMAGE
				$config['upload_path'] 		= './assets/upload/informasi';
				$config['allowed_types'] 	= 'jpg|png|svg';
				$config['max_size'] 		= '12000';

				$this->load->library('upload', $config);
				//PROSES UPLOAD IMAGE
				if(! $this->upload->do_upload('gambar')) {
					$data['errors'] = $this->upload->display_errors();
					$data['title'] = 'Tambah Informasi';
					$data['breadcrumb'] = '<li><a href="'.base_url('contributor/dashboard').'"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Informasi</li><li class="active">Tambah Informasi</li>';
					$this->template->load('layout/static', 'contributor/insertinformasi', $data);
				} else {

					//PROSES UNTUK MEMBUAT THUMBNAIL DARI FOTO YANG TELAH DIUPLOAD
					$upload_data				= array('uploads' =>$this->upload->data());
					// Image Editor
					$config['image_library']	= 'gd2';
					$config['source_image'] 	= './assets/upload/informasi/'.$upload_data['uploads']['file_name'];
					$config['new_image'] 		= './assets/upload/informasi/thumbs/';
					$config['create_thumb'] 	= TRUE;
					$config['quality'] 			= "100%";
					$config['maintain_ratio'] 	= FALSE;
					$config['width'] 			= 200; // Pixel
					$config['height'] 			= 100; // Pixel
					$config['x_axis'] 			= 0;
					$config['y_axis'] 			= 0;
					$config['thumb_marker'] 	= '';
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					//PROSES MASUK KEDATABASE
					$tanggal = $this->db->query('SELECT CURDATE()')->row();
					$slug = url_title($this->input->post('judul_informasi'), 'dash', TRUE);

					$data = array( 	'judul_informasi' 			=>	$this->input->post('judul_informasi'),
        									'deskripsi_informasi' 	=>	$this->input->post('deskripsi_informasi'),
        									'slug_informasi'			  =>	$slug,
        									'isi_informasi'			    =>	$this->input->post('isi_informasi'),
                          'gambar_informasi'			=>	$upload_data['uploads']['file_name'],
                          'status_informasi'			=> 	'unpublish',
                          'tanggal_post_informasi'=>	$this->db->select('CURDATE() as tanggal')->get()->row()->tanggal,
                          'jenis_informasi'       =>  $this->input->post('jenis_informasi'),
                          'nip'                   =>  $this->session->userdata('nip')

						);

					$this->Informasi_model->insertInformasi($data);

					$this->session->set_flashdata('sukses', 'Informasi berhasil ditambahkan.');
					redirect(base_url('contributor/informasi'));
				}

			}

    }

  }

  function updateInformasi($idInformasi) {
    $data['informasi'] = $this->Informasi_model->getInformasiById($idInformasi);
		if(!isset($_POST['submit'])) {
			$data['title'] = 'Edit Informasi';
			$data['breadcrumb'] = '<li><a href="'.base_url('contributor/dashboard').'"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Informasi</li><li class="active">Edit Informasi</li>';
			$this->template->load('layout/static', 'contributor/updateinformasi', $data);

		} else {
			$this->form_validation->set_rules(	'judul_informasi', 'Judul Informasi', 'required',
										array(
												'required' => 'Judul Informasi Harus Di Isi'
											));

			$this->form_validation->set_rules(	'deskripsi_informasi','Deskripsi Informasi','required',
										array(
												'required' => 'Deskripsi Informasi Harus Di Isi'
											));

			$this->form_validation->set_rules(	'isi_informasi', 'Isi Informasi', 'required',
										array(
												'required' => 'Isi Informasi Tidak Boleh Kosong'
											));

			if ($this->form_validation->run()) {
				if(!empty($_FILES['gambar']['name'])) {
					$config['upload_path'] 		= './assets/upload/informasi';
					$config['allowed_types'] 	= 'jpg|png|svg';
					$config['max_size'] 		= '12000';

					$this->load->library('upload', $config);
					//PROSES UPLOAD IMAGE
					if(! $this->upload->do_upload('gambar')) {
						$data['errors'] = $this->upload->display_errors();
						$data['title'] = 'Tambah Informasi';
						$data['breadcrumb'] = '<li><a href="'.base_url('contributor/dashboard').'"><i class="fa fa-dashboard"></i> Home</a></li>
	        <li>Informasi</li><li class="active">Tambah Informasi</li>';
						$this->template->load('layout/static', 'contributor/informasi/updateinformasi', $data);
					} else {

						//PROSES UNTUK MEMBUAT THUMBNAIL DARI FOTO YANG TELAH DIUPLOAD
						$upload_data				= array('uploads' =>$this->upload->data());
						// Image Editor
						$config['image_library']	= 'gd2';
						$config['source_image'] 	= './assets/upload/informasi/'.$upload_data['uploads']['file_name'];
						$config['new_image'] 		= './assets/upload/informasi/thumbs/';
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

            foreach ($data['informasi'] as $informasi) {
							if($informasi->gambar_informasi != "") {
  							unlink('./assets/upload/informasi/'.$informasi->gambar_informasi);
  							unlink('./assets/upload/informasi/thumbs/'.$informasi->gambar_informasi);
						  }
						}

						//PROSES MASUK KEDATABASE
						$data = array( 	'id_informasi'			    => 	$idInformasi,
                            'judul_informasi' 			=>	$this->input->post('judul_informasi'),
                          	'deskripsi_informasi' 	=>	$this->input->post('deskripsi_informasi'),
                          	'isi_informasi'			    =>	$this->input->post('isi_informasi'),
                            'gambar_informasi'			=>	$upload_data['uploads']['file_name'],
                            'status_informasi'			=> 	'unpublish',
                            'jenis_informasi'       =>  $this->input->post('jenis_informasi')

							);

						$this->Informasi_model->updateInformasi($idInformasi,$data);

						$this->session->set_flashdata('sukses', 'Informasi berhasil diupdate.');
						redirect(base_url('contributor/informasi'));
					}

				} else {
					$data = array( 	'id_informasi'			    => 	$idInformasi,
                          'judul_informasi' 			=>	$this->input->post('judul_informasi'),
                        	'deskripsi_informasi' 	=>	$this->input->post('deskripsi_informasi'),
                        	'isi_informasi'			    =>	$this->input->post('isi_informasi'),
                          'status_informasi'			=> 	'unpublish',
                          'jenis_informasi'       =>  $this->input->post('jenis_informasi')
							);

						$this->Informasi_model->updateInformasi($idInformasi,$data);

						$this->session->set_flashdata('sukses', 'Informasi berhasil diupdate.');
						redirect(base_url('contributor/informasi'));
				}
			}
		}
  }

  function deleteInformasi($idInformasi) {
    $data['informasi'] = $this->Informasi_model->getInformasiById($idInformasi);
		foreach ($data['informasi'] as $informasi) {
			# code...
			if($informasi->gambar_informasi != "") {
				unlink('./assets/upload/informasi/'.$informasi->gambar_informasi);
				unlink('./assets/upload/informasi/thumbs/'.$informasi->gambar_informasi);
			}
		}

		$this->Informasi_model->deleteInformasi($idInformasi);
		$this->session->set_flashdata('sukses','Informasi berhasil dihapus!');
		redirect(base_url('contributor/informasi'));
  }

}
