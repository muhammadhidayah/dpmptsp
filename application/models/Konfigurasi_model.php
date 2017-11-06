<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfigurasi_model extends CI_Model{

  public function __construct() {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function getKonfigurasi() {
    $this->db->select('*');
    $this->db->from('tbl_konfigurasi');
    $this->db->where('id_konfigurasi', '1');

    $result = $this->db->get();

    return $result->row();
  }

  public function updateKonfigurasi($data) {
    $this->db->where('id_konfigurasi', '1');
    $this->db->update('tbl_konfigurasi', $data);

    if($this->db->affected_rows() > 0)
      return TRUE;
    else
      return FALSE;
  }

}
