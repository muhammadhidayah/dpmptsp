<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_id') != TRUE
			&& $this->session->userdata('jenis_user') != "Kepala Dinas") {
			$this->session->set_flashdata('msg', 'Ooopppss... Anda Harus Login Sebagai <br />Kepala Dinas Terlebih Dahulu');

			redirect(base_url('login'));
		}
	}

	public function index() {
    $this->load->model('Pegawai_model');
    $this->load->model('Izin_model');
    $this->load->model('Perizinan_model');

		$data['title'] 		= 'Dashboard Kepala Dinas';
		$data['breadcrumb'] = '<li> <a href = "'. base_url('kepdinas/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li>';
    $data['pegawai'] = $this->Pegawai_model->getAllPegawai();
    $data['izin'] = $this->Izin_model->getAllIzin();
    $data['perizinan']  = $this->Perizinan_model->getAllPerizinan();
    
		$this->template->load('layout/static', 'kepdinas/dashboard', $data);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/admin/Dashboard.php */
