<div class="alert alert-danger" role="alert">
  This page is very much under development. Contact the developer for further assistance.
</div>

<div class="container">
  <div class="jumbotron my-3 py-4">
    <button class="btn btn-primary" type="button" name="button" id="dailyTranBtn" onclick="dailyTran();">Load Daily Transactions graph</button>
    <div class="spinner-border text-dark" role="status" id="dailyTranSpin">
      <span class="sr-only">Loading...</span>
    </div>
    <canvas id="dailyTran"></canvas>
  </div>

  <div class="jumbotron my-3 py-4">
    <button class="btn btn-primary" type="button" name="button" id="topPartnersBtn" onclick="topPartners();">Load Top Partners graph</button>
    <div class="spinner-border text-dark" role="status" id="topPartnersSpin">
      <span class="sr-only">Loading...</span>
    </div>
    <canvas id="topPartners"></canvas>
    <small>
      <i class="text-danger">This graph is quite misleading: New partners doesn't have equal footing with old partners.</i>
    </small>
  </div>

  <div class="jumbotron my-3 py-4">
    <button class="btn btn-primary" type="button" name="button" id="barangaysBtn" onclick="barangays();">Load Per-barangays graph</button>
    <div class="spinner-border text-dark" role="status" id="barangaysSpin">
      <span class="sr-only">Loading...</span>
    </div>
    <canvas id="barangays"></canvas>
    <!-- <small>
      <i>This graph is quite misleading: New partners doesn't have equal footing with old partners.</i>
    </small> -->
  </div>
</div>
