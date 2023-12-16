<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_count extends CI_Model
{   
    // Admin
    public function count_permohonan_diajukan_by_id_user($id_user)
    {
        return $this->db->where('id_user', $id_user)
                        ->where('status_permohonan', 'Diajukan')
                        ->from('permohonan')
                        ->count_all_results();
    }

    // Fungsi untuk menghitung jumlah permohonan yang selesai berdasarkan ID user
    public function count_permohonan_selesai_by_id_user($id_user)
    {
        return $this->db->where('id_user', $id_user)
                        ->where('status_permohonan', 'Selesai')
                        ->from('permohonan')
                        ->count_all_results();
    }

    public function get_syarat_by_instansi($id_instansi) {
        return $this->db->get_where('syarat', array('id_instansi' => $id_instansi))->result_array();
    }
    public function get_layanan_detail_by_instansi($id_instansi) {
        return $this->db->get_where('layanan_detail', array('id_instansi' => $id_instansi))->result_array();
    }
    public function get_layanan_by_instansi($id_instansi) {
        return $this->db->get_where('layanan', array('id_instansi' => $id_instansi))->result_array();
    }
    public function get_instansi_by_id($id_instansi) {
        return $this->db->get_where('instansi', array('id_instansi' => $id_instansi))->row_array();
    }

    public function get_instansi_with_related_data($id_instansi) {
    $this->db->select('*');
    $this->db->from('instansi');
    $this->db->join('layanan', 'layanan.id_instansi = instansi.id_instansi', 'left');
    $this->db->where('instansi.id_instansi', $id_instansi);

    return $this->db->get()->result_array();
}

   public function get_layanan_with_related_data($id_layanan) {
    $this->db->select('*');
    $this->db->from('layanan');
    $this->db->join('layanan_detail', 'layanan_detail.id_layanan = layanan.id_layanan', 'left');
    $this->db->where('layanan.id_layanan', $id_layanan);

    return $this->db->get()->result_array();
}

 public function get_layanan_detail_with_related_data($id_layanan_detail) {
    $this->db->select('*');
    $this->db->from('layanan_detail');
    $this->db->join('syarat', 'syarat.id_layanan_detail = layanan_detail.id_layanan_detail', 'left');
    $this->db->where('layanan_detail.id_layanan_detail', $id_layanan_detail);
    return $this->db->get()->result_array();
}

public function get_syarat_by_layanan_detail($id_layanan_detail)
{
    return $this->db->get_where('syarat', array('id_layanan_detail' => $id_layanan_detail))->result_array();
}

public function total_permohonan()
{
  return $this->db->count_all('permohonan');
}

public function total_antrian()
{
     return $this->db->count_all('antrian');
}

public function total_permohonan_selesai()
{
    $query = $this->db->query("SELECT COUNT(*) as total FROM permohonan WHERE status_permohonan = 'Selesai'");
    
    if ($query->num_rows() > 0) {
        $result = $query->row()->total;
        return $result;
    } else {
        return 0;
    }
}

public function total_permohonan_diajukan()
{
    $query = $this->db->query("SELECT COUNT(*) as total FROM permohonan WHERE status_permohonan = 'Diajukan'");
    
    if ($query->num_rows() > 0) {
        $result = $query->row()->total;
        return $result;
    } else {
        return 0;
    }
}

public function total_kepuasan()
{
    return $this->db->select_sum('rate')->get('komentar')->row()->rate;
}

public function get_permohonan_data_by_instansi() {
    $query = $this->db->query("
       SELECT p.id_instansi,
           i.nama_instansi,
           SUM(CASE WHEN p.status_permohonan = 'selesai' THEN 1 ELSE 0 END) as jumlah_selesai,
           SUM(CASE WHEN p.status_permohonan = 'diajukan' THEN 1 ELSE 0 END) as jumlah_diajukan
    FROM permohonan p
    JOIN instansi i ON p.id_instansi = i.id_instansi
    GROUP BY p.id_instansi
    ");
    
    return $query->result();
}

public function get_chart_data() {
$query = $this->db->query("
    SELECT p.id_instansi,
           i.nama_instansi,
           SUM(CASE WHEN p.status_permohonan = 'selesai' THEN 1 ELSE 0 END) as jumlah_selesai,
           SUM(CASE WHEN p.status_permohonan = 'diajukan' THEN 1 ELSE 0 END) as jumlah_diajukan
    FROM permohonan p
    JOIN instansi i ON p.id_instansi = i.id_instansi
    GROUP BY p.id_instansi
");
    // Memeriksa apakah ada hasil dari query
    if ($query->num_rows() > 0) {
        $result = array();
        foreach ($query->result() as $row) {
            $result[] = array(
                'y' => $row->nama_instansi,
                'a' => $row->jumlah_selesai,
                'b' => $row->jumlah_diajukan
            );
        }

        return $result;
    } else {
        // Jika tidak ada data, berikan pesan 'syarat tidak ada'
        echo 'syarat tidak ada';
        return FALSE;
    }
}

// Petugas

public function get_permohonan_data_by_instansi_petugas() {
    $id_instansi = $this->session->userdata('id_instansi');

    $query = $this->db->query("
       SELECT p.id_instansi,
           i.nama_instansi,
           SUM(CASE WHEN p.status_permohonan = 'selesai' THEN 1 ELSE 0 END) as jumlah_selesai,
           SUM(CASE WHEN p.status_permohonan = 'diajukan' THEN 1 ELSE 0 END) as jumlah_diajukan
    FROM permohonan p
    JOIN instansi i ON p.id_instansi = i.id_instansi
    WHERE p.id_instansi = $id_instansi
    GROUP BY p.id_instansi
    ");
    
    return $query->result();
}

public function total_permohonan_petugas()
{
    $id_instansi = $this->session->userdata('id_instansi');
    
    $query = $this->db->where('id_instansi', $id_instansi)
                      ->get('permohonan');

    return $query->num_rows();
}


public function total_antrian_petugas()
{
    return $this->db->where('id_instansi', $this->session->userdata('id_instansi'))
                    ->count_all('antrian');
}

public function total_permohonan_selesai_petugas()
{
    $query = $this->db->query("SELECT COUNT(*) as total FROM permohonan WHERE status_permohonan = 'Selesai' AND id_instansi = ".$this->session->userdata('id_instansi'));
    
    if ($query->num_rows() > 0) {
        $result = $query->row()->total;
        return $result;
    } else {
        return 0;
    }
}

public function total_permohonan_diajukan_petugas()
{
    $query = $this->db->query("SELECT COUNT(*) as total FROM permohonan WHERE status_permohonan = 'Diajukan' AND id_instansi = ".$this->session->userdata('id_instansi'));
    
    if ($query->num_rows() > 0) {
        $result = $query->row()->total;
        return $result;
    } else {
        return 0;
    }
}

public function total_kepuasan_petugas()
{
    $query = $this->db->select_sum('rate')
                      ->from('komentar')
                      ->join('instansi', 'komentar.id_instansi = instansi.id_instansi')
                      ->where('instansi.id_instansi', $this->session->userdata('id_instansi'))
                      ->get();

    if ($query->num_rows() > 0) {
        $result = $query->row()->rate;
        return $result;
    } else {
        return 0;
    }
}


 public function get_average_rate() {
        $this->db->select('ROUND(AVG(rate)) as average_rate');
        $query = $this->db->get('komentar');

        if ($query->num_rows() > 0) {
            return $query->row()->average_rate;
        } else {
            return 0;
        }
    }

    // Jika ingin mengambil rata-rata berdasarkan suatu kondisi
    public function get_average_rate_by_instansi($id_instansi) {
        $this->db->select('ROUND(AVG(rate)) as average_rate');
        $this->db->where('id_instansi', $id_instansi);
        $query = $this->db->get('komentar');

        if ($query->num_rows() > 0) {
            return $query->row()->average_rate;
        } else {
            return 0;
        }
    }
public function count_rates_by_instansi() 
{
    $id_instansi = $this->session->userdata('id_instansi');
    $query = $this->db->query("SELECT  
        COUNT(CASE WHEN rate >= 3 THEN 1 ELSE 0 END) as positive,
        COUNT(CASE WHEN rate <= 2 THEN 1 ELSE 0 END) as negative
        FROM komentar WHERE id_instansi = ?", [$id_instansi]);

    if ($query->num_rows() > 0) {
        $result = $query->row();
        $result->total_percentage = 100; // Menetapkan total_percentage ke 100%
        return $result;
    } else {
        return null;
    }
}


public function count_rates() 
{
    $query = $this->db->query("SELECT  
        SUM(CASE WHEN rate >= 3 THEN 1 ELSE 0 END) as positive,
        SUM(CASE WHEN rate <= 2 THEN 1 ELSE 0 END) as negative
        FROM komentar");

    if ($query->num_rows() > 0) {
        $result = $query->row();
        $result->total_percentage = 100; // Menetapkan total_percentage ke 100%
        return $result;
    } else {
        return null;
    }
}

}