<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_DetailLayanan extends CI_Model
{
    public function show_data()
    {
        return $this->db->query("SELECT 
        i.id_instansi, 
        i.nama_instansi, 
        i.gambar_instansi, 
        l.id_layanan, 
        l.nama_layanan, 
        l.deskripsi_layanan, 
        l.gambar_layanan,
        ld.id_layanan_detail,
        ld.nama_layanan_detail,
        ld.deskripsi_layanan_detail,
        ld.gambar_layanan_detail
        FROM instansi i
        INNER JOIN layanan l ON i.id_instansi = l.id_instansi
        INNER JOIN layanan_detail ld ON l.id_layanan = ld.id_layanan;")->result();
    }

    public function tampil_instansi()
    {
        return $this->db->query("SELECT * FROM instansi")->result();
    }
    public function tampil_layanan()
    {
        return $this->db->query("SELECT * FROM layanan")->result();
    }

    public function insert_data($data, $table)
    {
       ($this->db->insert($table, $data));
    }

    public function update_data($table, $data, $where)
    {
        return $this->db->update($table, $data, $where);
    }

    public function delete_data($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function get_all_detail_layanan()
    {
        return $this->db->get('layanan_detail')->result();
    }

    // Fungsi untuk mendapatkan detail layanan berdasarkan ID layanan
    public function get_detail_layanan_by_layanan($id_layanan)
    {
        return $this->db->where('id_layanan', $id_layanan)->get('layanan_detail')->result();
    }
}