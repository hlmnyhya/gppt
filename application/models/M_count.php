<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_count extends CI_Model
{
    public function count_permohonan_diajukan_by_id_user($id_user)
    {
        return $this->db->where('id_user', $id_user)
                        ->where('status_permohonan', 'Diajukan')
                        ->from('permohonan')
                        ->count_all_results();
    }

    // Fungsi untuk menghitung jumlah permohonan yang selesai berdasarkan ID user
    public function count_permohonan_selesai_by_id_user($id_user)
    {
        return $this->db->where('id_user', $id_user)
                        ->where('status_permohonan', 'Selesai')
                        ->from('permohonan')
                        ->count_all_results();
    }

    public function get_syarat_by_instansi($id_instansi) {
        return $this->db->get_where('syarat', array('id_instansi' => $id_instansi))->result_array();
    }
    public function get_layanan_detail_by_instansi($id_instansi) {
        return $this->db->get_where('layanan_detail', array('id_instansi' => $id_instansi))->result_array();
    }
    public function get_layanan_by_instansi($id_instansi) {
        return $this->db->get_where('layanan', array('id_instansi' => $id_instansi))->result_array();
    }
    public function get_instansi_by_id($id_instansi) {
        return $this->db->get_where('instansi', array('id_instansi' => $id_instansi))->row_array();
    }

    public function get_instansi_with_related_data($id_instansi) {
    $this->db->select('*');
    $this->db->from('instansi');
    $this->db->join('layanan', 'layanan.id_instansi = instansi.id_instansi', 'left');
    $this->db->where('instansi.id_instansi', $id_instansi);

    return $this->db->get()->result_array();
}

   public function get_layanan_with_related_data($id_layanan) {
    $this->db->select('*');
    $this->db->from('layanan');
    $this->db->join('layanan_detail', 'layanan_detail.id_layanan = layanan.id_layanan', 'left');
    $this->db->where('layanan.id_layanan', $id_layanan);

    return $this->db->get()->result_array();
}

 public function get_layanan_detail_with_related_data($id_layanan_detail) {
    $this->db->select('*');
    $this->db->from('layanan_detail');
    $this->db->join('syarat', 'syarat.id_layanan_detail = layanan_detail.id_layanan_detail', 'left');
    $this->db->where('layanan_detail.id_layanan_detail', $id_layanan_detail);
    return $this->db->get()->result_array();
}

public function get_syarat_by_layanan_detail($id_layanan_detail)
{
    return $this->db->get_where('syarat', array('id_layanan_detail' => $id_layanan_detail))->result_array();
}


}