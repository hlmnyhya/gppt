<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instansi extends CI_Controller {
    
	public function index()
	{
		$data['title'] = "Instansi | MPP";
        $data['instansi'] = $this->M_instansi->show_data();
        $this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar');
		$this->load->view('admin/instansi',$data);
		$this->load->view('templates/footer');

	}
    public function tambah_data_aksi()
    {
    $nama_instansi = htmlspecialchars($this->input->post('nama_instansi'));

    // Menggunakan $_FILES untuk mendapatkan informasi upload file
    $gambar_instansi = $_FILES['gambar_instansi']['name'];

    // Konfigurasi upload gambar profil
    $config_profil['upload_path'] = './uploads/instansi/';
    $config_profil['allowed_types'] = 'gif|jpg|jpeg|png|webp';
    $config_profil['max_size'] = 4096;

    $this->load->library('upload', $config_profil);
    $this->upload->initialize($config_profil);

    if (!$this->upload->do_upload('gambar_instansi')) {
        // Jika upload gagal, atur pesan validasi dan kembali ke halaman sebelumnya
        $error = $this->upload->display_errors();
        $this->session->set_flashdata('error', $error);
    } else {
        $data_gambar = $this->upload->data();
        $gambar = $data_gambar['file_name'];

        $data = array(
            'nama_instansi' => $nama_instansi,
            'gambar_instansi' => $gambar
        );

        $inserted = $this->M_instansi->insert_data($data, 'instansi');

        if ($inserted) {
	        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade sho    role="alert">
	            <strong>Data berhasil ditambahkan!</strong>
	            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                <span aria-hidden="true">&times;</span>
	            </button>
	        </div>');
	    } else {
	        $this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible fade sho    role="alert">
	            <strong>Gagal menambahkan data.</strong> Silakan coba lagi nanti.
	            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                <span aria-hidden="true">&times;</span>
	            </button>
	        </div>');
	    }
    }

    redirect('admin/instansi');
    }

    public function update_data_aksi()
{
    $id_instansi = $this->input->post('id_instansi'); // Ambil ID dari form

    $nama_instansi = htmlspecialchars($this->input->post('nama_instansi'));

    // Menggunakan $_FILES untuk mendapatkan informasi upload file
    $gambar_instansi = $_FILES['gambar_instansi']['name'];

    // Konfigurasi upload gambar profil
    $config_profil['upload_path'] = './uploads/instansi/';
    $config_profil['allowed_types'] = 'gif|jpg|jpeg|png|webp';
    $config_profil['max_size'] = 4096;

    $this->load->library('upload', $config_profil);
    $this->upload->initialize($config_profil);

    // Jika ada file gambar yang diupload
    if (!empty($gambar_instansi)) {
        if (!$this->upload->do_upload('gambar_instansi')) {
            // Jika upload gagal, atur pesan validasi dan kembali ke halaman sebelumnya
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            redirect('admin/instansi');
        } else {
            // Jika upload sukses, ambil data gambar
            $data_gambar = $this->upload->data();
            $gambar = $data_gambar['file_name'];
        }
    }

    // Jika tidak ada file gambar yang diupload atau upload sukses
    // Proses update data
    $data = array(
        'nama_instansi' => $nama_instansi,
    );

    if (!empty($gambar)) {
        $data['gambar_instansi'] = $gambar;
    }

    $where = array('id_instansi' => $id_instansi);
    $updated = $this->M_instansi->update_data('instansi', $data, $where);

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

    redirect('admin/instansi');
}

public function delete_data_aksi($id_instansi)
{
    $where = array('id_instansi' => $id_instansi);
    $this->M_instansi->delete_data($where, 'instansi');
    redirect('admin/instansi');
}

}
