<div class="container-fluid">
  <div class="row py-2">
    <div class="col-auto">
      <div class="container-fluid p-0 d-flex justify-content-center">
        <button class="btn btn-primary mb-2" data-toggle="modal" data-target=".add-transac-modal">
          <i class="fa fa-plus" data-toggle="tooltip" data-placement="right" title="Add a Transaction"></i>
        </button>
      </div>
      <div class="container-fluid p-0 d-flex justify-content-center">
        <button class="btn btn-success mb-2">
          <i class="fa fa-search" data-toggle="tooltip" data-placement="right" title="Search"></i>
        </button>
      </div>
      <div class="container-fluid p-0 d-flex justify-content-center">
        <button class="btn btn-dark mb-2" data-toggle="modal" data-target=".print-report-modal">
          <i class="fa fa-print" data-toggle="tooltip" data-placement="right" title="Print Report"></i>
        </button>
      </div>
    </div>
    <div class="col pl-0">
      <div class="container-fluid">
        <h2><?php echo $title ?></h2>
      </div>
      <table class="table table-bordered table-sm table-hover">
        <thead>
          <tr class="text-center">
            <!-- <th>ID</th> -->
            <th>Encoded</th>
            <th>Ord. No.</th>
            <th>Disp. by</th>
            <th>Transaction Date</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Contact</th>
            <th>Delivery Address</th>
            <th>Landmarks/Directions</th>
            <th>Partner</th>
            <th>Order</th>
            <th>Sub Total</th>
            <th>Delivery Charge</th>
            <th>Total Price</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($transactions as $transaction): ?>
            <tr class="text-center">
              <!-- <td><?php echo $transaction['transaction_ID'] ?></td> -->
              <td><?php echo date('M d, Y h:i a', strtotime($transaction['date_encoded'])) ?></td>
              <td><?php echo $transaction['order_number'] ?></td>
              <td><?php echo $transaction['encoded_by'] ?></td>
              <td><?php echo date('M d, Y h:i a', strtotime($transaction['transaction_date'])) ?></td>
              <td><?php echo $transaction['customer_fname'] ?></td>
              <td><?php echo $transaction['customer_lname'] ?></td>
              <td><?php echo substr($transaction['customer_contact'], 0, 4).'-'.substr($transaction['customer_contact'], 4, 3).'-'.substr($transaction['customer_contact'], 7) ?></td>
              <td class="text-left"><?php echo $transaction['delivery_address'] ?></td>
              <td class="text-left"><?php echo $transaction['landmark_directions'] ?></td>
              <td><?php echo $transaction['partner_name'] ?></td>
              <td>
                <span class="badge badge-success" data-toggle="popover" data-placement="right"
                  data-html="true" data-content="
                    <?php foreach ($orders as $item): ?>
                      <?php if ($item['transaction_ID'] == $transaction['transaction_ID']): ?>
                        <?php echo $item['quantity'].' -- ' ?>
                        <?php echo $item['item_name'].' -- ' ?>
                        <?php echo '<b>₱ '.$item['price'].'</b><br>' ?>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  ">
                  <i class="fa fa-shopping-cart"></i>
                </span>
              </td>
              <td>₱ <?php echo $transaction['subtotal'] ?></td>
              <td>₱ <?php echo $transaction['delivery_charge'] ?></td>
              <td>₱ <?php echo $transaction['total_transaction_price'] ?></td>
              <td>
                <span class="badge badge-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="#">
                    <i class="fa fa-pen"></i> Update/Edit
                  </a>
                  <a class="dropdown-item text-danger" href="#">
                    <i class="fa fa-trash"></i> Delete
                  </a>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Add a transaction modal -->
