<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galeri_model extends CI_Model{

  function getgaleribyid($id_galeri) {
    $this->db->select('*');
    $this->db->from('tbl_galeri');
    $this->db->where('id_galeri', $id_galeri);

    $result = $this->db->get();

    return $result->row();
  }

  function viewGaleriByKategori($id_kategori_galleri) {
    $this->db->select('*');
    $this->db->from('tbl_galeri');
    $this->db->join('tbl_kategori_galleri', 'tbl_galeri.id_kategori_galleri = tbl_kategori_galleri.id_kategori_galleri','RIGHT');
    $this->db->where('tbl_galeri.id_kategori_galleri', $id_kategori_galleri);

    $result = $this->db->get()->result();

    return $result;
  }

  function insertgaleri($data) {
    $this->db->insert('tbl_galeri', $data);
  }

  function updategaleri($id_galeri, $data) {
    $this->db->where('id_galeri', $id_galeri);
    $this->db->update('tbl_galeri', $data);


  }

  function deletegaleri($id_galeri) {
    $this->db->where('id_galeri', $id_galeri);
    $this->db->delete('tbl_galeri');
  }


}
