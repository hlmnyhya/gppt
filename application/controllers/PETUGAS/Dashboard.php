<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
	public function index()
	{
		$data['title'] = "Dashboard | MPP";
        $this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar_petugas');
		$this->load->view('petugas/dashboard',$data);
		$this->load->view('templates/footer');

	}
}
