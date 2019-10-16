<div class="container-fluid">
  <div class="row py-2">
    <div class="col-auto">
      <button class="btn btn-primary" data-toggle="modal" data-target=".add-transac-modal">
        <i class="fa fa-plus"></i>
      </button>
    </div>
    <div class="col pl-0">

      <table class="table table-bordered table-sm">
        <thead>
          <tr class="text-center">
            <th>ID</th>
            <th>Encoded</th>
            <th>Order Number</th>
            <th>Encoded by</th>
            <th>Transaction Date</th>
            <th>First Name</th>
            <th>Last Name</th>
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
          <tr>
            <td>Mark</td>
            <td>Mark</td>
            <td>Mark</td>
            <td>Otto</td>
            <td>Mark</td>
            <td>Otto</td>
            <td>Otto</td>
            <td>Mark</td>
            <td>Otto</td>
            <td>Mark</td>
            <td>Otto</td>
            <td class="text-center">
              <span class="badge badge-success" data-toggle="popover" data-placement="right" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">
                <i class="fa fa-shopping-cart"></i>
              </span>
            </td>
            <td>Mark</td>
            <td>Otto</td>
            <td>Otto</td>
            <td class="text-center">
              <span class="badge badge-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-ellipsis-h"></i>
              </span>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
              </div>
            </td>
          </tr>
          <tr class="table-secondary">
            <td>Mark</td>
            <td>Otto</td>
            <td>Mark</td>
            <td>Otto</td>
            <td>Otto</td>
            <td>Otto</td>
            <td>Otto</td>
            <td>Mark</td>
            <td>Otto</td>
            <td>Mark</td>
            <td>Otto</td>
            <td class="text-center"><span class="badge badge-success"><i class="fa fa-shopping-cart"></i></span></td>
            <td>Mark</td>
            <td>Otto</td>
            <td>Otto</td>
            <td class="text-center">
              <span class="badge badge-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-ellipsis-h"></i>
              </span>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
              </div>
            </td>
          </tr>
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
      <div class="modal-body">
        <form class="" target="" action="" method="post">
          <div class="row">
            <div class="col-3">
              Transaction Date
              <input class="form-control" type="date" name="" value="">
            </div>
            <div class="col pr-1">
              Firstname
              <input class="form-control" type="text" name="" value="">
            </div>
            <div class="col pl-1">
              Lastname
              <input class="form-control" type="text" name="" value="">
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-4">
              Contact Number
              <input class="form-control" type="text" name="" value="">
            </div>
            <div class="col">
              Delivery Address
              <input class="form-control" type="text" name="" value="">
            </div>
          </div>
          <div class="row mt-2">
            <div class="col">
              Nearby Landmarks/Specific Directions
              <input class="form-control" type="text" name="" value="">
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-4">
              Partner/Establishent
              <select class="custom-select" name="">
                <option value="">Click'n Choose</option>
                <option value="ladidu">ladidu</option>
                <option value="ladidi">ladidi</option>
                <option value="ladidudi">ladidudi</option>
              </select>
            </div>
            <div class="col">
              Order/Items

            </div>
          </div>
          <div class="row mt-2">
            <div class="col">
              Sub-total
              <input class="form-control text-center" type="text" name="" value="" readonly>
            </div>
            <div class="col">
              Delivery Charge
              <input class="form-control text-center" type="text" name="" value="">
            </div>
            <div class="col">
              Total Price
              <input class="form-control text-center" type="text" name="" value="" readonly>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
