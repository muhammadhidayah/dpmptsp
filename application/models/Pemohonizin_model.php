<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemohonizin_model extends CI_Model{

  public function __construct() {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function getAllPemohonIzin() {
    $this->db->select('*');
    $this->db->from('tbl_pemohon_izin');

    $result = $this->db->get();

    return $result->result();
  }

  public function searchPemohonIzin($nik) {
    $this->db->select('*');
    $this->db->from('tbl_pemohon_izin');
    $this->db->like('nik_pemohon_izin', $nik);

    $result = $this->db->get();
    if(count($result) > 0){
      return $result->result();
    } else {
      return "No Result";
    }
  }

  public function getDetailPemohonIzin($nik) {
    $this->db->select('*');
    $this->db->from('tbl_pemohon_izin');
    $this->db->where('nik_pemohon_izin', $nik);

    $result = $this->db->get();

    return $result->row();
  }

  public function insertPemohonIzin($data) {
    $this->db->insert('tbl_pemohon_izin', $data);
  }

  public function updatePemohonIzin($nik, $data) {
    $this->db->where('nik_pemohon_izin', $nik);
    $this->db->update('tbl_pemohon_izin', $data);

    if($this->db->affected_rows() > 0)
      return true;
    else
      return false;
  }

  public function deletePemohonIzin($nik) {
    $this->db->where('nik_pemohon_izin', $nik);
    $this->db->delete('tbl_pemohon_izin');

    if($this->db->affected_rows() > 0)
      return true;
    else
      return false;
  }

  public function getPemohonByStatus($status_perizinan) {

    $this->db->select('tpm.*');
    $this->db->from('tbl_pemohon_izin tpm');
    $this->db->join('tbl_perizinan tp', 'tpm.nik_pemohon_izin = tp.nik_pemohon_izin');
    $this->db->where('tp.status_perizinan', $status_perizinan);

    $result = $this->db->get();

    return $result->result();

  }

}
