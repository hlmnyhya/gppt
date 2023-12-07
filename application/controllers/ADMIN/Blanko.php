<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blanko extends CI_Controller {
    
	public function index()
	{
		$data['title'] = "Blanko | MPP";
        $data['blanko'] = $this->M_blanko->show_data();
        $this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar');
		$this->load->view('admin/blanko',$data);
		$this->load->view('templates/footer');

	}
   public function tambah_data_aksi()
{
    $nama_blanko = htmlspecialchars($this->input->post('nama_blanko'));
    $keterangan = htmlspecialchars($this->input->post('keterangan'));

    // Menggunakan $_FILES untuk mendapatkan informasi upload file
    $config['upload_path'] = './uploads/blanko/';
    $config['allowed_types'] = 'gif|jpg|jpeg|png|webp|pdf|docx';
    $config['max_size'] = 4096;

    $this->load->library('upload', $config);
    $this->upload->initialize($config);

    if (!$this->upload->do_upload('file')) {
        // Jika upload gagal, atur pesan validasi dan kembali ke halaman sebelumnya
        $error = $this->upload->display_errors();
        $this->session->set_flashdata('error', $error);
    } else {
        $data_gambar = $this->upload->data();
        $gambar = $data_gambar['file_name'];

        $data = array(
            'nama_blanko' => $nama_blanko,
            'keterangan' => $keterangan,
            'file' => $gambar
        );

        $inserted = $this->M_blanko->insert_data($data, 'blanko');

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

    redirect('admin/blanko');
}


public function update_data_aksi()
{
    $id_blanko = htmlspecialchars($this->input->post('id_blanko'));
    $nama_blanko = htmlspecialchars($this->input->post('nama_blanko'));
    $keterangan = htmlspecialchars($this->input->post('keterangan'));

    // Cek apakah ada file baru diupload
    if ($_FILES['file']['name']) {
        // Menggunakan $_FILES untuk mendapatkan informasi upload file
        $config['upload_path'] = './uploads/blanko/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|webp|pdf|docx';
        $config['max_size'] = 4096;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('file')) {
            // Jika upload gagal, atur pesan validasi dan kembali ke halaman sebelumnya
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            redirect('admin/blanko');
        }

        $data_gambar = $this->upload->data();
        $gambar = $data_gambar['file_name'];
    } else {
        // Jika tidak ada file baru diupload, gunakan file yang sudah ada
        $gambar = $this->input->post('file');
    }

    $data = array(
        'nama_blanko' => $nama_blanko,
        'keterangan' => $keterangan,
        'file' => $gambar
    );

    // Menentukan kondisi WHERE untuk proses update
    $where = array('id_blanko' => $id_blanko);

    // Memanggil model untuk update data
    $updated = $this->M_blanko->update_data('blanko', $data,  $where);

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

    redirect('admin/blanko');
}

public function delete_data_aksi($id_blanko)
{
    // Menentukan kondisi WHERE untuk proses delete
    $where = array('id_blanko' => $id_blanko);

    // Memanggil model untuk delete data
    $deleted = $this->db->delete('blanko', $where);

    if ($deleted) {
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data berhasil dihapus!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
    } else {
        $this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal menghapus data.</strong> Silakan coba lagi nanti.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
    }

    redirect('admin/blanko');
}


}