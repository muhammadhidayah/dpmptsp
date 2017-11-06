<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Syarat_model extends CI_Model{

  public function __construct() {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function getAllSyarat() {
    $this->db->select('*');
    $this->db->from('tbl_master_syarat');

    $result = $this->db->get();

    return $result->result();
  }

  public function searchsyarat($nama_syarat) {
    $this->db->select('*');
    $this->db->from('tbl_master_syarat');
    $this->db->like('nama_syarat', $nama_syarat);

    $result = $this->db->get();
    if(count($result) > 0){
      return $result->result();
    } else {
      return "No Result";
    }
  }

  public function insertsyarat($data) {
    $this->db->insert('tbl_master_syarat', $data);
  }

  public function deletesyarat($id_syarat) {
    $this->db->where('id_syarat', $id_syarat);
    $this->db->delete('tbl_master_syarat');

    if($this->db->affected_rows() > 0) {
      return true;
    } else {
      return false;
    }

  }


}
