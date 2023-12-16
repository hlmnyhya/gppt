<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function index()
    {
        $data['title'] = "Dashboard | MPP";
        $data['total_permohonan'] = $this->M_count->total_permohonan();
        $data['total_antrian'] = $this->M_count->total_antrian();
        $data['total_permohonan_selesai'] = $this->M_count->total_permohonan_selesai();
        $data['total_permohonan_diajukan'] = $this->M_count->total_permohonan_diajukan();
        $data['total_kepuasan'] = $this->M_count->total_kepuasan();
        $data['komentar_rate'] = $this->M_count->count_rates();
		// var_dump($data['komentar_rate']);exit;

		// $data['chart_data'] = $this->M_count->get_chart_data();
		
		$data['permohonan_by_instansi'] = $this->M_count->get_permohonan_data_by_instansi();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('admin/dashboard', $data);
        $this->load->view('templates/footer');
    }

	public function get_chart_data() {
    $query = $this->db->query("
        SELECT id_instansi,
               SUM(CASE WHEN status_permohonan = 'selesai' THEN 1 ELSE 0 END) as jumlah_selesai,
               SUM(CASE WHEN status_permohonan = 'diajukan' THEN 1 ELSE 0 END) as jumlah_diajukan
        FROM permohonan 
        GROUP BY id_instansi
    ");

    // Memeriksa apakah ada hasil dari query
    if ($query->num_rows() > 0) {
        $result = array();
        foreach ($query->result() as $row) {
            $result[] = array(
                'y' => $row->id_instansi,
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
}
