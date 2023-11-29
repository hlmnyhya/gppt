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
            ld.`gambar_layanan_detail`
        FROM 
            `syarat` s
        JOIN 
            `layanan_detail` ld ON s.`id_layanan_detail` = ld.`id_layanan_detail`
    ')->result();
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
}