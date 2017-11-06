<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_id') != TRUE
			&& $this->session->userdata('jenis_user') != "Admin") {
			$this->session->set_flashdata('msg', 'Ooopppss... Anda Harus Login Sebagai <br />Admin Terlebih Dahulu');

			redirect(base_url('login'));
		}
	}

	public function index() {
		$data['title'] 		= 'Dashboard Admin';
		$data['breadcrumb'] = '<li> <a href = "'. base_url('admin/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li>';

		$this->template->load('layout/static', 'admin/dashboard', $data);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/admin/Dashboard.php */
