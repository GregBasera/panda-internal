<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Pandalivery - <?php echo $title ?></title>
    <!-- <link rel="shortcut icon" type="image/png" href=""> -->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/general.css' ?>">

    <?php if ($title == 'Transactions'): ?>
      <link rel="stylesheet" href="<?php echo base_url().'assets/css/transactions.css' ?>">
    <?php elseif ($title == 'Partners'): ?>
      <link rel="stylesheet" href="<?php echo base_url().'assets/css/partners.css' ?>">
    <?php endif; ?>
  </head>
  <body>
    <div class="" style="max-height:100vh;"><!-- wrapper. the closing tag is in the footer -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="<?php echo base_url() ?>">Pandalivery</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item <?php echo ($title == 'Transactions') ? 'active' : '' ?>">
            <a class="nav-link" href="<?php echo base_url().'transactions' ?>">Transactions</a>
          </li>
          <li class="nav-item <?php echo ($title == 'Partners') ? 'active' : '' ?>">
            <a class="nav-link" href="<?php echo base_url().'partners' ?>">Partners</a>
          </li>
        </ul>
      </div>
    </nav>
