<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo $title ?></title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap">
  </head>
  <body>
    <?php if (empty($transactions)): ?>
      <div class="alert alert-danger text-center" role="alert">
        <strong>Oh snap!</strong> The parameters you entered didn't return any records.
      </div>
    <?php else: ?>
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
      <tbody class="text-center" style="font-family:'Roboto Condensed',sans-serif;">
        <?php foreach ($transactions as $row): ?>
          <tr>
            <?php foreach ($row as $key => $value): ?>
              <?php if ($key == 'Order(s)'): ?>
                <td>
                  <table class="table table-sm table-hover m-0" style="vertical-align:middle;">
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
              <?php elseif($key == 'transaction_ID'): ?>
                <!-- skip -->
              <?php else: ?>
                <td style="vertical-align:middle;"><?php echo $row[$key] ?></td>
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
