<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    
    public function index()
    {
        $data['title'] = "Users | MPP";
        $data['users'] = $this->M_users->show_data();
        $data['level'] = $this->M_users->tampil_level();
        $data['instansi'] = $this->M_users->tampil_instansi();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_petugas');
        $this->load->view('petugas/users', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_data_aksi()
{
    $nama = htmlspecialchars($this->input->post('nama'));
    $username = htmlspecialchars($this->input->post('username'));
    $password = md5($this->input->post('password'));
    $email = htmlspecialchars($this->input->post('email'));
    $nomor_telepon = htmlspecialchars($this->input->post('nomor_telepon'));
    $id_level = htmlspecialchars($this->input->post('id_level'));
    $id_instansi = htmlspecialchars($this->input->post('id_instansi'));

    // Menggunakan $_FILES untuk mendapatkan informasi upload file
    $gambar_user = $_FILES['gambar_user']['name'];

    // Konfigurasi upload gambar user
    $config_user['upload_path'] = './uploads/users/';
    $config_user['allowed_types'] = 'gif|jpg|jpeg|png|webp';
    $config_user['max_size'] = 4096;

    $this->load->library('upload', $config_user);
    $this->upload->initialize($config_user);

    if (!$this->upload->do_upload('gambar_user')) {
        // Jika upload gagal, atur pesan validasi dan gambar default
        $error = $this->upload->display_errors();
        $this->session->set_flashdata('error', $error);

        // Set gambar default
    $gambar = './uploads/users/users.png';

    } else {
        $data_gambar = $this->upload->data();
        $gambar = $data_gambar['file_name'];
    }

    $data = array(
        'nama' => $nama,
        'username' => $username,
        'password' => $password,
        'email' => $email,
        'nomor_telepon' => $nomor_telepon,
        'id_level' => $id_level,
        'id_instansi' => $id_instansi,
        'gambar_user' => $gambar
    );

    $inserted = $this->M_users->insert_data($data, 'users');

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

    redirect('petugas/users');
}


// Update Data User
public function update_data_aksi()
{
    $id_user = $this->input->post('id_user');
    $nama = htmlspecialchars($this->input->post('nama'));
    $username = htmlspecialchars($this->input->post('username'));
    $password = md5($this->input->post('password'));
    $email = htmlspecialchars($this->input->post('email'));
    $nomor_telepon = htmlspecialchars($this->input->post('nomor_telepon'));
    $id_level = htmlspecialchars($this->input->post('id_level'));
    $id_instansi = htmlspecialchars($this->input->post('id_instansi'));

    // Menggunakan $_FILES untuk mendapatkan informasi upload file
    $gambar_user = $_FILES['gambar_user']['name'];

    // Konfigurasi upload gambar user
    $config_user['upload_path'] = './uploads/users/';
    $config_user['allowed_types'] = 'gif|jpg|jpeg|png|webp';
    $config_user['max_size'] = 4096;

    $this->load->library('upload', $config_user);
    $this->upload->initialize($config_user);

    // Set gambar default
    $gambar = './uploads/users/users.png';

    if (!empty($gambar_user)) {
        if (!$this->upload->do_upload('gambar_user')) {
            // Jika upload gagal, atur pesan validasi dan kembali ke halaman sebelumnya
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            redirect('admin/users');
        } else {
            $data_gambar = $this->upload->data();
            $gambar = $data_gambar['file_name'];
        }
    }

    $data = array(
        'nama' => $nama,
        'username' => $username,
        'email' => $email,
        'nomor_telepon' => $nomor_telepon,
        'id_level' => $id_level,
    );

    // Hanya memperbarui password jika password baru disediakan
    if (!empty($password)) {
        $data['password'] = $password;
    }

    if (!empty($id_instansi)) {
        $data['id_instansi'] = $id_instansi;
    }

    // Hanya memperbarui gambar jika gambar baru diunggah
    if (!empty($gambar)) {
        $data['gambar_user'] = $gambar;
    }

    $where = array('id_user' => $id_user);
    $updated = $this->M_users->update_data('users', $data, $where);

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

    redirect('petugas/users');
}

    // Hapus Data User
    public function delete_data_aksi($id_user)
    {
        $where = array('id_user' => $id_user);
        $this->M_users->delete_data($where, 'users');
        redirect('petugas/users');
    }
}
