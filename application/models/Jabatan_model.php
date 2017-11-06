<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan_model extends CI_Model{

  public function __construct() {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  static protected $tbl_name = "tbl_jabatan";

  public function getAllJabatan() {
    $this->db->select('*');
    $this->db->from('tbl_jabatan');

    $result = $this->db->get();

    return $result->result();
  }

  public function getDEtailJabatan($id_jabatan) {
    $this->db->select('*');
    $this->db->from('tbl_jabatan');
    $this->db->where('id_jabatan', $id_jabatan);

    $result = $this->db->get();

    return $result->row();
  }

  public function insertJabatan($data) {
    $this->db->insert('tbl_jabatan', $data);

    if($this->db->affected_rows() > 0)
      return TRUE;
    else
      return FALSE;
  }

  public function updateJabatan($id_jabatan, $data) {
    $this->db->where('id_jabatan', $id_jabatan);
    $this->db->update('tbl_jabatan', $data);

    if($this->db->affected_rows() > 0)
      return TRUE;
    else
      return FALSE;
  }

  public function deleteJabatan($id_jabatan) {
    $this->db->where('id_jabatan', $id_jabatan);
    $this->db->delete('tbl_jabatan');

    if($this->db->affected_rows() > 0)
      return TRUE;
    else
      return FALSE;
  }

}
