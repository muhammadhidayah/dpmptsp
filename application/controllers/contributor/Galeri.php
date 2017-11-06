<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galeri extends CI_Controller{

  public function __construct() {
    parent::__construct();
    if ($this->session->userdata('jenis_user') != "Contributor") {
      $this->session->set_flashdata('msg', 'Oppss! Anda harus LogIn sebgaia Contributor');
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
      $data['breadcrumb'] = '<li><a href="'.base_url('contributor/dashboard').'"><i class="fa fa-dashboard"></i> Home</a></li>
	        <li class="active">Galeri</li>';
      $data['galeri'] = $result;
      $this->template->load('layout/static', 'contributor/viewgaleri', $data);
    } else {
      echo "Oopsss!!! Kategori Tidak di Temukan";
    }
  }

  function tambahgaleri($id_kategori_galleri) {
    if(!isset($_POST['submit'])) {

      $data['title'] = "Tambah Foto";
      $data['breadcrumb'] = '<li><a href="'.base_url('contributor/dashboard').'"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Galeri</li><li class="active">Tambah Foto</li>';
      $this->template->load('layout/static', 'contributor/insertgaleri', $data);

    } else {

      $this->form_validation->set_rules('judul_galeri','judul_galeri','required',
										array('required' => 'Judul Foto Harus Di Isi')
											);

			//
			if($this->form_validation->run() === FALSE) {
        $data['title'] = "Tambah Foto";
        $data['breadcrumb'] = '<li><a href="'.base_url('contributor/dashboard').'"><i class="fa fa-dashboard"></i> Home</a></li>
          <li>Galeri</li><li class="active">Tambah Foto</li>';
        $this->template->load('layout/static', 'contributor/insertgaleri', $data);
			} else {

				//CONFIG UNTUK UPLOAD FOTO
				$config['upload_path'] 		= './assets/upload/galeri'; // LOKASI DARI FOLDER UNTUK PENYIPAN
				$config['allowed_types']	= 'jpg|jpeg|png|svg'; //TYPE FILE YANG DIPERBOLEHKAN
				$config['max_size']			= '12000'; //Ukuran Maximal dari upload file KB

				//PROSES UPLOAD KE SERVER
				$this->load->library('upload',$config);

				//PERCABANGAN KETIKA PROSES UPLOAD FOTO GAGAL KARENA FAKTOR TERTENTU
				if(!$this->upload->do_upload('gambar')) {
					$data['errors'] = $this->upload->display_errors();
					$data['title'] = 'Tambah Foto';
					$data['breadcrumb'] = '<li><a href="'.base_url('contributor/dashboard').'"><i class="fa fa-dashboard"></i> Home</a></li> <li>Gallery</li><li class="active">Tambah Foto</li>';
					$this->template->load('layout/static','contributor/galeri/insertgaleri',$data);
				} else {
					$upload_data = array('uploads' => $this->upload->data());

					//PROSES UNTUK MEMBUAT THUMBNAIL DARI FOTO
					//CONFIGURASI UNTUK THUMBNAIL
					$config['image_library'] 	= 'gd2';
					$config['source_image'] 	= './assets/upload/galeri/'.$upload_data['uploads']['file_name'];
					$config['new_image']		= './assets/upload/galeri/thumbs/';
					$config['create_thumb']		= TRUE;
					$config['quality']			= '100%';
					$config['maintain_ratio']	= FALSE;
					$config['width']			= 150;
					$config['height']			= 70;
					$config['x_axis']			= 0;
					$config['y_axis']			= 0;
					$config['thumb_marker']		= '';

					//PROSES UNTUK MEMBUAT THUMBNAIL SESUAI DARI CONFIG
					$this->load->library('image_lib',$config);
					$this->image_lib->resize();

					//PROSES MASUK KEDATABASE
					$data = array(	'id_kategori_galleri' => $id_kategori_galleri,
                          'judul_galeri'        => $this->input->post('judul_galeri'),
                          'keterangan_galeri'    => $this->input->post('keteranga_galeri'),
                          'tgl_post_galeri'     => $this->db->select('now() as now')->get()->row()->now,
        									'gambar'				      => $upload_data['uploads']['file_name']

							);

					$this->Galeri_model->insertgaleri($data);
					$this->session->set_flashdata('sukses', 'Foto telah berhasil ditambahkan!');
					redirect(base_url('contributor/galeri/viewgaleri/'.$id_kategori_galleri));


				}

			}
    }
  }

  function deletegaleri($id_kategori_galleri,$id_galeri) {
    $galeri  = $this->Galeri_model->getgaleribyid($id_galeri);

    unlink('./assets/upload/galeri/thumbs/'.$galeri->gambar);
    unlink('./assets/upload/galeri/'.$galeri->gambar);

    $this->Galeri_model->deletegaleri($id_galeri);
    $this->session->set_flashdata('sukses', 'Foto Berhasil di Hapus');
    redirect(base_url('contributor/galeri/viewgaleri/'.$id_kategori_galleri));

  }


}
