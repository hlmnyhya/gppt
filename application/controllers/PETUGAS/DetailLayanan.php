<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DetailLayanan extends CI_Controller {
    
	public function index()
	{
		$data['title'] = "Detail Layanan | MPP";
        $data['detaillayanan'] = $this->M_DetailLayanan->show_data();
        $data['layanan'] = $this->M_DetailLayanan->tampil_layanan();
        $this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar_petugas');
		$this->load->view('petugas/detail_layanan',$data);
		$this->load->view('templates/footer');

	}
    
public function tambah_data_aksi()
{
    $id_layanan = htmlspecialchars($this->input->post('id_layanan'));
    $nama_layanan_detail = htmlspecialchars($this->input->post('nama_layanan_detail'));
    $deskripsi_layanan_detail = htmlspecialchars($this->input->post('deskripsi_layanan_detail'));

    // Menggunakan $_FILES untuk mendapatkan informasi upload file
    $gambar_layanan_detail = $_FILES['gambar_layanan_detail']['name'];

    // Konfigurasi upload gambar layanan_detail
    $config_layanan_detail['upload_path'] = './uploads/layanan_detail/';
    $config_layanan_detail['allowed_types'] = 'gif|jpg|jpeg|png|webp';
    $config_layanan_detail['max_size'] = 4096;

    $this->load->library('upload', $config_layanan_detail);
    $this->upload->initialize($config_layanan_detail);

    if (!$this->upload->do_upload('gambar_layanan_detail')) {
        // Jika upload gagal, atur pesan validasi dan kembali ke halaman sebelumnya
        $error = $this->upload->display_errors();
        $this->session->set_flashdata('error', $error);
    } else {
        $data_gambar = $this->upload->data();
        $gambar = $data_gambar['file_name'];

        $data = array(
            'id_layanan' => $id_layanan,
            'nama_layanan_detail' => $nama_layanan_detail,
            'deskripsi_layanan_detail' => $deskripsi_layanan_detail,
            'gambar_layanan_detail' => $gambar
        );

        $inserted = $this->M_DetailLayanan->insert_data($data, 'layanan_detail');

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
    }

    redirect('petugas/layanan_detail');
}


// Update Data Layanan
public function update_data_aksi()
{
    $id_layanan_detail = $this->input->post('id_layanan_detail');
    $id_layanan = htmlspecialchars($this->input->post('id_layanan'));
    $nama_layanan_detail = htmlspecialchars($this->input->post('nama_layanan_detail'));
    $deskripsi_layanan_detail = htmlspecialchars($this->input->post('deskripsi_layanan_detail'));

    // Menggunakan $_FILES untuk mendapatkan informasi upload file
    $gambar_layanan_detail = $_FILES['gambar_layanan_detail']['name'];

    // Konfigurasi upload gambar layanan_detail
    $config_layanan_detail['upload_path'] = './uploads/layanan_detail/';
    $config_layanan_detail['allowed_types'] = 'gif|jpg|jpeg|png|webp';
    $config_layanan_detail['max_size'] = 4096;

    $this->load->library('upload', $config_layanan_detail);
    $this->upload->initialize($config_layanan_detail);

    if (!empty($gambar_layanan_detail)) {
        if (!$this->upload->do_upload('gambar_layanan_detail')) {
            // Jika upload gagal, atur pesan validasi dan kembali ke halaman sebelumnya
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            redirect('admin/layanan_detail');
        } else {
            $data_gambar = $this->upload->data();
            $gambar = $data_gambar['file_name'];
        }
    }

    $data = array(
        'id_layanan' => $id_layanan,
        'nama_layanan_detail' => $nama_layanan_detail,
        'deskripsi_layanan_detail' => $deskripsi_layanan_detail,
    );

    if (!empty($gambar)) {
        $data['gambar_layanan_detail'] = $gambar;
    }

    $where = array('id_layanan_detail' => $id_layanan_detail);
    $updated = $this->M_DetailLayanan->update_data('layanan_detail', $data, $where);

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

    redirect('petugas/layanan_detail');
}

// Hapus Data Layanan
public function delete_data_aksi($id_layanan_detail)
{
    $where = array('id_layanan_detail' => $id_layanan_detail);
    $this->M_DetailLayanan->delete_data($where, 'layanan_detail');
    redirect('petugas/layanan_detail');
}






}
