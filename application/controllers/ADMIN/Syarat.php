<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Syarat extends CI_Controller {
    
	public function index()
	{
		$data['title'] = "Syarat | MPP";
        $data['syarat'] = $this->M_syarat->show_data();
        $data['detaillayanan'] = $this->M_DetailLayanan->show_data();
        $this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar');
		$this->load->view('admin/syarat',$data);
		$this->load->view('templates/footer');

	}
  // Tambah Data Syarat
public function tambah_data_aksi()
{
    $id_layanan_detail = $this->input->post('id_layanan_detail');
    $syarat = htmlspecialchars($this->input->post('syarat'));

    $data = array(
        'id_layanan_detail' => $id_layanan_detail,
        'syarat' => $syarat,
    );

    $inserted = $this->M_syarat->insert_data($data, 'syarat');

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

    redirect('admin/syarat');
}


// Update Data Syarat
public function update_data_aksi()
{
    $id_syarat = $this->input->post('id_syarat');
    $id_layanan_detail = $this->input->post('id_layanan_detail');
    $syarat = htmlspecialchars($this->input->post('syarat'));

    $data = array(
        'id_layanan_detail' => $id_layanan_detail,
        'syarat' => $syarat,
    );

    $where = array('id_syarat' => $id_syarat);
    $updated = $this->M_syarat->update_data('syarat', $data, $where);

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

    redirect('admin/syarat');
}




// Hapus Data Berita
public function delete_data_aksi($id_syarat)
{
    $where = array('id_syarat' => $id_syarat);
    $this->M_syarat->delete_data($where, 'syarat');
    redirect('admin/syarat');
}

}