<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_users extends CI_Model
{
    public function show_data()
    {
        return $this->db->query("SELECT
    u.`id_user`,
    u.`nama`,
    u.`username`,
    u.`password`,
    u.`email`,
    u.`nomor_telepon`,
    u.`id_level`,
    l.`level`,
    u.`id_instansi`,
    i.`nama_instansi`,
    u.`gambar_user`
FROM
    `users` u
JOIN
    `level` l ON u.`id_level` = l.`id_level`
LEFT JOIN
    `instansi` i ON u.`id_instansi` = i.`id_instansi`;")->result();
    }

    public function tampil_level()
    {
        return $this->db->get('level')->result();
    }

    public function tampil_instansi()
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

    public function cek_login()
    {
    $username   = set_value('username');
    $password   = set_value('password');

        $result     = $this->db->where('username', $username)
            ->where('password', md5($password))
            ->limit(1)
            ->get('users');

        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return FALSE;
        }
    }
}