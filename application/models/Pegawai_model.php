<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai_model extends CI_Model{

  public function __construct() {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function getAllPegawai() {
    $this->db->select('*');
    $this->db->from('tbl_pegawai');
    $this->db->join('tbl_jabatan', 'tbl_jabatan.id_jabatan = tbl_pegawai.id_jabatan', 'LEFT');

    $result = $this->db->get();

    return $result->result();
  }

  public function getDetailPegawai($nip) {
    $this->db->select('*');
    $this->db->from('tbl_pegawai');
    $this->db->where('nip', $nip);

    $result = $this->db->get();

    return $result->row();
  }

  public function searchPegawai($nip) {
    $this->db->select('*');
    $this->db->from('tbl_pegawai');
    $this->db->like('nip', $nip);

    $result = $this->db->get();

    return $result->result();

  }

  public function insertPegawai($data) {
    $this->db->insert('tbl_pegawai', $data);

    if($this->db->affected_rows() > 0)
      return true;
    else
      return false;
  }

  public function updatePegawai($nip, $data) {
    $this->db->where('nip', $nip);
    $this->db->update('tbl_pegawai', $data);

    if($this->db->affected_rows() > 0)
      return true;
    else
      return false;
  }

  public function deletePegawai($nip) {
    $this->db->where('nip', $nip);
    $this->db->delete('tbl_pegawai');

    if($this->db->affected_rows() > 0)
      return true;
    else
      return false;
  }

}
