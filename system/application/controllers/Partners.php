<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partners extends CI_Controller {
	public function index() {
    $page['title'] = 'Partners';

    $this->load->view('templates/header', $page);
    $this->load->view('pages/partners-page');
		$this->load->view('templates/footer');
	}
}
