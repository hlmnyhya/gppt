<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BlankoPage extends CI_Controller {
    
    public function index()
    {
        $data['title'] = "Blanko | MPP";
        $data['blanko'] = $this->M_blanko->show_data();
        $this->load->view('blanko', $data);
    }

}
?>
