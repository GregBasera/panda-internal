<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions extends CI_Controller {
	public function __construct() {
    parent::__construct();
		if(isset($_SESSION['role'])) {
			if ($_SESSION['role'] != 'Staff') {
				redirect('userlog/view', 'refresh');
			}
		} else {
			redirect('userlog/view', 'refresh');
		}
	}

	public function view($p = 1, $searRes = null) {
		$page['title'] = ($searRes) ? 'Search Results' : 'Transactions';
		$page['user'] = $_SESSION['user'];
    $page['role'] = $_SESSION['role'];

		$data['name'] = $_SESSION['user'];
		$allT = ($searRes) ? $searRes : $this->transactions_model->getAllIDs();
		$data['hasRes'] = (is_array($searRes) && sizeof($searRes) == 0) ? false : true;
		$data['pages'] = ceil(sizeof($allT)/25);
		$data['act_page'] = $p;
		$data['transactions'] = ($searRes) ? $allT : $this->transactions_model->getAll(array_slice($allT, ($p-1)*25, 25, true));
		$data['onRecord'] = sizeof($allT);
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
		  'encoded_by' => $t['t_encoded_by'],
			'dispatched_by' => $t['t_dispatched_by'],
		  'transaction_date' => $t['t_datetime'],
		  'customer_fname' => $t['c_fname'],
		  'customer_lname' => $t['c_lname'],
		  'customer_contact' => $t['c_contact'],
		  'delivery_address' => $t['c_address'],
		  'landmark_directions' => $t['c_directions'],
		  'partner_ID' => $t['t_partner'],
		  'subtotal' => $t['t_subtotal'],
		  'delivery_charge' => $t['t_dcharge'],
			'total_transaction_price' => $t['t_grandT'],
		  'isDelivered' => ($t['t_isDelivered'] == 'true') ? true : false
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
			$data['prev'] = $this->transactions_model->getPrev($mods, $kind);
			$data['curr'] = array(
				'possessive' =>  "Day's",
				'date' => date('M d, Y', strtotime($mods))
			);
		} elseif ($kind == 'monthly') {
			$mods = $this->input->post('monthlyMod');
			$data['isDefault'] = ($mods == '') ? true : false;
			$where = $where." and t.transaction_date like '".substr($mods, 0, strlen($mods)-3)."%'";

			$data['kind'] = 'Monthly Sales Report';
			$data['titleSupport'] = 'for the month and year '.date('F Y', strtotime(substr($mods, 0, strlen($mods)-3)));
			$data['prev'] = $this->transactions_model->getPrev($mods, $kind);
			$data['curr'] = array(
				'possessive' =>  "Month's",
				'date' => date('F Y', strtotime(substr($mods, 0, strlen($mods)-3)))
			);
		} elseif ($kind == 'yearly') {
			$mods = $this->input->post('yearlyMod');
			$data['isDefault'] = ($mods == '') ? true : false;
			$where = $where." and t.transaction_date like '".$mods."%'";

			$data['kind'] = 'Yearly Sales Report';
			$data['titleSupport'] = 'for the year '.$mods;
			$data['prev'] = $this->transactions_model->getPrev($mods.'-01-01', $kind);
			$data['curr'] = array(
				'possessive' =>  "Year's",
				'date' => $mods
			);
		}

		if($this->input->post('delivered') != 'all') {
			if ($this->input->post('isDelivered') == 'on') {
				$where = $where.'and t.isDelivered = true';
			} else {
				$where = $where.'and t.isDelivered = false';
			}
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
		$blankTotals = "select count(t.transaction_ID) as 'Number of Transactions', sum(t.subtotal) as 'Total', sum(t.delivery_charge) as dCharge, sum(t.total_transaction_price) as prevTotal from TRANSACTIONS t, PARTNERS p where t.partner_ID = p.partner_ID ".$where.';';
		$partnerTotals = "select avg(p.contract_percentage) as 'contract', sum(t.subtotal) * avg(p.contract_percentage) as 'service_fee' from TRANSACTIONS t, PARTNERS p where t.partner_ID = p.partner_ID ".$where.';';


		$data['company'] = $this->input->post('company');
		$data['addr1'] = $this->input->post('addr1');
		$data['addr2'] = $this->input->post('addr2');
		$data['company_email'] = $this->input->post('company_email');
		$data['company_contact'] = $this->input->post('company_contact');
		$data['summaries'] = array(
			'subSum' => ($this->input->post('subSum') ? true : false),
			'chaSum' => ($this->input->post('chaSum') ? true : false),
			'totSum' => ($this->input->post('totSum') ? true : false),
			'sumContract' => ($this->input->post('sumContract') ? true : false)
		);
		$data['transactions'] = $this->transactions_model->printThis($query);
		$data['orders'] = $this->transactions_model->printThis($ordersQuery);
		$data['blankTotals'] = $this->transactions_model->printThis($blankTotals);
		$data['partnerTotals'] = $this->transactions_model->printThis($partnerTotals);
		$data['prepby'] = $this->input->post('prepby');
		$data['posi'] = $this->input->post('posi');

		$this->load->view('statics/print-page', $data);
	}

	public function t_delete() {
		$t_id = $this->input->post('t_id');
		$this->transactions_model->deleteTransaction($t_id);
	}

	public function search() {
		$s_keywords = explode(' ', $this->input->post('keyword'));
		$like = '%';

		for($q = 0; $q < sizeof($s_keywords); $q++){
			$like = $like.$s_keywords[$q].'%';
		}

		$searchResult = $this->transactions_model->search($like);

		$this->view(1, $searchResult);
	}

	public function getForEdit() {
		echo json_encode($this->transactions_model->forEdit($this->input->post('id')));
	}

	public function t_edit() {
		$data = array(
			'transaction_ID' => $this->input->post('id'),
			'transaction_date' => $this->input->post('e_t_date').' '.$this->input->post('e_t_time'),
			'customer_fname' => $this->input->post('e_c_fname'),
			'customer_lname' => $this->input->post('e_c_lname'),
			'customer_contact' => $this->input->post('e_c_contact'),
			'delivery_address' => $this->input->post('e_c_address'),
			'landmark_directions' => $this->input->post('e_c_directions'),
			'partner_ID' => $this->input->post('e_t_partner'),
			'order_number' => $this->input->post('e_t_ordernum'),
			'dispatched_by' => $this->input->post('e_t_dispatched_by'),
			'isDelivered' => ($this->input->post('e_isDelivered') == 'true') ? true : false
		);
		$this->transactions_model->edit($data);
	}

	public function multi_add() {
		$config['upload_path'] = 'assets/uploads/';
		$config['allowed_types'] = 'csv';
    $config['overwrite'] = true;
    // $config['max_size']             = 100;

    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload('csvFile')) {
	    $error = array('error' => $this->upload->display_errors());

			var_dump($error);
    }
    else {
      $data = array('upload_data' => $this->upload->data());

      var_dump($data);
    }
	}
}
