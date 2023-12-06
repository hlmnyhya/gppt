<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_permohonan extends CI_Model
{
    public function show_data()
    {
    return $this->db->query("SELECT 
    p.id_permohonan, p.id_user, p.nama, p.id_instansi, p.id_layanan, p.id_layanan_detail, p.status_permohonan, p.alasan,
    u.id_user AS user_id, u.nik, u.nama AS user_nama, u.username, u.password, u.email, u.nomor_telepon, u.id_level, u.id_instansi AS user_instansi, u.gambar_user,
    l.id_layanan, l.id_instansi AS layanan_instansi, l.nama_layanan, l.deskripsi_layanan, l.gambar_layanan,
    ld.id_layanan_detail, ld.id_layanan AS layanan_detail_layanan, ld.nama_layanan_detail, ld.deskripsi_layanan_detail, ld.gambar_layanan_detail,
    s.id_syarat, s.id_layanan_detail AS syarat_layanan_detail, s.syarat
FROM 
    permohonan p
JOIN 
    users u ON p.id_user = u.id_user
JOIN 
    layanan l ON p.id_layanan = l.id_layanan AND p.id_instansi = l.id_instansi
JOIN 
    layanan_detail ld ON p.id_layanan_detail = ld.id_layanan_detail
LEFT JOIN 
    syarat s ON ld.id_layanan_detail = s.id_layanan_detail
;")->result();
    }

    public function show_data_by_user()
    {         
    return $this->db->query("SELECT 
    p.id_permohonan, p.id_user, p.nama as permohonan_nama, p.id_instansi, p.id_layanan, p.id_layanan_detail, p.status_permohonan, p.alasan,
    u.id_user AS user_id, u.nik, u.nama AS user_nama, u.username, u.password, u.email, u.nomor_telepon, u.id_level, u.id_instansi AS user_instansi, u.gambar_user,
    l.id_layanan, l.id_instansi AS layanan_instansi, l.nama_layanan, l.deskripsi_layanan, l.gambar_layanan,
    ld.id_layanan_detail, ld.id_layanan AS layanan_detail_layanan, ld.nama_layanan_detail, ld.deskripsi_layanan_detail, ld.gambar_layanan_detail,
    s.id_syarat, s.id_layanan_detail AS syarat_layanan_detail, s.syarat
FROM 
    permohonan p
JOIN 
    users u ON p.id_user = u.id_user
JOIN 
    layanan l ON p.id_layanan = l.id_layanan AND p.id_instansi = l.id_instansi
JOIN 
    layanan_detail ld ON p.id_layanan_detail = ld.id_layanan_detail
LEFT JOIN 
    syarat s ON ld.id_layanan_detail = s.id_layanan_detail
JOIN 
    users u_detail ON u.id_user = u_detail.id_user
;")->result();
    }

     public function insert_data($table, $data)
    {
       return $this->db->insert($data, $table);
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

   public function get_permohonan_by_user($id_user)
{
    // Select the columns you need from each table
    $this->db->select('permohonan.*, instansi.nama_instansi, instansi.gambar_instansi, layanan.nama_layanan, layanan.deskripsi_layanan, layanan.gambar_layanan, layanan_detail.nama_layanan_detail, layanan_detail.deskripsi_layanan_detail, layanan_detail.gambar_layanan_detail');

    // Join the tables
    $this->db->from('permohonan');
    $this->db->join('instansi', 'permohonan.id_instansi = instansi.id_instansi', 'left');
    $this->db->join('layanan', 'permohonan.id_layanan = layanan.id_layanan', 'left');
    $this->db->join('layanan_detail', 'permohonan.id_layanan_detail = layanan_detail.id_layanan_detail', 'left');

    // Add the condition for the user ID
    $this->db->where('permohonan.id_user', $id_user);

    // Execute the query and return the result
    return $this->db->get()->result_array();
}

}