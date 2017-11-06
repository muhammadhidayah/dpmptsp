<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

  public function getPegawaiByNip($nip) {
    $this->db->select('*');
    $this->db->from('tbl_pegawai');
    $this->db->where('nip', $nip);

    return $this->db->get()->row();
  }

  public function getDetailUser($id_user,$nip) {
    $this->db->select('id_user,nip, username_pegawai, jenis_user');
    $this->db->from('tbl_user');
    $this->db->where('id_user', $id_user);
    $this->db->where('nip', $nip);

    $result = $this->db->get();

    return $result->row();
  }

  public function login($username, $password) {
    $this->db->select('*');
    $this->db->from('tbl_user');
    $this->db->where('username_pegawai', $username);
    $this->db->where('password_pegawai', $password);

    return $this->db->get();
  }

  public function updatelogin($id_user, $data) {
    $this->db->where('id_user', $id_user);
    $this->db->update('tbl_user', $data);
  }

  public function getAllUser() {
    $this->db->select('*');
    $this->db->from('tbl_user');

    $result = $this->db->get();

    return $result->result();
  }

  public function insertUser($data) {
    $this->db->insert('tbl_user', $data);
  }

  public function deleteUser($id_user) {
    $this->db->where('id_user', $id_user);
    $this->db->delete('tbl_user');

    if($this->db->affected_rows() > 0)
      return true;
    else
      return false;
  }

}
