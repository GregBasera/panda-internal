<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userlog extends CI_Controller {
  public function view($error = '') {
    $page['title'] = "Sign-in";

    $data['error'] = $error;

    $this->load->view('templates/header', $page);
    $this->load->view('pages/login-page', $data);
    $this->load->view('templates/footer');
  }

  public function signin() {
    $name = $this->input->post('name');
    $token = sha1($this->input->post('token'));

    $verd = $this->userlog_model->in($name, $token);

    if($verd == 'staff') {
      $_SESSION['user'] = $name;
      $_SESSION['role'] = $verd;

      redirect('transactions/view');
    } else {
      $this->view('e');
    }
  }

  public function signout() {
    $_SESSION['user'] = '';
    $_SESSION['role'] = '';

    $this->view();
  }
}
