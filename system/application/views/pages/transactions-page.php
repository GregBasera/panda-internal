<div class="container-fluid">
  <div class="row py-2">
    <div class="col-auto pr-0 d-none d-md-block">
      <div class="container-fluid p-0 d-flex justify-content-center">
        <button class="btn btn-primary mb-2" data-toggle="modal" data-target=".add-transac-modal">
          <i class="fa fa-plus" data-toggle="tooltip" data-placement="right" title="Add a Transaction"></i>
        </button>
      </div>
      <!-- <div class="container-fluid p-0 d-flex justify-content-center">
        <button class="btn btn-success mb-2" data-toggle="modal" data-target=".multi-transac-modal">
          <i class="fa fa-file-medical fa-lg" data-toggle="tooltip" data-placement="right" title="Add multiple transactions"></i>
        </button>
      </div> -->
      <div class="container-fluid p-0 d-flex justify-content-center">
        <button class="btn btn-dark mb-2" data-toggle="modal" data-target=".print-report-modal">
          <i class="fa fa-print" data-toggle="tooltip" data-placement="right" title="Print Report"></i>
        </button>
      </div>
    </div>

    <div class="col">
      <div class="container-fluid pr-0 pr-sm-3">
        <div class="row pb-2">
          <div class="col">
            <h2 class="m-0 d-none d-sm-block"><?php echo $title ?></h2>
            <div class="d-flex justify-content-start d-block d-sm-none">
              <button class="btn btn-primary mr-2" data-toggle="modal" data-target=".add-transac-modal">
                <i class="fa fa-plus" data-toggle="tooltip" data-placement="right" title="Add a Transaction"></i>
              </button>
              <button class="btn btn-dark mr-2" data-toggle="modal" data-target=".print-report-modal">
                <i class="fa fa-print" data-toggle="tooltip" data-placement="right" title="Print Report"></i>
              </button>
            </div>
          </div>
          <div class="col-6 d-none d-sm-block">
            <form class="" target="" action="<?php echo base_url().'transactions/search' ?>" method="post">
              <input class="form-control" type="search" value="" name="keyword" placeholder="Search">
            </form>
          </div>
          <div class="col d-flex align-items-center justify-content-end">
            <ul class="pagination pagination-sm m-0">
              <li class="page-item"><a class="page-link <?php echo ($act_page - 5 <= 0) ? 'd-none' : '' ?>" href="<?php echo base_url().'transactions/view/'.($act_page - 5) ?>"><span>&laquo;</span></a></li>
              <li class="page-item"><a class="page-link <?php echo ($act_page - 2 <= 0) ? 'd-none' : '' ?>" href="<?php echo base_url().'transactions/view/'.($act_page - 2) ?>"><?php echo $act_page - 2 ?></a></li>
              <li class="page-item"><a class="page-link <?php echo ($act_page - 1 <= 0) ? 'd-none' : '' ?>" href="<?php echo base_url().'transactions/view/'.($act_page - 1) ?>"><?php echo $act_page - 1 ?></a></li>
              <li class="page-item active"><a class="page-link" href="<?php echo base_url().'transactions/view/'.$act_page ?>"><?php echo $act_page ?></a></li>
              <li class="page-item"><a class="page-link <?php echo ($act_page + 1 > $pages) ? 'd-none' : '' ?>" href="<?php echo base_url().'transactions/view/'.($act_page + 1) ?>"><?php echo $act_page + 1 ?></a></li>
              <li class="page-item"><a class="page-link <?php echo ($act_page + 2 > $pages) ? 'd-none' : '' ?>" href="<?php echo base_url().'transactions/view/'.($act_page + 2) ?>"><?php echo $act_page + 2 ?></a></li>
              <li class="page-item"><a class="page-link <?php echo ($act_page + 5 > $pages) ? 'd-none' : '' ?>" href="<?php echo base_url().'transactions/view/'.($act_page + 5) ?>"><span>&raquo;</span></a></li>
            </ul>
          </div>
        </div>
      </div>

      <div class="alert alert-danger alert-dismissible fade <?php echo ($hasRes) ? 'd-none' : 'show' ?>" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <strong>Sorry</strong> your query didn't return any relevant results.
      </div>

      <table class="table table-bordered table-sm table-hover">
        <thead>
          <tr class="text-center">
            <!-- <th>ID</th> -->
            <th>Encoded</th>
            <th>Enco. by</th>
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
              <td><?php echo $transaction['encoded_by'] ?></td>
              <td><?php echo $transaction['order_number'] ?></td>
              <td><?php echo $transaction['dispatched_by'] ?></td>
              <td><?php echo date('M d, Y h:i a', strtotime($transaction['transaction_date'])) ?></td>
              <td><?php echo $transaction['customer_fname'] ?></td>
              <td><?php echo $transaction['customer_lname'] ?></td>
              <td><?php echo substr($transaction['customer_contact'], 0, 4).'-'.substr($transaction['customer_contact'], 4, 3).'-'.substr($transaction['customer_contact'], 7) ?></td>
              <td class="text-left"><?php echo $transaction['delivery_address'] ?></td>
              <td class="text-left"><?php echo $transaction['landmark_directions'] ?></td>
              <td><?php echo $transaction['partner_name'] ?></td>
              <td>
                <span class="badge badge-success pointer" data-toggle="popover" data-placement="right"
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
                <span class="badge badge-secondary dropdown-toggle pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <div class="dropdown-menu dropdown-menu-right">
                  <button class="dropdown-item" type="button" name="button" data-toggle="modal" data-target=".edit-modal" onclick="editModalTriggd('<?php echo $transaction['transaction_ID'] ?>');">
                    <i class="fa fa-pen"></i> Update/Edit
                  </button>
                  <button class="dropdown-item text-danger" type="button" data-toggle="modal" data-target=".delete-modal" onclick="deleteModalTriggd('<?php echo $transaction['transaction_ID'] ?>');">
                    <i class="fa fa-trash"></i> Delete
                  </button>
                </div>
                <br>
                <?php if ($transaction['isDelivered'] == true): ?>
                  <span class="badge badge-success" data-toggle="tooltip" data-placement="left" title="Delivered">
                    <i class="fa fa-check"></i>
                  </span>
                <?php else: ?>
                  <span class="badge badge-danger" data-toggle="tooltip" data-placement="left" title="Canceled">
                    <i class="fa fa-times"></i>
                  </span>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <small class="text-muted"><i><?php echo $onRecord ?> transaction(s) on record</i></small>
    </div>
  </div>
