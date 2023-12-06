<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Antrian extends CI_Controller {
    
    public function index()
    {
        $data['title'] = "Antrian | MPP";
        $data['instansi'] = $this->M_instansi->show_data();
        $this->load->view('antrian', $data);
    }

    public function tambah_data()
    {
        // Mengambil data dari form
        $data = array(
            'id_instansi' => $this->input->post('id_instansi'),
            'status_antrian' => $this->input->post('status_antrian')
        );

        // Memanggil model untuk mendapatkan informasi kode
        $instansi_info = $this->M_instansi->get_instansi_by_id($data['id_instansi']);
        $kode = $instansi_info->kode;

        // Mendapatkan nomor antrian terakhir untuk instansi ini
        $last_queue_number = $this->M_antrian->get_last_queue_number($data['id_instansi']);

        // Menambahkan informasi kode dan nomor antrian ke dalam data
        $data['nomor_antrian'] = $kode . str_pad($last_queue_number + 1, 3, '0', STR_PAD_LEFT);

        // Memanggil model untuk insert data
        $this->M_antrian->insert_data('antrian', $data);

        // Redirect ke halaman utama atau halaman yang sesuai
        redirect('antrian/index');
    }

    public function update_data($id_antrian)
    {
        // Mengambil data dari form
        $data = array(
            'id_instansi' => $this->input->post('id_instansi'),
            'status_antrian' => $this->input->post('status_antrian')
        );

        // Memanggil model untuk mendapatkan informasi kode
        $instansi_info = $this->M_instansi->get_instansi_by_id($data['id_instansi']);
        $kode = $instansi_info->kode;

        // Mendapatkan nomor antrian terakhir untuk instansi ini
        $last_queue_number = $this->M_antrian->get_last_queue_number($data['id_instansi']);

        // Menambahkan informasi kode dan nomor antrian ke dalam data
        $data['nomor_antrian'] = $kode . str_pad($last_queue_number + 1, 3, '0', STR_PAD_LEFT);

        // Menentukan kondisi WHERE untuk proses update
        $where = array('id_antrian' => $id_antrian);

        // Memanggil model untuk update data
        $this->M_antrian->update_data('antrian', $data, $where);

        // Redirect ke halaman utama atau halaman yang sesuai
        redirect('antrian/index');
    }

    public function delete_data($id_antrian)
    {
        // Menentukan kondisi WHERE untuk proses delete
        $where = array('id_antrian' => $id_antrian);

        // Memanggil model untuk delete data
        $this->M_antrian->delete_data($where, 'antrian');

        // Redirect ke halaman utama atau halaman yang sesuai
        redirect('antrian/index');
    }
}
?>
