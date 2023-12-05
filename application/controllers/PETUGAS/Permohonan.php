<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permohonan extends CI_Controller {
    
	public function index()
	{
		$data['title'] = "Permohonan | MPP";
        $data['permohonan'] = $this->M_permohonan->show_data();
        $data['instansi'] = $this->M_instansi->get_all_instansi(); // Ambil data instansi
        $data['layanan'] = $this->M_layanan->get_all_layanan(); // Ambil data layanan
        $data['detaillayanan'] = $this->M_DetailLayanan->get_all_detail_layanan(); // Ambil data layanan detail
        $this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar_petugas');
		$this->load->view('petugas/permohonan/permohonan',$data);
		$this->load->view('templates/footer');
	}

    public function get_layanan_by_instansi()
    {
        $id_instansi = $this->input->post('id_instansi'); // Ambil ID instansi dari AJAX request
        $layanan = $this->M_layanan->get_layanan_by_instansi($id_instansi); // Ambil data layanan berdasarkan ID instansi
        echo json_encode($layanan); // Mengembalikan data layanan dalam format JSON
    }

    // Fungsi untuk mendapatkan layanan detail berdasarkan layanan
    public function get_detail_layanan_by_layanan()
    {
        $id_layanan = $this->input->post('id_layanan'); // Ambil ID layanan dari AJAX request
        $detail_layanan = $this->M_DetailLayanan->get_detail_layanan_by_layanan($id_layanan); // Ambil data detail layanan berdasarkan ID layanan
        echo json_encode($detail_layanan); // Mengembalikan data detail layanan dalam format JSON
    }

    public function detail_berkas($id_permohonan)
	{
		$where = array('id_permohonan' => $id_permohonan);
		$data['title'] = "Detail Berkas | MPP";
		$data['permohonan'] = $this->db->query("SELECT 
    b.*,
    p.id_permohonan,
    p.nama,
    p.id_layanan,
    p.id_layanan_detail,
    p.status_permohonan,
    l.id_layanan,
    l.id_instansi,
    l.nama_layanan,
    l.deskripsi_layanan,
    l.gambar_layanan,
    ld.id_layanan_detail,
    ld.id_layanan,
    ld.nama_layanan_detail,
    ld.deskripsi_layanan_detail,
    ld.gambar_layanan_detail
FROM 
    berkas AS b
JOIN 
    permohonan AS p ON b.id_permohonan = p.id_permohonan
JOIN 
    layanan AS l ON p.id_layanan = l.id_layanan
JOIN 
    layanan_detail AS ld ON p.id_layanan_detail = ld.id_layanan_detail
WHERE 
    p.id_permohonan = '$id_permohonan';
")->result();
         $this->load->view('petugaspetugaspetugaspetugas/permohonan/partials/header',$data);
		$this->load->view('templates/sidebar_petugas');
		$this->load->view('petugaspetugaspetugaspetugas/permohonan/detail_permohonan',$data);
		$this->load->view('petugaspetugaspetugaspetugas/permohonan/partials/footer');
	}


   public function tambah_data_aksi()
{
    $nama = $this->input->post('nama');
    $id_instansi = $this->input->post('id_instansi');
    $id_layanan = $this->input->post('id_layanan');
    $id_user = $this->session->userdata('id_user');
    $id_layanan_detail = $this->input->post('id_layanan_detail');
    $status_permohonan = $this->input->post('status_permohonan');
    $alasan = $this->input->post('alasan');

    // Insert data ke tabel 'permohonan'
    $data_permohonan = array(
        'nama' => $nama,
        'id_user' => $id_user,
        'id_instansi' => $id_instansi,
        'id_layanan' => $id_layanan,
        'id_layanan_detail' => $id_layanan_detail,
        'status_permohonan' => $status_permohonan,
        'alasan' => '',
    );

    $inserted_permohonan = $this->db->insert('permohonan', $data_permohonan);

    // Ambil nomor_antrian terakhir dari tabel 'antrian'
    $last_antrian = $this->db->select_max('nomor_antrian')->get('antrian')->row();
    $nomor_antrian = $last_antrian ? $last_antrian->nomor_antrian + 1 : 1;

    // Insert data ke tabel 'antrian'
    $data_antrian = array(
        'id_user' => $this->session->userdata('id_user'),
        'id_instansi' => $id_instansi,
        'id_layanan' => $id_layanan,
        'nomor_antrian' => $nomor_antrian,
        'status_antrian' => 'Menunggu',
    );

    $inserted_antrian = $this->db->insert('antrian', $data_antrian);

    if ($inserted_permohonan && $inserted_antrian) {
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

    redirect('petugas/permohonan');
}

// Function to get the last used nomor_antrian for a specific id_instansi
private function get_last_nomor_antrian($id_instansi)
{
    $last_nomor_antrian = $this->db->select('nomor_antrian')->where('id_instansi', $id_instansi)->get('antrian')->row();
    return $last_nomor_antrian ? $last_nomor_antrian->last_nomor_antrian : 0;
}

// Function to update the last used nomor_antrian for a specific id_instansi
private function update_last_nomor_antrian($id_instansi, $nomor_antrian)
{
    $this->db->where('id_instansi', $id_instansi)->update('antrian', array('nomor_antrian' => $nomor_antrian));
}

public function update_data_aksi($id_permohonan)
{
    $nama = $this->input->post('nama');
    $id_instansi = $this->input->post('id_instansi');
    $id_layanan = $this->input->post('id_layanan');
    $id_layanan_detail = $this->input->post('id_layanan_detail');
    $status_permohonan = $this->input->post('status_permohonan');
    $alasan = $this->input->post('alasan');

    // Update data in 'permohonan' table
    $data_permohonan = array(
        'nama' => $nama,
        'id_instansi' => $id_instansi,
        'id_layanan' => $id_layanan,
        'id_layanan_detail' => $id_layanan_detail,
        'status_permohonan' => $status_permohonan,
        'alasan' => $alasan,
    );

    $this->db->where('id_permohonan', $id_permohonan);
    $updated_permohonan = $this->db->update('permohonan', $data_permohonan);

    if ($updated_permohonan) {
        // Update successful, redirect or set flash messages accordingly
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data berhasil diperbarui!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
    } else {
        // Update failed, redirect or set flash messages accordingly
        $this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal memperbarui data.</strong> Silakan coba lagi nanti.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
    }

    redirect('petugas/permohonan');
}


public function proses_permohonan($id_permohonan)
{
    // Pastikan $id_permohonan valid
    if (!$id_permohonan) {
        // Handle kesalahan, misalnya redirect ke halaman sebelumnya atau tampilkan pesan error
        $response = array('success' => false, 'message' => 'ID permohonan tidak valid');
        echo json_encode($response);
        exit(); // Stop further execution
    }

    // Update status_permohonan ke "Di Proses"
    $data_permohonan = array(
        'status_permohonan' => 'Diproses',
        'alasan' => 'Berkas Lengkap, Permohonan Segera Diproses'
    );

    $this->db->where('id_permohonan', $id_permohonan);
    $updated_permohonan = $this->db->update('permohonan', $data_permohonan);

    if ($updated_permohonan) {
        $response = array('success' => true, 'message' => 'Status permohonan berhasil diperbarui menjadi "Di Proses"!');
    } else {
        $response = array('success' => false, 'message' => 'Gagal memperbarui status permohonan. Silakan coba lagi nanti.');
    }

    echo json_encode($response);
}


public function tolak_permohonan()
{
    // Get id_permohonan from the input
    $id_permohonan = $this->input->post('id_permohonan');

    // Pastikan $id_permohonan valid
    if (!$id_permohonan) {
        // Handle kesalahan, misalnya redirect ke halaman sebelumnya atau tampilkan pesan error
        redirect('petugas/permohonan');
    }

    // Update status_permohonan ke "Ditolak"
    $data_permohonan = array(
        'status_permohonan' => 'Ditolak',
        'alasan' => $this->input->post('alasan'),
    );

    $this->db->where('id_permohonan', $id_permohonan);
    $updated_permohonan = $this->db->update('permohonan', $data_permohonan);

    if ($updated_permohonan) {
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Status permohonan berhasil diperbarui menjadi "Ditolak"!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
    } else {
        $this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal memperbarui status permohonan.</strong> Silakan coba lagi nanti.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
    }

    redirect('petugas/permohonan');
}


public function selesai_permohonan()
{
    $id_permohonan = $this->input->post('id_permohonan');
    
    // Pastikan $id_permohonan valid
    if (!$id_permohonan) {
        // Handle kesalahan, misalnya redirect ke halaman sebelumnya atau tampilkan pesan error
        redirect('petugas/permohonan');
    }

    // Update status_permohonan ke "Selesai"
    $data_permohonan = array(
        'status_permohonan' => 'Selesai',
    );

    $this->db->where('id_permohonan', $id_permohonan);
    $updated_permohonan = $this->db->update('permohonan', $data_permohonan);

    if ($updated_permohonan) {
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Status permohonan berhasil diperbarui menjadi "Selesai"!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
    } else {
        $this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal memperbarui status permohonan.</strong> Silakan coba lagi nanti.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
    }

    redirect('petugas/permohonan');
}

public function delete_data_aksi($id_permohonan)
{
    $where = array('id_permohonan' => $id_permohonan);

    // Hapus data di tabel 'permohonan'
    $this->M_permohonan->delete_data($where, 'permohonan');

    // Hapus data di tabel 'antrian' berdasarkan id_permohonan
    $where_antrian = array('id_permohonan' => $id_permohonan);
    $this->M_antrian->delete_data($where_antrian, 'antrian');

    redirect('petugas/permohonan');
}

}

