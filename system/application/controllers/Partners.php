<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partners extends CI_Controller {
	public function index() {
    $page['title'] = 'Partners';

		$data['partners'] = $this->partners_model->getAllPartners();

    $this->load->view('templates/header', $page);
    $this->load->view('pages/partners-page', $data);
		$this->load->view('templates/footer');
	}
}
