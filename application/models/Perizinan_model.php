<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perizinan_model extends CI_Model{

  public function __construct() {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function getAllPerizinan() {
    $this->db->select('*');
    $this->db->from('tbl_perizinan');

    $result = $this->db->get();

    return $result->result();
  }

  public function getAllPerizinanByNipMonth($nip) {
    $tahun = $this->db->select('year(now()) as tahun')->get()->row()->tahun;
    $bulan = $this->db->select('month(now()) as bulan')->get()->row()->bulan;
    $this->db->select('count(*) as bulan');
    $this->db->from('tbl_perizinan');
    $this->db->where('nip', $nip);
    $this->db->where('year(tgl_perizinan)', $tahun);
    $this->db->where('month(tgl_perizinan)', $bulan);
    $result = $this->db->get();

    return $result->row();
  }

  public function getAllPerizinanByNipDay($nip) {
    $tgl = $this->db->select('CURDATE() as tgl')->get()->row()->tgl;
    $this->db->select('count(*) as hari');
    $this->db->from('tbl_perizinan');
    $this->db->where('nip', $nip);
    $this->db->where('tgl_perizinan', $tgl);
    $result = $this->db->get();

    return $result->row();
  }



  public function getLaporanPerizinan($data) {
    $this->db->select('tp.*, ti.nama_izin, tpg.nama_pegawai');
    $this->db->from('tbl_perizinan tp');
    $this->db->join('tbl_izin ti', 'tp.id_izin = tp.id_izin');
    $this->db->join('tbl_pegawai tpg', 'tpg.nip = tp.nip');
    $this->db->where('tp.id_izin', $data['id_izin']);
    $this->db->where('tgl_perizinan between "'.$data['wkt_awal'] .'" AND "'. $data['wkt_akhir'].'"');
    $this->db->where('status_perizinan', $data['sp']);

    $result = $this->db->get();

    return $result->result();
  }

  public function daftarperizinan($status_perizinan) {
    $this->db->select('*');
    $this->db->from('tbl_perizinan');
    $this->db->like('status_perizinan', $status_perizinan);

    $result = $this->db->get();

    return $result->result();
  }

  public function getPerizinanByYear() {
    $tgl = $this->db->select('year(now()) as tahun')->get()->row()->tahun;
    $this->db->select('MONTHNAME(tgl_perizinan) as Bulan, count(id_perizinan) as Jumlah_perizinan');
    $this->db->from('tbl_perizinan');
    $this->db->where('YEAR(tgl_perizinan)', $tgl);
    $this->db->group_by('MONTHNAME(tgl_perizinan)');

    $result = $this->db->get();

    return $result->result();
  }

  public function getDetailPerizinan($id_perizinan) {
    $this->db->select('ti.nama_izin, tp.id_perizinan,tp.nomor_perizinan, tp.status_perizinan, tp.alamat_perizinan,tms.nama_syarat, tdp.kelengkapan_syarat');
		$this->db->from('tbl_perizinan tp');
		$this->db->join('tbl_detail_perizinan tdp','tp.id_perizinan = tdp.id_perizinan');
		$this->db->join('tbl_master_syarat tms','tdp.id_syarat = tms.id_syarat');
		$this->db->join('tbl_izin ti', 'ti.id_izin = tp.id_izin');
		$this->db->where('tp.id_perizinan', $id_perizinan);

		return $this->db->get()->result();
  }

  public function insertperizinan($data) {
    $this->db->insert('tbl_perizinan', $data);
  }

  public function insertdetailperizinan($data) {
    $this->db->insert('tbl_detail_perizinan', $data);
  }

  public function updatePerizinan($id_perizinan, $data) {
    $this->db->where('id_perizinan', $id_perizinan);
    $this->db->update('tbl_perizinan', $data);

    if($this->db->affected_rows() > 0)
      return TRUE;
    else
      return false;
  }


}
