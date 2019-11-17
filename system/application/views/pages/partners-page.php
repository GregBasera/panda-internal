<div class="container-fluid">
  <div class="row py-2">
    <div class="col-auto">
      <div class="container-fluid p-0 d-flex justify-content-center">
        <button class="btn btn-primary mb-2" data-toggle="modal" data-target=".add-partner-modal">
          <i class="fa fa-plus" data-toggle="tooltip" data-placement="right" title="Add a Partner"></i>
        </button>
      </div>
    </div>
    <div class="col pl-0">
      <div class="container-fluid">
        <div class="row pb-2">
          <div class="col-3">
            <h2 class="m-0"><?php echo $title ?></h2>
          </div>
          <div class="col-6">
            <!-- <input class="form-control" type="search" value="" placeholder="Search"> -->
          </div>
          <div class="col-3 d-flex justify-content-end">
            <!-- space -->
          </div>
        </div>
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
                <span class="badge badge-info dropdown-toggle pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <div class="dropdown-menu dropdown-menu-right">
                  <!-- <a class="dropdown-item" href="#">
                    <i class="fa fa-pen"></i> Update/Edit
                  </a> -->
                  <button class="dropdown-item text-danger" data-toggle="modal" data-target=".delete-partner-modal" onclick="delPartnerTrigg('<?php echo $partner['partner_ID'] ?>');">
                    <i class="fa fa-trash"></i> Delete
                  </button>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <small class="text-muted"><i><?php echo $onRecord ?> partner(s) on record</i></small>
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

<!-- Delete a partner modal -->
<div class="modal fade delete-partner-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete a Partner</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger text-center" role="alert">
          You are about to delete a <strong>Partner</strong> record.<br>
          This action will also result in the deletion of <strong>all Transactions</strong> under this Partner.
          <br><br><strong>Recommendation:</strong> Back-up or Dump the database into or somewhere secure before proceeding on this action.
          Contact a professional if needed.
        </div>
      </div>
      <div class="modal-footer">
        <div class="container-fluid">
          <div class="spinner-border spinner-border-sm" id="del_spinner"></div>
        </div>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id="p_delete">Delete</button>
      </div>
    </div>
  </div>
</div>
