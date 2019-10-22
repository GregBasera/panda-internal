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

	public function addTransaction() {
		$t = $this->input->post('t');
		$o = $this->input->post('o');

		$transactionData = array(
			'transaction_ID' => uniqid(),
		  'order_number' => $t['t_ordernum'],
		  'encoded_by' => $t['t_dispatcher'],
		  'transaction_date' => $t['t_datetime'],
		  'customer_fname' => $t['c_fname'],
		  'customer_lname' => $t['c_lname'],
		  'customer_contact' => $t['c_contact'],
		  'delivery_address' => $t['c_address'],
		  'landmark_directions' => $t['c_directions'],
		  'partner_ID' => $t['t_partner'],
		  'subtotal' => $t['t_subtotal'],
		  'delivery_charge' => $t['t_dcharge'],
		  'total_transaction_price' => $t['t_grandT']
		);

		$this->transactions_model->addTransaction($transactionData);

		for($q = 0; $q < sizeof($o); $q++) {
			$orderData = array(
				'transaction_ID' => $transactionData['transaction_ID'],
			  'item_name' => $o[$q]['i_name'],
			  'quantity' => $o[$q]['i_quantity'],
			  'price' => $o[$q]['i_price']
			);

			$this->transactions_model->addOrder($orderData);
		}
	}

	public function print() {
		$select = $this->input->post('columns');
		$kind = $this->input->post('kind');
		if($kind == 'daily'){
			$where = $this->input->post('dailyMod');
		} elseif ($kind == 'monthly') {
			$where = $this->input->post('monthlyMod');
		} elseif ($kind == 'yearly') {
			$where = $this->input->post('yearlyMod');
		} else {
			$where['name'] = $this->input->post('partnerModName');
			$where['month'] = $this->input->post('partnerModMonth');
		}
		$order['def'] = $this->input->post('orderDefined');
		$order['ordby'] = $this->input->post('order');

		// var_dump($select);
		// var_dump($kind);
		// var_dump($where);
		var_dump($order);
	}
}
