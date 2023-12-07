<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_blanko extends CI_Model
{
    public function show_data()
    {
        return $this->db->get('blanko')->result();
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
}