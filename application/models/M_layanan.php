<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_layanan extends CI_Model
{
    public function show_data()
    {
        return $this->db->query("SELECT i.id_instansi, i.nama_instansi, i.gambar_instansi, l.id_layanan, l.nama_layanan, l.deskripsi_layanan, l.gambar_layanan
        FROM instansi i
        INNER JOIN layanan l ON i.id_instansi = l.id_instansi;")->result();
    }

    public function tampil_instansi()
    {
        return $this->db->query("SELECT * FROM instansi")->result();
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

    public function get_all_layanan()
    {
        return $this->db->get('layanan')->result();
    }

    // Fungsi untuk mendapatkan layanan berdasarkan ID instansi
    public function get_layanan_by_instansi($id_instansi)
    {
        return $this->db->where('id_instansi', $id_instansi)->get('layanan')->result();
    }
}