<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AntrianPetugas extends CI_Controller {
    
    public function index()
    {
        $data['title'] = "Antrian | MPP";
        $data['antrian'] = $this->M_antrian->show_data();
        $this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar_petugas');
		$this->load->view('petugas/antrian',$data);
		$this->load->view('templates/footer');
    }

   public function selesai_antrian($id_antrian)
{
    // Pastikan $id_antrian valid
    if (!$id_antrian) {
        // Handle kesalahan, misalnya redirect ke halaman sebelumnya atau tampilkan pesan error
        $response = array('success' => false, 'message' => 'ID Antrian tidak valid');
        echo json_encode($response);
        exit(); // Stop further execution
    }

    $data = array(
        'status_antrian' => 'Selesai'
    );

    $this->db->where('id_antrian', $id_antrian);
    $updated = $this->db->update('antrian', $data);

    if ($updated) {
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Status Antrian berhasil diperbarui menjadi "Selesai"!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
        $response = array('success' => true);
    } else {
        $this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal memperbarui status antrian. Silakan coba lagi nanti.</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
        $response = array('success' => false, 'message' => 'Gagal memperbarui status antrian. Silakan coba lagi nanti.');
    }

    echo json_encode($response);
}
}

