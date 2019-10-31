<div class="container-fluid">
  <div class="row" style="height:100vh">
    <div class="col-12 col-sm-4 d-flex flex-wrap align-content-center">
      <form class="w-100 d-none d-sm-block" target="" action="<?php echo base_url().'userlog/signin' ?>" method="post" style="left:50%;position:relative;z-index:1;">
        <div class="card shadow">
          <div class="card-header">
            <h3 class="m-0">Staff Sign-in</h3>
          </div>
          <div class="card-body">
            <small>Name</small>
            <input class="form-control form-control-lg" type="text" name="name" value="" required>
            <small>Token</small>
            <input class="form-control form-control-lg" type="text" name="token" value="" required>
            <input class="btn btn-success btn-block btn-sm mt-2" type="submit" name="" value="Sign-in">
            <?php if ($error == 'e'): ?>
              <div class="alert alert-danger m-0 mt-2" id="unauth" role="alert">
                <strong>Oh snap!</strong> Change a few things up and try submitting again.
              </div>
            <?php endif; ?>
          </div>
        </div>
      </form>

      <form class="w-100 d-sm-none d-block" target="" action="<?php echo base_url().'userlog/signin' ?>" method="post">
        <div class="card shadow">
          <div class="card-header">
            <h3 class="m-0">Staff Sign-in</h3>
          </div>
          <div class="card-body">
            <small>Name</small>
            <input class="form-control form-control-lg" type="text" name="name" value="" required>
            <small>Token</small>
            <input class="form-control form-control-lg" type="text" name="token" value="" required>
            <input class="btn btn-success btn-block btn-sm mt-2" type="submit" name="" value="Sign-in">
            <?php if ($error == 'e'): ?>
              <div class="alert alert-danger m-0 mt-2" id="unauth" role="alert">
                <strong>Oh snap!</strong> Change a few things up and try submitting again.
              </div>
            <?php endif; ?>
          </div>
        </div>
      </form>
    </div>
    <div class="col-12 col-sm-8 bg-dark d-flex justify-content-center flex-wrap align-content-center">
      <img width="350px" src="<?php echo base_url().'assets/imgs/head-logo.png' ?>" alt="head-logo">
    </div>
  </div>
</div>
