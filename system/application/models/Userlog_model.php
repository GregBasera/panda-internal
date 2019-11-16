<?php
class Userlog_model extends CI_Model{
  public function in($name, $token) {
    $query = $this->db->query("
      select role
      from ACCESS
      where pass = '$token';
    ");
    $result = $query->result_array();
    return $result;
  }

  public function changePass($role, $prev, $next) {
    $this->db->set('pass', $next);
    $this->db->where('role', $role);
    $this->db->where('pass', $prev);
    $this->db->update('ACCESS');

    return $this->db->affected_rows();
  }
}
