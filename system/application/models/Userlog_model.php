<?php
class Userlog_model extends CI_Model{
  public function in($name, $token) {
    if($token == 'e8e3f0a15f04acca5ab2b84f1bf3eac7b6f09f86') {
      return 'staff';
    } else {
      return 'unauthorized';
    }
  }
}
