<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_komentar extends CI_Model
{
   public function show_data()
{
    return $this->db->query('SELECT 
    k.`id_komentar`, 
    k.`id_user`, 
    k.`id_instansi`, 
    k.`id_layanan`, 
    k.`komentar`, 
    k.`rate`, 
    k.`waktu_komentar`,
    l.`nama_layanan`, 
    l.`deskripsi_layanan`, 
    l.`gambar_layanan`, 
    i.`nama_instansi`, 
    i.`kode`, 
    i.`gambar_instansi`,
    u.`username`,
    u.`nama` AS user_nama
FROM 
    `komentar` AS k
JOIN 
    `layanan` AS l ON k.`id_layanan` = l.`id_layanan`
JOIN 
    `instansi` AS i ON k.`id_instansi` = i.`id_instansi`
JOIN
    `users` AS u ON k.`id_user` = u.`id_user`
;
')->result();
}

     public function insert_data($table, $data)
    {
       return $this->db->insert($data, $table);
    }

    public function tampil_instansi()
    {
        return $this->db->query("SELECT * FROM instansi")->result();
    }
    public function tampil_layanan()
    {
        return $this->db->query("SELECT * FROM layanan")->result();
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