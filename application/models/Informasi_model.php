<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informasi_model extends CI_Model{

  public function getAllInformasi() {
    $this->db->select('nama_pegawai,tbl_informasi.*');
    $this->db->from('tbl_informasi');
    $this->db->join('tbl_pegawai', 'tbl_pegawai.nip = tbl_informasi.nip','LEFT');

    $result = $this->db->get()->result();

    return $result;
  }

  public function getInformasiById($idInformasi) {
    $this->db->select('nama_pegawai,tbl_informasi.*');
    $this->db->from('tbl_informasi');
    $this->db->join('tbl_pegawai', 'tbl_pegawai.nip = tbl_informasi.nip','LEFT');
    $this->db->where('id_informasi', $idInformasi);

    $result = $this->db->get();

    return $result->result();
  }

  public function getInformasiBySlug($slugInformasi) {
    $this->db->select('*');
    $this->db->from('tbl_informasi');
    $this->db->where('slug_informasi', $slugInformasi);

    $result = $this->db->get()->row();

    return $result;
  }

  public function getInformasiPublish($jenis_informasi) {
    $this->db->select('*');
    $this->db->from('tbl_informasi');
    $this->db->where('jenis_informasi', $jenis_informasi);
    $this->db->where('status_informasi', 'publish');

    $result = $this->db->get()->result();

    return $result;
  }

  public function getInformasiByJenis($jenis_informasi) {
    $this->db->select('*');
    $this->db->from('tbl_informasi');
    $this->db->where('jenis_informasi', $jenis_informasi);

    $result = $this->db->get()->result();

    return $result;
  }

  public function insertInformasi($data) {
    $this->db->insert('tbl_informasi', $data);
  }

  public function updateInformasi($idInformasi, $data) {
    $this->db->where('id_informasi', $idInformasi);
    $this->db->update('tbl_informasi', $data);

    if($this->db->affected_rows() > 0)
			return true;
		else
			return false;

  }

  public function deleteInformasi($idInformasi) {
    $this->db->where('id_informasi', $idInformasi);
    $this->db->delete('tbl_informasi');

    if($this->db->affected_rows() > 0)
			return true;
		else
			return false;
  }

}
