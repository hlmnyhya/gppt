<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_permohonan extends CI_Model
{
    public function show_data()
    {
    return $this->db->query("SELECT
    a.id_antrian, 
    a.id_user AS antrian_id_user,
    a.id_layanan AS antrian_id_layanan,
    a.nomor_antrian, 
    a.status_antrian,
    p.id_permohonan, 
    p.nama, 
    p.id_layanan, 
    p.id_layanan_detail, 
    p.status_permohonan, 
    l.id_instansi, 
    l.nama_layanan, 
    l.deskripsi_layanan, 
    l.gambar_layanan, 
    ld.nama_layanan_detail, 
    ld.deskripsi_layanan_detail, 
    ld.gambar_layanan_detail
FROM 
    permohonan AS p
JOIN 
    layanan AS l ON p.id_layanan = l.id_layanan
JOIN 
    layanan_detail AS ld ON p.id_layanan_detail = ld.id_layanan_detail
JOIN
    antrian AS a ON p.id_user = a.id_user;")->result();
    }

    public function show_data_by_user()
    {         
    return $this->db->query("SELECT 
    a.id_antrian, 
    a.id_user AS antrian_id_user,
    a.id_layanan AS antrian_id_layanan,
    a.nomor_antrian, 
    a.status_antrian,
    p.id_permohonan, 
    p.nama AS permohonan_nama, 
    p.id_layanan AS permohonan_id_layanan, 
    p.id_layanan_detail, 
    p.status_permohonan, 
    l.id_instansi, 
    l.nama_layanan, 
    l.deskripsi_layanan, 
    l.gambar_layanan, 
    ld.nama_layanan_detail, 
    ld.deskripsi_layanan_detail, 
    ld.gambar_layanan_detail,
    u.id_user, 
    u.nik, 
    u.nama AS user_nama, 
    u.username, 
    u.password, 
    u.email, 
    u.nomor_telepon, 
    u.id_level, 
    u.gambar_user
FROM 
    antrian AS a
LEFT JOIN
    permohonan AS p ON a.id_user = p.id_user
LEFT JOIN 
    layanan AS l ON p.id_layanan = l.id_layanan
LEFT JOIN 
    layanan_detail AS ld ON p.id_layanan_detail = ld.id_layanan_detail
LEFT JOIN
    users AS u ON p.id_user = u.id_user;")->result();
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