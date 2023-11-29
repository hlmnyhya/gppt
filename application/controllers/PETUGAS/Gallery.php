<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Controller {
    
    public function index()
    {
        $data['title'] = "Gallery | MPP";
        $data['gallery'] = $this->M_gallery->show_data();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_petugas');
        $this->load->view('petugas/galeri', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_data_aksi()
    {
        $judul_gallery = htmlspecialchars($this->input->post('judul_gallery'));
        $deskripsi_gallery = htmlspecialchars($this->input->post('deskripsi_gallery'));
        $waktu_upload = htmlspecialchars($this->input->post('waktu_upload'));

        // Menggunakan $_FILES untuk mendapatkan informasi upload file
        $gambar_gallery = $_FILES['gambar_gallery']['name'];

        // Konfigurasi upload gambar gallery
        $config_gallery['upload_path'] = './uploads/galeri/';
        $config_gallery['allowed_types'] = 'gif|jpg|jpeg|png|webp';
        $config_gallery['max_size'] = 4096;

        $this->load->library('upload', $config_gallery);
        $this->upload->initialize($config_gallery);

        if (!$this->upload->do_upload('gambar_gallery')) {
            // Jika upload gagal, atur pesan validasi dan kembali ke halaman sebelumnya
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
        } else {
            $data_gambar = $this->upload->data();
            $gambar = $data_gambar['file_name'];

            $data = array(
                'judul_gallery' => $judul_gallery,
                'deskripsi_gallery' => $deskripsi_gallery,
                'waktu_upload' => $waktu_upload,
                'gambar_gallery' => $gambar
            );

            $inserted = $this->M_gallery->insert_data($data, 'gallery');

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

        redirect('petugas/gallery');
    }

    // Update Data Gallery
    public function update_data_aksi()
    {
        $id_gallery = $this->input->post('id_gallery');
        $judul_gallery = htmlspecialchars($this->input->post('judul_gallery'));
        $deskripsi_gallery = htmlspecialchars($this->input->post('deskripsi_gallery'));
        $waktu_upload = htmlspecialchars($this->input->post('waktu_upload'));

        // Menggunakan $_FILES untuk mendapatkan informasi upload file
        $gambar_gallery = $_FILES['gambar_gallery']['name'];

        // Konfigurasi upload gambar gallery
        $config_gallery['upload_path'] = './uploads/gallery/';
        $config_gallery['allowed_types'] = 'gif|jpg|jpeg|png|webp';
        $config_gallery['max_size'] = 4096;

        $this->load->library('upload', $config_gallery);
        $this->upload->initialize($config_gallery);

        if (!empty($gambar_gallery)) {
            if (!$this->upload->do_upload('gambar_gallery')) {
                // Jika upload gagal, atur pesan validasi dan kembali ke halaman sebelumnya
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error);
                redirect('admin/gallery');
            } else {
                $data_gambar = $this->upload->data();
                $gambar = $data_gambar['file_name'];
            }
        }

        $data = array(
            'judul_gallery' => $judul_gallery,
            'deskripsi_gallery' => $deskripsi_gallery,
            'waktu_upload' => $waktu_upload,
        );

        if (!empty($gambar)) {
            $data['gambar_gallery'] = $gambar;
        }

        $where = array('id_gallery' => $id_gallery);
        $updated = $this->M_gallery->update_data('gallery', $data, $where);

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

        redirect('petugas/gallery');
    }

    // Hapus Data Gallery
    public function delete_data_aksi($id_gallery)
    {
        $where = array('id_gallery' => $id_gallery);
        $this->M_gallery->delete_data($where, 'gallery');
        redirect('petugas/gallery');
    }
}
