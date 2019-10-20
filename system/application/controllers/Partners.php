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
	    'contract_percentage' => $this->input->post('p_percentage')
		);

		$this->partners_model->addPartner($partnerData);
	}
}
