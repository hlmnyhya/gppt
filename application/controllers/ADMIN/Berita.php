<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends CI_Controller {
    
	public function index()
	{
		$data['title'] = "Berita | MPP";
        $data['berita'] = $this->M_berita->show_data();
        $this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar');
		$this->load->view('admin/berita',$data);
		$this->load->view('templates/footer');

	}
    public function tambah_data_aksi()
{
    $judul_berita = htmlspecialchars($this->input->post('judul_berita'));
    $isi_berita = htmlspecialchars($this->input->post('isi_berita'));
    $waktu_publikasi = htmlspecialchars($this->input->post('waktu_publikasi'));
    $penulis = htmlspecialchars($this->input->post('penulis'));

    // Menggunakan $_FILES untuk mendapatkan informasi upload file
    $gambar_berita = $_FILES['gambar_berita']['name'];

    // Konfigurasi upload gambar berita
    $config_berita['upload_path'] = './uploads/berita/';
    $config_berita['allowed_types'] = 'gif|jpg|jpeg|png|webp';
    $config_berita['max_size'] = 4096;

    $this->load->library('upload', $config_berita);
    $this->upload->initialize($config_berita);

    if (!$this->upload->do_upload('gambar_berita')) {
        // Jika upload gagal, atur pesan validasi dan kembali ke halaman sebelumnya
        $error = $this->upload->display_errors();
        $this->session->set_flashdata('error', $error);
    } else {
        $data_gambar = $this->upload->data();
        $gambar = $data_gambar['file_name'];

        $data = array(
            'judul_berita' => $judul_berita,
            'isi_berita' => $isi_berita,
            'waktu_publikasi' => $waktu_publikasi,
            'penulis' => $penulis,
            'gambar_berita' => $gambar
        );

        $inserted = $this->M_berita->insert_data($data, 'berita');

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

    redirect('admin/berita');
}

public function update_data_aksi()
{
    $id_berita = $this->input->post('id_berita');
    $judul_berita = htmlspecialchars($this->input->post('judul_berita'));
    $isi_berita = htmlspecialchars($this->input->post('isi_berita'));
    $waktu_publikasi = htmlspecialchars($this->input->post('waktu_publikasi'));
    $penulis = htmlspecialchars($this->input->post('penulis'));

     // Menggunakan $_FILES untuk mendapatkan informasi upload file
    $gambar_berita = $_FILES['gambar_berita']['name'];

    // Konfigurasi upload gambar berita
    $config_berita['upload_path'] = './uploads/berita/';
    $config_berita['allowed_types'] = 'gif|jpg|jpeg|png|webp';
    $config_berita['max_size'] = 4096;

    $this->load->library('upload', $config_berita);
    $this->upload->initialize($config_berita);

    if (!empty($gambar_berita)) {
        if (!$this->upload->do_upload('gambar_berita')) {
            // Jika upload gagal, atur pesan validasi dan kembali ke halaman sebelumnya
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            redirect('admin/berita');
        } else {
            $data_gambar = $this->upload->data();
            $gambar = $data_gambar['file_name'];
        }
    }

    $data = array(
        'judul_berita' => $judul_berita,
        'isi_berita' => $isi_berita,
        'waktu_publikasi' => $waktu_publikasi,
        'penulis' => $penulis,
    );

    if (!empty($gambar)) {
        $data['gambar_berita'] = $gambar;
    }

    $where = array('id_berita' => $id_berita);
    $updated = $this->M_berita->update_data('berita', $data, $where);

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

    redirect('admin/berita');
}

// Hapus Data Berita
public function delete_data_aksi($id_berita)
{
    $where = array('id_berita' => $id_berita);
    $this->M_berita->delete_data($where, 'berita');
    redirect('admin/berita');
}

}