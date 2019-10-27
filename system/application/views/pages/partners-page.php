<div class="container-fluid">
  <div class="row py-2">
    <div class="col-auto">
      <div class="container-fluid p-0 d-flex justify-content-center">
        <button class="btn btn-primary mb-2" data-toggle="modal" data-target=".add-partner-modal">
          <i class="fa fa-plus" data-toggle="tooltip" data-placement="right" title="Add a Partner"></i>
        </button>
      </div>
      <div class="container-fluid p-0 d-flex justify-content-center">
        <button class="btn btn-success mb-2">
          <i class="fa fa-search" data-toggle="tooltip" data-placement="right" title="Search"></i>
        </button>
      </div>
      <div class="container-fluid p-0 d-flex justify-content-center">
        <button class="btn btn-dark mb-2">
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
            <!-- <th>Partner ID</th> -->
            <th>Partner Name</th>
            <th>Partner Address</th>
            <th>Partner Contact</th>
            <th>Partner Email</th>
            <th>Owner Name</th>
            <th>Owner Contact</th>
            <th>Owner Email</th>
            <th>Contract Percentage</th>
            <th>Contract Execution</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($partners as $partner): ?>
            <tr class="text-center">
              <!-- <td><?php echo $partner['partner_ID'] ?></td> -->
              <td><?php echo $partner['partner_name'] ?></td>
              <td class="text-left"><?php echo $partner['partner_address'] ?></td>
              <td>
                <?php if (strlen($partner['partner_contact']) == 11): ?>
                  <?php echo substr($partner['partner_contact'], 0, 4).'-'.substr($partner['partner_contact'], 4, 3).'-'.substr($partner['partner_contact'], 7) ?>
                <?php else: ?>
                  <?php echo $partner['partner_contact'] ?>
                <?php endif; ?>
              </td>
              <td><?php echo $partner['partner_email'] ?></td>
              <td><?php echo $partner['owner_name'] ?></td>
              <td>
                <?php if (strlen($partner['owner_contact']) == 11): ?>
                  <?php echo substr($partner['owner_contact'], 0, 4).'-'.substr($partner['owner_contact'], 4, 3).'-'.substr($partner['owner_contact'], 7) ?>
                <?php else: ?>
                  <?php echo $partner['owner_contact'] ?>
                <?php endif; ?>
              </td>
              <td><?php echo $partner['owner_email'] ?></td>
              <td><?php echo $partner['contract_percentage'] ?></td>
              <td><?php echo date('M d, Y', strtotime($partner['contract_execution'])) ?></td>
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

<!-- Add a partner modal -->
<div class="modal fade add-partner-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add a Partner</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="" target="" action="" method="post" name="Partner">
          <div class="row">
            <div class="col-4 pr-1">
              Partner Name
              <input class="form-control text-center" type="text" name="p_name" value="">
            </div>
            <div class="col-8 pl-1">
              Partner Address
              <input class="form-control" type="text" name="p_address" value="">
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-3 pr-1">
              Partner Contact
              <input class="form-control text-center" type="text" name="p_contact" value="">
            </div>
            <div class="col-5 px-1">
              Partner Email
              <input class="form-control text-center" type="text" name="p_email" value="">
            </div>
            <div class="col-4 pl-1">
              Owner Name
              <input class="form-control text-center" type="text" name="o_name" value="">
            </div>
          </div>
          <div class="row mt-2">
            <div class="col pr-1">
              Owner Contact
              <input class="form-control text-center" type="text" name="o_contact" value="">
            </div>
            <div class="col px-1">
              Owner Email
              <input class="form-control text-center" type="text" name="o_email" value="">
            </div>
            <div class="col px-1">
              Contract Percentage
              <input class="form-control text-center" type="text" name="p_percentage" value="" placeholder="Ex. 0.134">
            </div>
            <div class="col pl-1">
              Contract Execution
              <input class="form-control text-center" type="date" name="p_execution" value="">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <div class="container-fluid">
          <div class="spinner-border spinner-border-sm" id="spinner"></div>
          <div class="alert alert-danger py-1 my-auto" id="partnerFormAlert"></div>
        </div>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="addPartner();">Save</button>
      </div>
    </div>
  </div>
</div>
