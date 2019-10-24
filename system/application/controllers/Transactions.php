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
		$columns = $this->input->post('columns');
		$select = 't.transaction_ID, ';
		for($q = 0; $q < sizeof($columns); $q++) {
			if($columns[$q] != ''){
				$select = $select.$columns[$q].', ';
			} else {
				$select = $select."'Order(s)', ";
			}
		}
		$select = substr($select, 0, strlen($select)-2);

		$kind = $this->input->post('kind');

		$partner = $this->input->post('partner');
		$where = ($partner != '') ? " and t.partner_ID = '".$partner."'" : '';
		$ps = $this->transactions_model->getPartnerIDs();
		foreach ($ps as $p) {
			if ($p['partner_ID'] == $partner) {
				$data['partner_name'] = $p['partner_name'];
			}
		}

		if($kind == 'daily'){
			$mods = $this->input->post('dailyMod');
			$data['isDefault'] = ($mods == '') ? true : false;
			$where = $where." and t.transaction_date like '".$mods."%'";

			$data['kind'] = 'Daily Sales Report';
			$data['titleSupport'] = 'for the date '.date('M d, Y', strtotime($mods));
		} elseif ($kind == 'monthly') {
			$mods = $this->input->post('monthlyMod');
			$data['isDefault'] = ($mods == '') ? true : false;
			$where = $where." and t.transaction_date like '".substr($mods, 0, strlen($mods)-3)."%'";

			$data['kind'] = 'Monthly Sales Report';
			$data['titleSupport'] = 'for the month and year '.date('F Y', strtotime(substr($mods, 0, strlen($mods)-3)));
		} elseif ($kind == 'yearly') {
			$mods = $this->input->post('yearlyMod');
			$data['isDefault'] = ($mods == '') ? true : false;
			$where = $where." and t.transaction_date like '".$mods."%'";

			$data['kind'] = 'Yearly Sales Report';
			$data['titleSupport'] = 'for the year '.$mods;
		}

		$order['def'] = $this->input->post('orderDefined');
		$order['ordby'] = $this->input->post('order');
		$orderby = '';
		for($q = 0; $q < sizeof($order['def']); $q++) {
			$orderby = $orderby.$order['def'][$q]." ".$order['ordby'].", ";
		}
		$orderby = substr($orderby, 0, strlen($orderby)-2);

		$query = 'select '.$select.' from TRANSACTIONS t, PARTNERS p where t.partner_ID = p.partner_ID'.$where.' order by '.$orderby.';';
		$ordersQuery = 'select t.transaction_ID, o.quantity, o.item_name, o.price from TRANSACTIONS t, ORDERS o where t.transaction_ID = o.transaction_ID '.$where.';';
		$totals = "select count(t.transaction_ID) as 'Number of Transactions', sum(t.total_transaction_price) as 'Total' from TRANSACTIONS t, PARTNERS p where t.partner_ID = p.partner_ID ".$where.';';


		$data['transactions'] = $this->transactions_model->printThis($query);
		$data['orders'] = $this->transactions_model->withThis($ordersQuery);
		$data['totals'] = $this->transactions_model->andThis($totals);

		$this->load->view('statics/print-page', $data);
		// echo $query.'<br>';
		// echo $ordersQuery.'<br>';
		// echo $totals.'<br>';
	}
}
