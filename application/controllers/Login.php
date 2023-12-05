<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$data['title'] = "LOGIN | GPPT";
        $this->load->view('login', $data);
    }

	public function register()
	{
		$data['title'] = "DAFTAR | GPPT";
        $this->load->view('register', $data);
    }

public function process_login()
{
    $username = $this->input->post('username');
    $password = md5($this->input->post('password'));

	
    $user = $this->M_users->cek_login($username, $password);

    if ($user) {
        // Login successful, set user data in session
        $userdata = array(
            'id_user' => $user->id_user,
            'nama' => $user->nama,
            'username' => $user->username,
            'email' => $user->email,
            'nomor_telepon' => $user->nomor_telepon,
            'id_level' => $user->id_level,
            'id_instansi' => $user->id_instansi,
            'gambar_user' => $user->gambar_user,
            'logged_in' => TRUE
        );

        $this->session->set_userdata($userdata);

        // Redirect based on user's id_level
        switch ($user->id_level) {
            case 1:
                redirect('admin/dashboard');
                break;
            case 2:
                redirect('petugas/dashboard');
                break;
            case 3:
                redirect('user/dashboard');
                break;
            case 4:
                redirect('admin/dashboard');
                break;
            case 5:
                redirect('admin/dashboard');
                break;
            default:
                // Redirect to login or error page for invalid id_level
                redirect('auth/login');
                break;
        }
    } else {
        // Login failed, redirect back to login page with error message
        $this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Username dan Password Salah.</strong> <br> Silakan coba lagi.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
        redirect('auth/login');
    }
}

public function register_proses() {
    // Validasi form
    $this->form_validation->set_rules('nik', 'NIK', 'required|numeric');
    // ... (other validation rules)

    if ($this->form_validation->run() == FALSE) {
        // Jika validasi gagal, kembali ke halaman registrasi dengan pesan error
        $this->load->view('auth/register');
    } else {
        // Jika validasi sukses, tambahkan user ke database
        $data = array(
            'nik' => $this->input->post('nik'),
            'nama' => $this->input->post('nama'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'password' => md5($this->input->post('password')),
            'nomor_telepon' => $this->input->post('nomor_telepon'),
            'id_level' => 3,
            'id_instansi' => NULL,
            'gambar_user' => NULL, // Set default value

            // Tambahkan kolom lainnya sesuai kebutuhan
        );

        // Tambahkan gambar_user jika dibutuhkan
if ($_FILES['gambar_user']['name']) {
    $config['upload_path'] = './uploads/users/';
    $config['allowed_types'] = 'jpg|jpeg|png|gif';
    $this->load->library('upload', $config);
    $this->upload->initialize($config);

    if ($this->upload->do_upload('gambar_user')) {
        $data['gambar_user'] = $this->upload->data('file_name');
    } else {
        $error = array('error' => $this->upload->display_errors());
        print_r($error);
    }
} else {
    // Set a default image path if no image is uploaded
    $data['gambar_user'] = './uploads/users/users.png';
}

// Call insert_data and store the result
$inserted = $this->M_users->insert_data($data, 'users');

// Check the result
if ($inserted) {
    $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Registrasi berhasil!</strong> Akun Anda telah dibuat. Silakan login.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>');
    redirect('auth/login');
} else {
    $this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Gagal menambahkan data.</strong> Silakan coba lagi nanti.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>   
    </div>');
    redirect('auth/register');
}

    }
}


	public function logout() {
        // Destroy session and redirect to login page
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}