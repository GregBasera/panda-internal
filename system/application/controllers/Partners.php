<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partners extends CI_Controller {
	public function __construct() {
    parent::__construct();
		if(isset($_SESSION['role'])) {
			if ($_SESSION['role'] != 'staff') {
				redirect('userlog/view', 'refresh');
			}
		} else {
			redirect('userlog/view', 'refresh');
		}
	}

	public function index() {
    $page['title'] = 'Partners';
		$page['user'] = $_SESSION['user'];

		$data['partners'] = $this->partners_model->getAllPartners();

    $this->load->view('templates/header', $page);
    $this->load->view('pages/partners-page', $data);
		$this->load->view('templates/footer');
	}

	public function addPartner() {
		$partnerData = array(
			'partner_ID' => uniqid('pt'),
			'partner_name' => $this->input->post('p_name'),
	    'partner_address' => $this->input->post('p_address'),
	    'partner_contact' => $this->input->post('p_contact'),
	    'partner_email' => $this->input->post('p_email'),
	    'owner_name' => $this->input->post('o_name'),
	    'owner_contact' => $this->input->post('o_contact'),
	    'owner_email' => $this->input->post('o_email'),
			'contract_percentage' => $this->input->post('p_percentage'),
	    'contract_execution' => $this->input->post('p_execution')
		);

		$this->partners_model->addPartner($partnerData);
	}

	public function p_delete() {
		$p_id = $this->input->post('p_id');
		$this->partners_model->deletePartner($p_id);
	}
}
