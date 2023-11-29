<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Berkas extends CI_Controller {

	public function index()
	{
		$data['title'] = "Permohonan | MPP";
        $data['permohonan'] = $this->M_permohonan->show_data();
        $data['layanan'] = $this->M_layanan->show_data();
        $data['detaillayanan'] = $this->M_DetailLayanan->show_data();
        $this->load->view('petugas/permohonan/partials/header',$data);
		$this->load->view('templates/sidebar_petugas');
		$this->load->view('petugas/permohonan/tambah_permohonan',$data);
		$this->load->view('petugas/permohonan/partials/footer');

	}

   public function proses_upload()
{
    $config['upload_path'] = './uploads/berkas';
    $config['allowed_types'] = 'gif|jpg|png|pdf';
    $config['max_size'] = 2048; // Set the maximum file size in kilobytes (2 MB in this example)

    $this->load->library('upload', $config);
    $this->upload->initialize($config);

    if ($this->upload->do_upload('userFile')) {
        $file_data = $this->upload->data();

        $data = array(
            'id_permohonan' => $this->input->post('id_permohonan'),
            'token' => $this->input->post('token'),
            'file' => $file_data['file_name']
        );

        $this->db->insert('berkas', $data);

        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('error' => $this->upload->display_errors()));
    }
}


public function remove_berkas()
{
    $token = $this->input->post('token');

    $data = $this->db->get_where('berkas', ['token' => $token]);

    if ($data->num_rows() > 0) {
        $row = $data->row();
        $berkas = $row->file;

        if (file_exists(FCPATH . "uploads/berkas/" . $berkas)) {
            unlink(FCPATH . "uploads/berkas/" . $berkas);
        }

        $this->db->delete('berkas', ['token' => $token]);

        $this->db->trans_complete(); // Complete database transaction

        $this->output->set_content_type('application/json')->set_output(json_encode(array('success' => true)));
    } else {
        $this->db->trans_rollback(); // Rollback the transaction in case of an error
        $this->output->set_content_type('application/json')->set_output(json_encode(array('error' => 'File not found')));
    }
}

}