<div class="modal fade add-transac-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add a Transaction</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="" target="" action="" method="post" name="transaction">
        <div class="modal-body">
          <div class="row">
            <div class="col-3 pr-1">
              Transaction Date
              <input class="form-control" type="date" name="t_date" value="">
            </div>
            <div class="col-3 pl-1">
              Transaction Time
              <input class="form-control" type="time" name="t_time" value="">
            </div>

            <div class="col pr-1">
              Firstname
              <input class="form-control" type="text" name="c_fname" value="">
            </div>
            <div class="col pl-1">
              Lastname
              <input class="form-control" type="text" name="c_lname" value="">
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-4">
              Contact Number
              <input class="form-control" type="text" name="c_contact" value="">
            </div>
            <div class="col">
              Delivery Address
              <input class="form-control" type="text" name="c_address" value="">
            </div>
          </div>
          <div class="row mt-2">
            <div class="col">
              Nearby Landmarks/Specific Directions
              <input class="form-control" type="text" name="c_directions" value="">
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-4">
              Partner/Establishent
              <select class="custom-select" name="t_partner">
                <option value="">Click'n Choose</option>
                <?php foreach ($partners as $partner): ?>
                  <option value="<?php echo $partner['partner_ID'] ?>"><?php echo $partner['partner_name'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col" id="orders">
              <button class="btn badge badge-pill badge-primary" type="button" name="button" onclick="addItem();">
                <i class="fa fa-plus"></i>
              </button>
              Order/Items
              <div class="row mt-2">
                <div class="col-3 pr-1">
                  <input class="form-control form-control-sm text-center" type="number" name="i_quantity" value="" placeholder="Quantity">
                </div>
                <div class="col px-1">
                  <input class="form-control form-control-sm" type="text" name="i_name" value="" placeholder="Item Name">
                </div>
                <div class="col-2 px-1">
                  <input class="form-control form-control-sm text-center" type="text" name="i_price" value="" placeholder="Price" onkeyup="getSubtotal();getGrandT();">
                </div>
                <div class="col-auto pl-1">
                  <button class="btn btn-danger btn-sm" type="button" name="button" onclick="removeItem(this);getSubtotal();getGrandT();">
                    <i class="fa fa-times"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col pr-1">
              Sub-total
              <input class="form-control text-center" type="text" name="t_subtotal" value="" readonly>
            </div>
            <div class="col px-1">
              Delivery Charge
              <input class="form-control text-center" type="text" name="t_dcharge" value="" onkeyup="getGrandT();">
            </div>
            <div class="col px-1">
              Total Price
              <input class="form-control text-center" type="text" name="t_grandT" value="" readonly>
            </div>
            <div class="col-2 px-1">
              Order Number
              <input class="form-control text-center" type="number" name="t_ordernum" value="">
            </div>
            <div class="col pl-1">
              Dispatcher
              <input class="form-control text-center" type="text" name="t_dispatcher" value="">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="container-fluid">
            <div class="spinner-border spinner-border-sm" id="spinner"></div>
            <div class="alert alert-danger py-1 my-auto" id="transactionFormAlert"></div>
          </div>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" onclick="addTransaction();">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Print a report modal -->
<div class="modal fade print-report-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Print Report</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="" name="Print" target="_blank" action="transactions/print" method="post">
        <div class="modal-body">
          <h4 class="px-3">Columns to be printed</h4>
          <hr class="my-1">
          <div class="row mb-4">
            <div class="col-4">
              <label class="d-block"><input type="checkbox" name="columns[]" value="t.transaction_ID as 'ID'"> Transaction ID</label>
              <label class="d-block"><input type="checkbox" name="columns[]" value="t.date_encoded as 'Encoded'"> Date Encoded</label>
              <label class="d-block"><input type="checkbox" name="columns[]" value="t.order_number as 'Ord. No'" checked> Order Number</label>
              <label class="d-block"><input type="checkbox" name="columns[]" value="t.encoded_by as 'Disp. by'" checked> Encoded By</label>
              <label class="d-block"><input type="checkbox" name="columns[]" value="t.transaction_date as 'Transaction Date'" checked> Transaction Date</label>
            </div>
            <div class="col-4">
              <label class="d-block"><input type="checkbox" name="columns[]" value="t.customer_fname as 'Firstname'" checked> Customer Firstname</label>
              <label class="d-block"><input type="checkbox" name="columns[]" value="t.customer_lname as 'Lastname'" checked> Customer Lastname</label>
              <label class="d-block"><input type="checkbox" name="columns[]" value="t.customer_contact as 'Contact'" checked> Contact Number</label>
              <label class="d-block"><input type="checkbox" name="columns[]" value="t.delivery_address as 'Delivery Addresss'" checked> Delivery Address</label>
              <label class="d-block"><input type="checkbox" name="columns[]" value="t.landmark_directions as 'Landmarks/Directions'" checked> Landmarks/Directions</label>
            </div>
            <div class="col-4">
              <label class="d-block"><input type="checkbox" name="columns[]" value="p.partner_name as 'Partner'" checked> Partner</label>
              <label class="d-block"><input type="checkbox" name="columns[]" value="" checked> Order List</label>
              <label class="d-block"><input type="checkbox" name="columns[]" value="t.subtotal as 'Subtotal (₱)'" checked> Sub-Total</label>
              <label class="d-block"><input type="checkbox" name="columns[]" value="t.delivery_charge as 'D.Charge (₱)'" checked> Delivery Charge</label>
              <label class="d-block"><input type="checkbox" name="columns[]" value="t.total_transaction_price as 'Total (₱)'" checked> Transaction Total</label>
            </div>
          </div>
          <div class="row">
            <div class="col-4">
              <h4 class="px-3">Kind of report</h4>
              <hr class="my-1">
              <label class="d-block"><input type="radio" name="kind" value="daily" onclick="kindToMod();" required> Daily Report</label>
              <label class="d-block"><input type="radio" name="kind" value="monthly" onclick="kindToMod();"> Monthly Report</label>
              <label class="d-block"><input type="radio" name="kind" value="yearly" onclick="kindToMod();"> Yearly Report</label>
              <label class="d-block"><input type="radio" name="kind" value="partner" onclick="kindToMod();"> Report for a Partner</label>
            </div>
            <div class="col-4">
              <h4 class="px-3">Modifiers</h4>
              <hr class="my-1">
              <div class="container-fluid" id="dailyMod">
                Date
                <input class="form-control" type="date" name="dailyMod" value="">
                <small class="text-muted"><i>Preferred date of the report.</i></small>
              </div>
              <div class="container-fluid" id="monthlyMod">
                Month and Year
                <input class="form-control" type="date" name="monthlyMod" value="">
                <small class="text-muted"><i>Preferred month and year of the report. You can input any day of the month.</i></small>
              </div>
              <div class="container-fluid" id="yearlyMod">
                Year
                <input class="form-control" type="number" name="yearlyMod" value="" placeholder="year" min="2008">
                <small class="text-muted"><i>Preferred year of the report.</i></small>
              </div>
              <div class="container-fluid" id="partnerMod">
                Partner Name
                <select class="custom-select" name="partnerModName">
                  <option value="">Click'n Choose</option>
                  <?php foreach ($partners as $partner): ?>
                    <option value="<?php echo $partner['partner_ID'] ?>"><?php echo $partner['partner_name'] ?></option>
                  <?php endforeach; ?>
                </select>
                Month
                <input class="form-control" type="date" name="partnerModMonth" value="">
                <small class="text-muted"><i>Name of the partner and the preferred month for the report.</i></small>
              </div>
            </div>
            <div class="col-4">
              <h4 class="px-3">Order by</h4>
              <hr class="my-1">
              <label class="d-block"><input type="checkbox" name="orderDefined[]" value="t.transaction_date" checked> Transaction Date</label>
              <label class="d-block"><input type="checkbox" name="orderDefined[]" value="t.order_number" checked> Order Number</label>
              <br>
              <label class="d-block"><input type="radio" name="order" value="asc" checked> Ascending</label>
              <label class="d-block"><input type="radio" name="order" value="desc" required> Descending</label>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="container-fluid">
            <div class="alert alert-danger py-1 my-auto" id="printFormAlert"></div>
          </div>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <!-- <button type="button" class="btn btn-primary" onclick="confirmPrint();">Print</button> -->
          <input class="btn btn-primary" type="submit" name="submit" value="Print">
        </div>
      </form>
    </div>
  </div>
</div>