</div>

<!-- Edit a transaction modal -->
<div class="modal fade edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update/Edit a Transaction Record</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-3 pr-1">
            Transaction Date
            <input class="form-control" type="date" id="e_t_date" value="">
          </div>
          <div class="col-3 pl-1">
            Transaction Time
            <input class="form-control" type="time" id="e_t_time" value="">
          </div>

          <div class="col pr-1">
            Firstname
            <input class="form-control" type="text" id="e_c_fname" value="">
          </div>
          <div class="col pl-1">
            Lastname
            <input class="form-control" type="text" id="e_c_lname" value="">
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-4">
            Contact Number
            <input class="form-control" type="text" id="e_c_contact" value="">
          </div>
          <div class="col">
            Delivery Address
            <input class="form-control" type="text" id="e_c_address" value="">
          </div>
        </div>
        <div class="row mt-2">
          <div class="col">
            Nearby Landmarks/Specific Directions
            <input class="form-control" type="text" id="e_c_directions" value="--">
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-4">
            Partner/Establishent
            <select class="custom-select" id="e_t_partner">
              <option value="">Click'n Choose</option>
              <?php foreach ($partners as $partner): ?>
                <option value="<?php echo $partner['partner_ID'] ?>"><?php echo $partner['partner_name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-2 pr-1">
            Encoded By
            <input class="form-control text-center" type="text" id="e_t_encoded_by" value="<?php echo $name ?>" readonly>
          </div>
          <div class="col-3 px-1">
            Order Number
            <input class="form-control text-center" type="number" id="e_t_ordernum" min="1" value="">
          </div>
          <div class="col-3 pl-1">
            Dispatched by
            <input class="form-control text-center" type="text" id="e_t_dispatched_by" value="">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="container-fluid">
          <div class="spinner-border spinner-border-sm" id="edit_spinner"></div>
        </div>
        <div class="custom-control custom-switch">
          <input type="checkbox" class="custom-control-input" name="isDelivered" id="e_isDelivered" onclick="isDeliv();" checked>
          <label class="custom-control-label" for="e_isDelivered" id="e_isDeliv">Delivered</label>
        </div>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="t_edit">Update</button>
      </div>
    </div>
  </div>
</div>

<!-- Delete a transaction modal -->
<div class="modal fade delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete a Transaction Record</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        You are about to delete a transaction record.<br>This CANNOT be undone.
      </div>
      <div class="modal-footer">
        <div class="container-fluid">
          <div class="spinner-border spinner-border-sm" id="del_spinner"></div>
        </div>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id="t_delete">Delete</button>
      </div>
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
              <input id="for-sticky-date" class="form-control" type="date" name="t_date" value="">
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
              <input class="form-control" type="text" name="c_directions" value="--">
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
                  <input class="form-control form-control-sm text-center" type="number" name="i_quantity" value="" placeholder="Quantity" onkeyup="getSubtotal();getGrandT();">
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
            <div class="col pl-1">
              Total Price
              <input class="form-control text-center" type="text" name="t_grandT" value="" readonly>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col pr-1">
              Encoded By
              <input class="form-control text-center" type="text" name="t_encoded_by" value="<?php echo $name ?>" readonly>
            </div>
            <div class="col px-1">
              Order Number
              <input class="form-control text-center" type="number" name="t_ordernum" min="1" value="">
            </div>
            <div class="col pl-1">
              Dispatched by
              <input class="form-control text-center" type="text" name="t_dispatched_by" value="">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="container-fluid">
            <div class="spinner-border spinner-border-sm" id="spinner"></div>
            <div id="sendToDBSuccess">
              <i class="fa fa-check"></i>
            </div>
            <div class="alert alert-danger py-1 my-auto" id="transactionFormAlert"></div>
          </div>
          <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" name="isDelivered" id="isDelivered" onclick="isDeliv();" checked="true">
            <label class="custom-control-label" for="isDelivered" id="isDeliv">Delivered</label>
          </div>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" onclick="addTransaction();">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Add multiple transaction modal -->
<div class="modal fade multi-transac-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Multiple Transactions [via .CSV]</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="" target="_blank" action="<?php echo base_url().'transactions/multi_add' ?>" enctype="multipart/form-data" method="post">
          <div class="row">
            <div class="col">
              <input class="form-control-file" accept=".csv" type="file" name="csvFile" value="">
            </div>
            <div class="col-auto">
              <input class="btn btn-info btn-sm" type="submit" name="" value="Upload">
            </div>
          </div>
        </form>
        <div class="alert alert-warning mt-2" role="alert">
          <strong>Warning: The .CSV file should have the following columns with the following format:</strong>
          <table class="table m-0 mt-3">
            <thead>
              <tr>
                <th>Column Name</th>
                <th>Format</th>
                <th>Example</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Order Number</td>
                <td>numbers (1 to 2147483647)</td>
                <td>234</td>
              </tr>
              <tr>
                <td>Dispatched By</td>
                <td>Name (20 letters max)</td>
                <td>Jude</td>
              </tr>
              <tr>
                <td>Transaction Date</td>
                <td>Date and Time (YYYY-mm-dd hh:mm:ss)</td>
                <td>2019-12-01 01:30:00</td>
              </tr>
              <tr>
                <td>Firstname</td>
                <td>Name (25 letters max)</td>
                <td>Juan</td>
              </tr>
              <tr>
                <td>Lastname</td>
                <td>Name (25 letters max)</td>
                <td>Dela Cruz</td>
              </tr>
              <tr>
                <td>Contact</td>
                <td>Phone Number (11 digits)</td>
                <td>09123456789</td>
              </tr>
              <tr>
                <td>Delivery Address</td>
                <td>Postal Address</td>
                <td>Blk 5 Lot 6, Deca Homes subdv, Langon Vista, Cararayan</td>
              </tr>
              <tr>
                <td>Landmarks/Directions</td>
                <td>Specific directions</td>
                <td>Turn right in the intersection. Rainbow colored gate.</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>
<div class="modal fade multi-transac-preview-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Multiple Transactions Preview</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
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
      <form class="" name="Print" target="_blank" action="<?php echo base_url().'transactions/print' ?>" method="post">
        <div class="modal-body">
          <h4 class="px-3">Columns to be printed</h4>
          <hr class="my-1">
          <div class="row mb-4">
            <div class="col-4">
              <label class="d-block"><input type="checkbox" name="columns[]" value="t.transaction_ID as 'ID'"> Transaction ID</label>
              <label class="d-block"><input type="checkbox" name="columns[]" value="t.date_encoded as 'Encoded'"> Date Encoded</label>
              <label class="d-block"><input type="checkbox" name="columns[]" value="t.encoded_by as 'Enco. by'"> Encoded By</label>
              <label class="d-block"><input type="checkbox" name="columns[]" value="t.order_number as 'Ord. No'" checked> Order Number</label>
              <label class="d-block"><input type="checkbox" name="columns[]" value="t.dispatched_by as 'Disp. by'"> Dispatched By</label>
              <label class="d-block"><input type="checkbox" name="columns[]" value="t.transaction_date as 'Transaction Date'" checked> Transaction Date</label>
            </div>
            <div class="col-4">
              <label class="d-block"><input type="checkbox" name="columns[]" value="t.customer_fname as 'Firstname'"> Customer Firstname</label>
              <label class="d-block"><input type="checkbox" name="columns[]" value="t.customer_lname as 'Lastname'"> Customer Lastname</label>
              <label class="d-block"><input type="checkbox" name="columns[]" value="t.customer_contact as 'Contact'"> Contact Number</label>
              <label class="d-block"><input type="checkbox" name="columns[]" value="t.delivery_address as 'Delivery Addresss'"> Delivery Address</label>
              <label class="d-block"><input type="checkbox" name="columns[]" value="t.landmark_directions as 'Landmarks/Directions'"> Landmarks/Directions</label>
            </div>
            <div class="col-4">
              <label class="d-block"><input type="checkbox" name="columns[]" value="p.partner_name as 'Partner'"> Partner</label>
              <label class="d-block"><input type="checkbox" name="columns[]" value=""> Order List</label>
              <label class="d-block"><input type="checkbox" name="columns[]" value="t.subtotal as 'Subtotal (₱)'" checked> Sub-Total</label>
              <label class="d-block"><input type="checkbox" name="columns[]" value="t.delivery_charge as 'D.Charge (₱)'"> Delivery Charge</label>
              <label class="d-block"><input type="checkbox" name="columns[]" value="t.total_transaction_price as 'Total (₱)'"> Transaction Total</label>
            </div>
          </div>
          <div class="row mb-4">
            <div class="col-4">
              <h4 class="px-3">Kind of report</h4>
              <hr class="my-1">
              <label class="d-block"><input type="radio" name="kind" value="daily" onclick="kindToMod();" required> Daily Report</label>
              <label class="d-block"><input type="radio" name="kind" value="monthly" onclick="kindToMod();"> Monthly Report</label>
              <label class="d-block"><input type="radio" name="kind" value="yearly" onclick="kindToMod();"> Yearly Report</label>

              <h4 class="px-3 mt-4">Delivered?</h4>
              <hr class="my-1">
              <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" name="isDelivered" id="delivered" onclick="isDeliv();" checked>
                <label class="custom-control-label" for="delivered" id="deliv">Delivered</label>
              </div>
              <label class="d-block"><input type="checkbox" name="delivered" value="all" onclick="document.getElementById('delivered').disabled = (this.checked) ? true : false;"> All</label>
            </div>
            <div class="col-4">
              <h4 class="px-3">Modifiers</h4>
              <hr class="my-1">
              Partner Name
              <select class="custom-select" name="partner" onchange="reportSummary();" data-toggle="tooltip" data-placement="bottom"
                title="Keep this field blank if you don't want a Partner specific report.">
                <option value="" onclick="reportSummary();">--blank--</option>
                <?php foreach ($partners as $partner): ?>
                  <option value="<?php echo $partner['partner_ID'] ?>"><?php echo $partner['partner_name'] ?></option>
                <?php endforeach; ?>
              </select>
              <div class="mt-2" id="dailyMod">
                Date
                <input class="form-control" type="date" name="dailyMod" value="" data-toggle="tooltip" data-placement="bottom"
                  title="Preferred date of the report.">
              </div>
              <div class="mt-2" id="monthlyMod">
                Month and Year
                <input class="form-control" type="date" name="monthlyMod" value="" data-toggle="tooltip" data-placement="bottom"
                  title="Preferred month and year of the report. You can input any day of the month.">
              </div>
              <div class="mt-2" id="yearlyMod">
                Year
                <input class="form-control" type="number" name="yearlyMod" value="" placeholder="year" min="2008" data-toggle="tooltip" data-placement="bottom"
                  title="Preferred year of the report.">
              </div>
              <h4 class="px-3 mt-4">Summaries</h4>
              <hr class="my-1">
              <label class="d-block"><input type="checkbox" name="subSum" value="prev" checked> Subtotals</label>
              <label class="d-block"><input type="checkbox" name="chaSum" value="curr" checked> Delivery Charges</label>
              <label class="d-block"><input type="checkbox" name="totSum" value="curr" checked> Total Prices</label>
              <div id="labelCont">
                <label class="d-block"><input type="checkbox" name="sumContract" value="cont"> Contract % and Service Fee</label>
              </div>
              <!-- <label class="d-block"><input type="checkbox" name="sumDlvs" value="dlvs" checked> Number of Deliveries</label> -->
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
          <div class="container-fluid bg-light rounded pointer" data-toggle="collapse" data-target="#other">
            <small><i class="fa fa-caret-down"></i> Other options</small>
            <hr class="m-0">
          </div>
          <div class="row collapse" id="other">
            <div class="col-6 my-2">
              <h4 class="px-3">Header</h4>
              <hr class="my-1">
              <input class="form-control" type="text" name="company" value="Pandalivery" placeholder="Company name">
              <input class="form-control" type="text" name="addr1" value="#5 Narra St., Mariano Village, Brgy. Balatas" placeholder="Street num Street name, Barangay">
              <input class="form-control" type="text" name="addr2" value="Naga City, 4400 Camarines Sur" placeholder="City/Municipality, Postcode, Province">
              <input class="form-control" type="email" name="company_email" value="pandalivery@pandalivery.com" placeholder="Company Email">
              <input class="form-control" type="text" name="company_contact" value="0998-765-4321" placeholder="Company Phone/Tel">
            </div>
            <div class="col-6 my-2">
              <h4 class="px-3">Footer</h4>
              <hr class="my-1">
              Prepared By
              <input class="form-control" type="text" name="prepby" value="Juan Dela Cruz">
              Position
              <input class="form-control" type="text" name="posi" value="CFO">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <!-- <button type="button" class="btn btn-primary" onclick="confirmPrint();">Print</button> -->
          <input class="btn btn-primary" type="submit" name="submit" value="Print Preview">
        </div>
      </form>
    </div>
  </div>
</div>
