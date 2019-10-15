<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions extends CI_Controller {
	public function index() {
    $page['title'] = 'Transactions';

    $this->load->view('templates/header', $page);
    $this->load->view('pages/transactions-page');
		$this->load->view('templates/footer');
	}
}
