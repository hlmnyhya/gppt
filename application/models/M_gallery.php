<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_gallery extends CI_Model
{
    public function show_data()
    {
        return $this->db->get('gallery')->result();
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