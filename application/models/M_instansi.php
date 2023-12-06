<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_instansi extends CI_Model
{
    public function show_data()
    {
        return $this->db->get('instansi')->result();
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

    public function get_all_instansi()
    {
        return $this->db->get('instansi')->result();
    }

    public function get_instansi_by_id($id_instansi)
    {
        // Assuming you have a table named 'instansi'
        $this->db->where('id_instansi', $id_instansi);
        return $this->db->get('instansi')->row();
    }
}