<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends CI_Model{

  function getAllKategori() {
    $this->db->select('tbl_kategori_galleri.*, count(tbl_galeri.id_kategori_galleri) as jumlah');
		$this->db->from('tbl_galeri');
		$this->db->join('tbl_kategori_galleri','tbl_galeri.id_kategori_galleri = tbl_kategori_galleri.id_kategori_galleri','right');
		$this->db->group_by("id_kategori_galleri");

    $result = $this->db->get()->result();

    return $result;

  }

  function getAllKategoriPublish() {
    $this->db->select('*');
    $this->db->from('tbl_kategori_galleri');

    $result = $this->db->get();

    return $result->result();
  }

  function getKategoriById($idkategori) {
    $this->db->select('*');
    $this->db->from('tbl_kategori_galleri');
    $this->db->where('id_kategori_galleri', $idkategori);

    $result = $this->db->get()->result();

    return $result;

  }

  function getKategoriBySlug($slugkatgaleri) {
    $this->db->select('*');
    $this->db->from('tbl_kategori_galleri');
    $this->db->where('slug_katgaleri', $slugkatgaleri);

    $result = $this->db->get()->row();

    return $result;
  }

  function insertkategori($data) {
    $this->db->insert('tbl_kategori_galleri', $data);
  }

  function updatekategori($idkategori, $data) {
    $this->db->where('id_kategori_galleri', $idkategori);
    $this->db->update('tbl_kategori_galleri', $data);

    if($this->db->affected_rows() > 0)
			return true;
		else
			return false;
  }

  function deletekategori($idkategori) {
    $this->db->where('id_kategori_galleri', $idkategori);
    $this->db->delete('tbl_kategori_galleri');

    if($this->db->affected_rows() > 0)
			return true;
		else
			return false;
  }

  function searchkategori($kategori) {
    $this->db->select('*');
    $this->db->from('tbl_kategori_galleri');
    $this->db->like('kategori_galleri', $kategori);

    $result = $this->db->get();

    return $result->result();
  }

}
