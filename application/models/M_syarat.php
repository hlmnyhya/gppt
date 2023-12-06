<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_syarat extends CI_Model
{
   public function show_data()
{
    return $this->db->query('
       SELECT 
    s.`id_syarat`,
    ld.`id_layanan_detail`, 
    s.`syarat`,
    ld.`id_layanan`, 
    ld.`nama_layanan_detail`, 
    ld.`deskripsi_layanan_detail`, 
    ld.`gambar_layanan_detail`,
    l.`id_layanan`, 
    l.`id_instansi`, 
    l.`nama_layanan`, 
    l.`deskripsi_layanan`, 
    l.`gambar_layanan`
FROM 
    `syarat` s
JOIN 
    `layanan_detail` ld ON s.`id_layanan_detail` = ld.`id_layanan_detail`
JOIN
    `layanan` l ON ld.`id_layanan` = l.`id_layanan`
    ')->result();
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
    public function deleteFile($id_permohonan, $fileId) {
        // Validate user permissions (you may implement your own logic)
        // Add your authentication and authorization checks here

        // Assuming you have a 'berkas' table with columns 'id', 'id_permohonan', etc.
        // Adjust this query based on your actual database schema
        $this->db->where('id_permohonan', $id_permohonan);
        $this->db->where('id', $fileId);
        $this->db->delete('berkas');

        // Check the affected rows to determine the success of the deletion
        return $this->db->affected_rows() > 0;
    }

}