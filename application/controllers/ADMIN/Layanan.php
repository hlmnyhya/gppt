<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Layanan extends CI_Controller {
    
	public function index()
	{
		$data['title'] = "Layanan | MPP";
        $data['layanan'] = $this->M_layanan->show_data();
        $data['instansi'] = $this->M_layanan->tampil_instansi();
        $this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar');
		$this->load->view('admin/layanan',$data);
		$this->load->view('templates/footer');

	}

public function tambah_data_aksi()
{
    $id_instansi = htmlspecialchars($this->input->post('id_instansi'));
    $nama_layanan = htmlspecialchars($this->input->post('nama_layanan'));
    $deskripsi_layanan = htmlspecialchars($this->input->post('deskripsi_layanan'));

    // Menggunakan $_FILES untuk mendapatkan informasi upload file
    $gambar_layanan = $_FILES['gambar_layanan']['name'];

    // Konfigurasi upload gambar layanan
    $config_layanan['upload_path'] = './uploads/layanan/';
    $config_layanan['allowed_types'] = 'gif|jpg|jpeg|png|webp';
    $config_layanan['max_size'] = 4096;

    $this->load->library('upload', $config_layanan);
    $this->upload->initialize($config_layanan);

    if (!$this->upload->do_upload('gambar_layanan')) {
        // Jika upload gagal, atur pesan validasi dan kembali ke halaman sebelumnya
        $error = $this->upload->display_errors();
        $this->session->set_flashdata('error', $error);
    } else {
        $data_gambar = $this->upload->data();
        $gambar = $data_gambar['file_name'];

        $data = array(
            'id_instansi' => $id_instansi,
            'nama_layanan' => $nama_layanan,
            'deskripsi_layanan' => $deskripsi_layanan,
            'gambar_layanan' => $gambar
        );

        $inserted = $this->M_layanan->insert_data($data, 'layanan');

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

    redirect('admin/layanan');
}

// Update Data Layanan
public function update_data_aksi()
{
    $id_layanan = $this->input->post('id_layanan');
    $id_instansi = htmlspecialchars($this->input->post('id_instansi'));
    $nama_layanan = htmlspecialchars($this->input->post('nama_layanan'));
    $deskripsi_layanan = htmlspecialchars($this->input->post('deskripsi_layanan'));

    // Menggunakan $_FILES untuk mendapatkan informasi upload file
    $gambar_layanan = $_FILES['gambar_layanan']['name'];

    // Konfigurasi upload gambar layanan
    $config_layanan['upload_path'] = './uploads/layanan/';
    $config_layanan['allowed_types'] = 'gif|jpg|jpeg|png|webp';
    $config_layanan['max_size'] = 4096;

    $this->load->library('upload', $config_layanan);
    $this->upload->initialize($config_layanan);

    if (!empty($gambar_layanan)) {
        if (!$this->upload->do_upload('gambar_layanan')) {
            // Jika upload gagal, atur pesan validasi dan kembali ke halaman sebelumnya
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            redirect('admin/layanan');
        } else {
            $data_gambar = $this->upload->data();
            $gambar = $data_gambar['file_name'];
        }
    }

    $data = array(
        'id_instansi' => $id_instansi,
        'nama_layanan' => $nama_layanan,
        'deskripsi_layanan' => $deskripsi_layanan,
    );

    if (!empty($gambar)) {
        $data['gambar_layanan'] = $gambar;
    }

    $where = array('id_layanan' => $id_layanan);
    $updated = $this->M_layanan->update_data('layanan', $data, $where);

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

    redirect('admin/layanan');
}

// Hapus Data Layanan
public function delete_data_aksi($id_layanan)
{
    $where = array('id_layanan' => $id_layanan);
    $this->M_layanan->delete_data($where, 'layanan');
    redirect('admin/layanan');
}





}
