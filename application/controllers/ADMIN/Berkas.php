<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Berkas extends CI_Controller {

	public function index()
	{
		$data['title'] = "Permohonan | MPP";
        $data['permohonan'] = $this->M_permohonan->show_data();
        $data['layanan'] = $this->M_layanan->show_data();
        $data['detaillayanan'] = $this->M_DetailLayanan->show_data();
        $this->load->view('admin/permohonan/partials/header',$data);
		$this->load->view('templates/sidebar');
		$this->load->view('admin/permohonan/permohonan',$data);
		$this->load->view('admin/permohonan/partials/footer');

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

public function delete_file() {
        // Check if it's an AJAX request
        if ($this->input->is_ajax_request()) {
            $id_permohonan = $this->input->post('id_permohonan');
            $fileId = $this->input->post('fileId');

            // Perform the file deletion in the model
            $deleteResult = $this->M_syarat->deleteFile($id_permohonan, $fileId);

            // Prepare the JSON response
            $response = array('success' => $deleteResult);

            // Send the JSON response
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode($response));
        } else {
            show_404(); // Return a 404 response if it's not an AJAX request
        }
    }

    public function delete_berkas($id_berkas)
    {
        $where = array('id_berkas' => $id_berkas);
        $this->M_gallery->delete_data($where, 'berkas');
        redirect('admin/permohonan');
    }

}
