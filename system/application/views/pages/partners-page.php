<div class="container-fluid">
  <div class="row py-2">
    <div class="col-auto">
      <div class="container-fluid p-0 d-flex justify-content-center" data-toggle="tooltip"
        data-placement="right" title="Add a Partner">
        <button class="btn btn-primary mb-2" data-toggle="modal" data-target=".add-partner-modal">
          <i class="fa fa-plus"></i>
        </button>
      </div>
      <div class="container-fluid p-0 d-flex justify-content-center" data-toggle="tooltip"
        data-placement="right" title="Search">
        <button class="btn btn-success mb-2">
          <i class="fa fa-search"></i>
        </button>
      </div>
    </div>
    <div class="col pl-0">
      <div class="container-fluid">
        <h2><?php echo $title ?></h2>
      </div>
      <table class="table table-bordered table-hover">
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
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($partners as $partner): ?>
            <tr class="text-center">
              <!-- <td><?php echo $partner['partner_ID'] ?></td> -->
              <td><?php echo $partner['partner_name'] ?></td>
              <td class="text-left"><?php echo $partner['partner_address'] ?></td>
              <td><?php echo $partner['partner_contact'] ?></td>
              <td><?php echo $partner['partner_email'] ?></td>
              <td><?php echo $partner['owner_name'] ?></td>
              <td><?php echo $partner['owner_contact'] ?></td>
              <td><?php echo $partner['owner_email'] ?></td>
              <td><?php echo $partner['contract_percentage'] ?></td>
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
        <form class="" target="" action="" method="post">
          <div class="row">
            <div class="col-4 pr-1">
              Partner Name
              <input class="form-control text-center" type="text" name="" value="">
            </div>
            <div class="col-8 pl-1">
              Partner Address
              <input class="form-control" type="text" name="" value="">
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-3 pr-1">
              Partner Contact
              <input class="form-control text-center" type="text" name="" value="">
            </div>
            <div class="col-5 px-1">
              Partner Email
              <input class="form-control text-center" type="text" name="" value="">
            </div>
            <div class="col-4 pl-1">
              Owner Name
              <input class="form-control text-center" type="text" name="" value="">
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-3 pr-1">
              Owner Contact
              <input class="form-control text-center" type="text" name="" value="">
            </div>
            <div class="col-5 px-1">
              Owner Email
              <input class="form-control text-center" type="text" name="" value="">
            </div>
            <div class="col-4 pl-1">
              Contract Percentage
              <input class="form-control text-center" type="text" name="" value="">
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
