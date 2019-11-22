<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Analytics extends CI_Controller {
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

  public function index() {
    $page['title'] = 'Analytics';
		$page['user'] = $_SESSION['user'];
		$page['role'] = $_SESSION['role'];

    $this->load->view('templates/header', $page);
    $this->load->view('pages/analytics-page');
    $this->load->view('templates/footer');
  }

  public function varsForDailyTran() {
    echo json_encode($this->analytics_model->getForDailyTrans());
  }

  public function varsForTop20() {
    echo json_encode($this->analytics_model->getForTop20());
  }

  public function varsForPerBarang() {
    echo json_encode($this->analytics_model->getForPerBarang());
  }
}
