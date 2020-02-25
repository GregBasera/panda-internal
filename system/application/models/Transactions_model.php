<?php
class Transactions_model extends CI_Model{
  public function getAll($portion) {
    // print_r(array_keys($portion));
    $portionMinKey = array_keys($portion)[0];
    $portionMaxKey = array_keys($portion)[count($portion)-1];
    // echo $portionMinKey.$portionMaxKey;
    $inClause = '';
    for($q = $portionMinKey; $q <= $portionMaxKey; $q++){
      $inClause = $inClause . "'" . $portion[$q]['transaction_ID'] . "', ";
    }
    $inClause = rtrim($inClause, ", ");

    $query = $this->db->query("
      select t.transaction_ID, t.date_encoded, t.encoded_by, t.order_number, t.dispatched_by, t.transaction_date, t.customer_fname, t.customer_lname, t.customer_contact,
      t.delivery_address, t.landmark_directions, p.partner_name, t.subtotal, t.delivery_charge, t.total_transaction_price, t.isDelivered
      from TRANSACTIONS t, PARTNERS p
      where t.transaction_ID in ($inClause)
      and t.partner_ID = p.partner_ID
      order by t.transaction_date desc, t.order_number desc;
    ");
    $result = $query->result_array();
    return $result;
  }

  public function getAllIDs() {
    $query = $this->db->query("
      select t.transaction_ID
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
      from PARTNERS
      order by partner_name;
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

  public function getPrev($date, $kind) {
    if ($kind == 'daily') {
      $query = $this->db->query("
        select 'Last Day`s Sales' as 'title', date_format(date_sub('$date', interval 1 day), '%M %d, %Y') as date, sum(subtotal) as previous, sum(delivery_charge) as dCharge, sum(total_transaction_price) as prevTotal
        from TRANSACTIONS
        where transaction_date like (select concat(date_sub('$date', interval 1 day), '%'));
      ");
    } elseif ($kind == 'monthly') {
      $query = $this->db->query("
        select 'Last Month`s Sales' as 'title', date_format(date_sub('$date', interval 1 month), '%M %Y') as date, sum(subtotal) as previous, sum(delivery_charge) as dCharge, sum(total_transaction_price) as prevTotal
        from TRANSACTIONS
        where transaction_date like (select concat(date_sub('$date', interval 1 month), '%'));
      ");
    } elseif ($kind == 'yearly') {
      $query = $this->db->query("
        select 'Last Year`s Sales' as 'title', date_format(date_sub('$date', interval 1 year), '%Y') as date, sum(subtotal) as previous, sum(delivery_charge) as dCharge, sum(total_transaction_price) as prevTotal
        from TRANSACTIONS
        where transaction_date like (select concat(date_sub('$date', interval 1 year), '%'));
      ");
    }

    $result = $query->result_array();
    return $result;
  }

  public function deleteTransaction($id) {
    $this->db->delete('TRANSACTIONS', array('transaction_ID' => $id));
  }

  public function search($like) {
    $query = $this->db->query("
      select t.transaction_ID, t.date_encoded, t.encoded_by, t.order_number, t.dispatched_by, t.transaction_date,
      t.customer_fname, t.customer_lname, t.customer_contact, t.delivery_address, t.landmark_directions,
      p.partner_name, t.subtotal, t.delivery_charge, t.total_transaction_price, t.isDelivered
      from TRANSACTIONS t, PARTNERS p
      where t.partner_ID = p.partner_ID
      and concat(t.date_encoded, t.encoded_by, t.order_number, t.dispatched_by, t.transaction_date, t.customer_fname,
      t.customer_lname, t.customer_contact, t.delivery_address, t.landmark_directions, p.partner_name, t.subtotal,
      t.delivery_charge, t.total_transaction_price, t.isDelivered) like '$like';
    ");
    $result = $query->result_array();
    return $result;
  }

  public function forEdit($id) {
    $query = $this->db->query("
      select * from TRANSACTIONS where transaction_ID = '$id';
    ");
    $result = $query->result_array();
    return $result;
  }

  public function edit($data) {
    $this->db->set('transaction_date', $data['transaction_date']);
    $this->db->set('customer_fname', $data['customer_fname']);
    $this->db->set('customer_lname', $data['customer_lname']);
    $this->db->set('customer_contact', $data['customer_contact']);
    $this->db->set('delivery_address', $data['delivery_address']);
    $this->db->set('landmark_directions', $data['landmark_directions']);
    $this->db->set('partner_ID', $data['partner_ID']);
    $this->db->set('order_number', $data['order_number']);
    $this->db->set('dispatched_by', $data['dispatched_by']);
    $this->db->set('isDelivered', $data['isDelivered']);
    $this->db->where('transaction_ID', $data['transaction_ID']);
    $this->db->update('TRANSACTIONS');
  }
}
