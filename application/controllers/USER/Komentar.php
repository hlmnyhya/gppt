<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Komentar extends CI_Controller {
    
	public function index()
	{
		$data['title'] = "Komentar | MPP";
        $data['komentar'] = $this->M_komentar->show_data();
        $data['instansi'] = $this->M_komentar->tampil_instansi();
        $data['layanan'] = $this->M_komentar->tampil_layanan();
        $this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar_user');
		$this->load->view('user/komentar',$data);
		$this->load->view('templates/footer');
	}
  // Add Data Komentar
public function tambah_data_aksi()
{
    $id_user = $this->input->post('id_user');
    $id_instansi = $this->input->post('id_instansi');
    $id_layanan = $this->input->post('id_layanan');
    $komentar = htmlspecialchars($this->input->post('komentar'));
    $rate = $this->input->post('rate');

    $data = array(
        'id_user' => $id_user,
        'id_instansi' => $id_instansi,
        'id_layanan' => $id_layanan,
        'komentar' => $komentar,
        'rate' => $rate,
        'waktu_komentar' => date('Y-m-d H:i:s'), // Assuming you want to store the current timestamp
    );

    $inserted = $this->M_komentar->insert_data($data, 'komentar');

    if ($inserted) {
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data berhasil ditambahkan!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
    } else {
        $this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal menambahkan data.</strong> Silakan coba lagi nanti.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
    }

    redirect('user/permohonan');
}

// Update Data Komentar
public function update_data_aksi()
{
    $id_komentar = $this->input->post('id_komentar');
    $id_user = $this->input->post('id_user');
    $id_instansi = $this->input->post('id_instansi');
    $id_layanan = $this->input->post('id_layanan');
    $komentar = htmlspecialchars($this->input->post('komentar'));
    // $rate = $this->input->post('rate');

    $data = array(
        'id_user' => $id_user,
        'id_instansi' => $id_instansi,
        'id_layanan' => $id_layanan,
        'komentar' => $komentar,
        // 'rate' => $rate,
        'waktu_komentar' => date('Y-m-d H:i:s'),
    );

    $where = array('id_komentar' => $id_komentar);
    $updated = $this->M_komentar->update_data('komentar', $data, $where);

    if ($updated) {
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data berhasil diperbarui!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
    } else {
        $this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal memperbarui data.</strong> Silakan coba lagi nanti.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
    }

    redirect('user/permohonan');
}

// Delete Data Komentar
public function delete_data_aksi($id_komentar)
{
    $where = array('id_komentar' => $id_komentar);
    $this->M_komentar->delete_data($where, 'komentar');
    redirect('user/permohonan');
}


}