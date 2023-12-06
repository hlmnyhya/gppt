<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_antrian extends CI_Model
{
    public function get_last_queue_number($id_instansi)
    {
        // Query to get the last queue number for the specified instansi
        $this->db->select_max('nomor_antrian', 'last_queue_number');
        $this->db->where('id_instansi', $id_instansi);
        $result = $this->db->get('antrian')->row();

        return ($result->last_queue_number) ? intval(substr($result->last_queue_number, 3)) : 0;
    }

    public function insert_data($table, $data)
    {
        return $this->db->insert($table, $data);
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
?>
