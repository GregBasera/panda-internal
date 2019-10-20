<?php
class Partners_model extends CI_Model{
  public function getAllPartners() {
    $query = $this->db->query("
      select * from PARTNERS;
    ");
    $result = $query->result_array();
    return $result;
  }

  public function addPartner($data) {
    $this->db->insert('PARTNERS', $data);
  }
}
