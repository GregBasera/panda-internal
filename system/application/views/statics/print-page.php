<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo $kind ?></title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400&display=swap">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/print-page.css' ?>">
  </head>
  <body>
    <?php if (empty($transactions)): ?>
      <div class="alert alert-danger text-center" role="alert">
        <strong>Oh snap!</strong> The parameters you entered didn't return any records.
      </div>
    <?php elseif($isDefault == true): ?>
      <div class="alert alert-danger text-center" role="alert">
        The server returned the default result set. Are you sure you filled up the request properly?
      </div>
    <?php else: ?>
    <div class="container-fluid header">
      <h1><?php echo $company ?></h1>
      <p class="m-0 text-muted"><?php echo $addr1 ?></p>
      <p class="m-0 text-muted"><?php echo $addr2 ?></p>
      <p class="m-0 text-muted"><?php echo $company_email ?></p>
      <p class="m-0 text-muted"><?php echo $company_contact ?></p>

      <?php if(isset($partner_name)): ?>
        <h3 class="mt-4"><?php echo $partner_name ?></h3>
      <?php endif; ?>
      <h4 class="<?php echo (!isset($partner_name)) ? 'mt-4' : 'mt-2' ?>"><?php echo $kind ?></h4>
      <h6 class="mb-4"><?php echo $titleSupport ?></h6>
    </div>
    <div class="container-fluid my-5">
      <div class="row">
        <div class="col-6">
          <?php if ($prev != ''): ?>
            <h5><?php echo $prev[0]['title'] ?> (<?php echo $prev[0]['date'] ?>): <b>₱ <?php echo number_format($prev[0]['previous'], 2, '.', ',') ?></b></h5>
          <?php endif; ?>
          <h5>Current Month's Sales (<?php echo $blankTotals[0]['date'] ?>): <b>₱ <?php echo number_format($blankTotals[0]['Total'], 2, '.', ',') ?></b></h5>
          <h5>Contract Percentage: <b>???</b></h5>
          <h5>Monthly Service Fee (curr month): <b>???</b></h5>
          <h5>Number of Deliveries (curr month): <b><?php echo $blankTotals[0]['Number of Transactions'] ?></b></h5>
        </div>
      </div>
    </div>
    <table class="table table-bordered table-sm table-hover">
      <thead class="text-center">
        <tr>
          <?php foreach ($transactions[0] as $key => $value): ?>
            <?php if ($key != 'transaction_ID'): ?>
              <th><?php echo $key ?></th>
            <?php endif; ?>
          <?php endforeach; ?>
        </tr>
      </thead>
      <tbody class="text-center">
        <?php foreach ($transactions as $row): ?>
          <tr>
            <?php foreach ($row as $key => $value): ?>
              <?php if($key == 'transaction_ID'): ?>
                <!-- skip -->
              <?php elseif($key == 'Order(s)'): ?>
                <td>
                  <table class="table table-sm table-hover m-0">
                    <?php foreach ($orders as $order): ?>
                      <?php if ($order['transaction_ID'] == $row['transaction_ID']): ?>
                        <tr>
                          <td><?php echo $order['quantity'] ?></td>
                          <td><?php echo $order['item_name'] ?></td>
                          <td><?php echo $order['price'] ?></td>
                        </tr>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  </table>
                </td>
              <?php elseif($key == 'Encoded' || $key == 'Transaction Date'): ?>
                <td><?php echo date('M d, Y h:i a', strtotime($row[$key])) ?></td>
              <?php elseif($key == 'Contact'): ?>
                <td><?php echo substr($row[$key], 0, 4).'-'.substr($row[$key], 4, 3).'-'.substr($row[$key], 7) ?></td>
              <?php else: ?>
                <td><?php echo $row[$key] ?></td>
              <?php endif; ?>
            <?php endforeach; ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php endif; ?>
  </body>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>
