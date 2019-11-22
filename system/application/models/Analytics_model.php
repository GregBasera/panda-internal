<?php
class Analytics_model extends CI_Model{
  public function getForDailyTrans() {
    $query = $this->db->query("
      select distinct date_format(t.transaction_date, '%Y-%m-%d') as date,
      (select count(transaction_ID) from TRANSACTIONS where isDelivered = 1 and transaction_date like concat('%', date, '%')) as delivered,
      (select count(transaction_ID) from TRANSACTIONS where isDelivered = 0 and transaction_date like concat('%', date, '%')) as cancelled
      from TRANSACTIONS t
      order by date desc
      limit 30;
    ");
    $result = $query->result_array();
    return $result;
  }

  public function getForTop20() {
    // $query = $this->db->query("
    //   select distinct p.partner_name,
    //   (select count(transaction_ID) from TRANSACTIONS where partner_ID = t.partner_ID and transaction_date like concat(curdate(), '%')) as trans
    //   from TRANSACTIONS t, PARTNERS p
    //   where t.partner_ID = p.partner_ID
    //   order by trans
    //   limit 20;
    // ");
    $query = $this->db->query("
      select distinct p.partner_name,
      (select count(transaction_ID) from TRANSACTIONS where partner_ID = t.partner_ID) as trans
      from TRANSACTIONS t, PARTNERS p
      where t.partner_ID = p.partner_ID
      order by trans desc
      limit 20;
    ");
    $result = $query->result_array();
    return $result;
  }

  public function getForPerBarang() {
    $query = $this->db->query("
      select concat(delivery_address, ' ', landmark_directions) as postal
      from TRANSACTIONS;
    ");
    $result = $query->result_array();
    return $result;
  }
}
