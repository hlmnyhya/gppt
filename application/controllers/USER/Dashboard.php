<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    public function index()
    {
        if (!$this->session->userdata('id_user')) {
            // Redirect or handle accordingly, for example:
            redirect('auth/login');
        }
        
        $data['title'] = "Dashboard | MPP";
        $data['permohonan'] = $this->M_permohonan->show_data_by_user();
    
        // Ambil ID user dari session
        $id_user = $this->session->userdata('id_user');

        // Hitung jumlah permohonan yang diajukan dan selesai
        $data['count_diajukan'] = $this->M_count->count_permohonan_diajukan_by_id_user($id_user);
        $data['count_selesai'] = $this->M_count->count_permohonan_selesai_by_id_user($id_user);
        $data['permohonan_data'] = $this->M_permohonan->get_permohonan_by_user($id_user);
        $data['layanan'] = $this->M_layanan->show_data();
        $data['detaillayanan'] = $this->M_DetailLayanan->show_data();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_user');
        $this->load->view('user/dashboard', $data);
        $this->load->view('templates/footer');
    }

   public function get_permohonan_data($id_user)
   {
       $data = $this->M_permohonan->get_permohonan_by_user($id_user);

       // Return the data as JSON
       echo json_encode($data);
   }
}
?>
