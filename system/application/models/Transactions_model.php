<?php
class Transactions_model extends CI_Model{
  public function getAll() {
    $query = $this->db->query("
      select t.transaction_ID, t.date_encoded, t.order_number, t.encoded_by, t.transaction_date, t.customer_fname, t.customer_lname, t.customer_contact,
      t.delivery_address, t.landmark_directions, p.partner_name, t.subtotal, t.delivery_charge, t.total_transaction_price
      from TRANSACTIONS t, PARTNERS p
      where t.partner_ID = p.partner_ID
      order by t.transaction_date desc, t.order_number desc;
    ");
    $result = $query->result_array();
    return $result;
  }

  public function getRelatedOrders() {
    $query = $this->db->query("
      select *
      from ORDERS o, TRANSACTIONS t
      where t.transaction_ID = o.transaction_ID;
    ");
    $result = $query->result_array();
    return $result;
  }

  public function getPartnerIDs() {
    $query = $this->db->query("
      select partner_ID, partner_name
      from PARTNERS;
    ");
    $result = $query->result_array();
    return $result;
  }

  public function addTransaction($data) {
    $this->db->insert('TRANSACTIONS', $data);
  }

  public function addOrder($data) {
    $this->db->insert('ORDERS', $data);
  }

  public function printThis($q) {
    $query = $this->db->query($q);
    $result = $query->result_array();
    return $result;
  }

  public function withThis($q) {
    $query = $this->db->query($q);
    $result = $query->result_array();
    return $result;
  }

  public function andThis($q) {
    $query = $this->db->query($q);
    $result = $query->result_array();
    return $result;
  }

  public function getPrev($date, $kind) {
    if ($kind == 'daily') {
      $query = $this->db->query("
        select 'Last Day`s Sales' as 'title', date_format(date_sub('$date', interval 1 day), '%M %d, %Y') as date, sum(total_transaction_price) as previous
        from TRANSACTIONS
        where transaction_date like (select concat(date_sub('$date', interval 1 day), '%'));
      ");
    } elseif ($kind == 'monthly') {
      $query = $this->db->query("
        select 'Last Month`s Sales' as 'title', date_format(date_sub('$date', interval 1 month), '%M %Y') as date, sum(total_transaction_price) as previous
        from TRANSACTIONS
        where transaction_date like (select concat(date_sub('$date', interval 1 month), '%'));
      ");
    } elseif ($kind == 'yearly') {
      $query = $this->db->query("
        select 'Last Year`s Sales' as 'title', date_format(date_sub('$date', interval 1 year), '%Y') as date, sum(total_transaction_price) as previous
        from TRANSACTIONS
        where transaction_date like (select concat(date_sub('$date', interval 1 year), '%'));
      ");
    }

    $result = $query->result_array();
    return $result;
  }
}
