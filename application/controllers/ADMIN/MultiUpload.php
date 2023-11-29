<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MultiUpload extends CI_Controller {
public function upload_berkas()
{
    $upload_path = './uploads/berkas/';
    $config['upload_path'] = $upload_path;
    $config['allowed_types'] = 'gif|jpg|png|pdf';
    $config['encrypt_name'] = TRUE;

    $this->load->library('upload', $config);

    if ($this->upload->do_upload('userFile')) {
        $file_data = $this->upload->data();

        $data = array(
            'token' => $this->input->post('token'),
            'file' => $file_data['file_name']
        );

        $this->db->insert('upload', $data);

        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('error' => $this->upload->display_errors()));
    }
}
public function remove_berkas()
{
    $token = $this->input->post('token');
    $data = $this->db->get_where('upload', ['token' => $token]);

    if ($data->num_rows() > 0) {
        $row = $data->row();
        $berkas = $row->file;

        if (file_exists(FCPATH . "uploads/berkas/" . $berkas)) {
            unlink(FCPATH . "uploads/berkas/" . $berkas);
        }

        $this->db->delete('upload', ['token' => $token]);
        $this->output->set_content_type('application/json')->set_output(json_encode(array('success' => true)));
    } else {
        $this->output->set_content_type('application/json')->set_output(json_encode(array('error' => 'File not found')));
    }
}
}