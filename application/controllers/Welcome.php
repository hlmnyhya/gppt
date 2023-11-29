<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$data['instansi'] = $this->M_instansi->show_data();
		$data['gallery'] = $this->M_gallery->show_data();
		$data['berita'] = $this->M_berita->show_data();
		$this->load->view('welcome_message',$data);
	}

	public function detail_instansi($id_instansi)
	{
    $data['instansi'] = $this->M_count->get_instansi_with_related_data($id_instansi);

    $this->load->view('detail_instansi', $data);
	}
	public function detail_layanan($id_layanan)
	{
    $data['layanan'] = $this->M_count->get_layanan_with_related_data($id_layanan);

    $this->load->view('detail_layanan', $data);
	}
	public function detail_layanan_detail($id_layanan_detail)
	{
    $data['layanandetail'] = $this->M_count->get_layanan_detail_with_related_data($id_layanan_detail);
    $data['syarat'] = $this->M_count->get_syarat_by_layanan_detail($id_layanan_detail); // Add this line to fetch syarat data
    $this->load->view('detail_layanan_detail', $data);
	}


	
}
