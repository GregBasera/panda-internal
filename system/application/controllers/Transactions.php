<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions extends CI_Controller {
	public function index() {
    $page['title'] = 'Transactions';

		$data['transactions'] = $this->transactions_model->getAll();
		$data['orders'] = $this->transactions_model->getRelatedOrders();
		$data['partners'] = $this->transactions_model->getPartnerIDs();

    $this->load->view('templates/header', $page);
    $this->load->view('pages/transactions-page', $data);
		$this->load->view('templates/footer');
	}
}
