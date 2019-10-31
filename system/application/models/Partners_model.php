<?php
class Partners_model extends CI_Model{
  public function getAllPartners() {
    $query = $this->db->query("
      select * from PARTNERS
      order by partner_name;
    ");
    $result = $query->result_array();
    return $result;
  }

  public function addPartner($data) {
    $this->db->insert('PARTNERS', $data);
  }

  public function deletePartner($id) {
    $this->db->delete('PARTNERS', array('partner_ID' => $id));
  }
}
