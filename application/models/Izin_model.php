<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Izin_model extends CI_Model{

  public function __construct() {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function getAllIzin() {
    $this->db->select('*');
    $this->db->from('tbl_izin');

    $result = $this->db->get();

    return $result->result();
  }

  public function getDetailIzin($id_izin) {
    $this->db->select('*');
    $this->db->from('tbl_izin');
    $this->db->join('tbl_detail_izin', 'tbl_izin.id_izin = tbl_detail_izin.id_izin');
    $this->db->join('tbl_master_syarat','tbl_detail_izin.id_syarat = tbl_master_syarat.id_syarat');
    $this->db->where('tbl_izin.id_izin', $id_izin);

    $result = $this->db->get();

    return $result->result();
  }

  public function insertizin($data) {
    $this->db->insert('tbl_izin', $data);
    $id_izin = $this->db->insert_id();

    return $id_izin;
  }

  public function insertdetailizin($data) {
    $this->db->insert('tbl_detail_izin', $data);

    if($this->db->affected_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }

}
