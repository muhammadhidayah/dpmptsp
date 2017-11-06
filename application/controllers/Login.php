<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('User_model');
  }

  function index() {

    if ($this->session->userdata() !== NULL) {
			# code...
			switch ($this->session->userdata('jenis_user')) {
					case "Kepala Dinas":
						redirect(base_url('kepdinas/dashboard'));
						break;
					case "Admin":
						redirect(base_url('admin/dashboard'));
						break;
					case "Operator":
						redirect(base_url('operator/dashboard'));
						break;
					case "Editor":
						redirect(base_url('editor/dashboard'));
						break;
					case "Contributor":
						redirect(base_url('contributor/dashboard'));
						break;
				}

		}

    $data['title'] = 'Halaman Login DPMPTSPP';
  	$this->load->view('v_login', $data);


  }

  function auth() {
    //Validasi Form Login
    $this->form_validation->set_rules('username','username','required',
                            array('required' => 'Username Harus di Isi'));
    $this->form_validation->set_rules('password','password', 'required',
                            array('required' => 'Password Harus di Isi'));

    if($this->form_validation->run() === FALSE)  {
      $this->index();
    } else {
      $username = $this->input->post('username');
      $password = $this->input->post('password');

      $result   = $this->User_model->login($username, $password);

      if($result->num_rows() > 0) {
        $data = $result->row();

        //Update Last Login
        $last = $this->db->query('select now() as waktu')->row()->waktu;

        $dataupdate = array('last_login' => $last);
        $this->User_model->updatelogin($data->id_user, $dataupdate);

        $data_session = array('id_user'   => $data->id_user,
                              'username'  => $data->username_pegawai,
                              'nip'       => $data->nip,
                              'jenis_user'=> $data->jenis_user,
                              'logged_id' => TRUE );

        $this->session->set_userdata($data_session);
        $this->session->set_flashdata('sukses', 'Selamat Datang Kembali '.$data->username_pegawai.' :)');
        $user = $this->User_model->getPegawaiByNip($data->nip);

        switch ($data->jenis_user) {
          case "Kepala Dinas":
            $this->session->set_userdata(array( 'nama_pegawai' => $user->nama_pegawai,
                                                'foto_pegawai' => $user->foto_pegawai));
            redirect(base_url('kepdinas/dashboard'));
            break;
          case "Admin":
            $this->session->set_userdata(array( 'nama_pegawai' => $user->nama_pegawai,
                                                'foto_pegawai' => $user->foto_pegawai));
            redirect(base_url('admin/dashboard'));
            break;

          case "Operator":
            # code...
            $this->session->set_userdata(array( 'nama_pegawai' => $user->nama_pegawai,
                                                'foto_pegawai' => $user->foto_pegawai));
            redirect(base_url('operator/dashboard'));
            break;

          case "Editor":
            # code...
            $this->session->set_userdata(array( 'nama_pegawai' => $user->nama_pegawai,
                                                'foto_pegawai' => $user->foto_pegawai));
            redirect(base_url('editor/dashboard'));
            break;

          case "Contributor":
            $this->session->set_userdata(array( 'nama_pegawai' => $user->nama_pegawai,
                                                'foto_pegawai' => $user->foto_pegawai));
            redirect(base_url('contributor/dashboard'));
            break;
        }

      } else {
        $this->session->set_flashdata('msg', 'Username dan Password Salah');
        redirect(base_url('login'));
      }
    }
  }

  function logout() {
    $this->session->sess_destroy();
    $this->session->set_flashdata('msg', 'Anda Berhasil LogOut');
    redirect(base_url('login'));
  }

}
