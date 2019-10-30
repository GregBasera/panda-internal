<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Pandalivery - <?php echo $title ?></title>
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url().'assets/imgs/head-logo.png' ?>">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/general.css' ?>">

    <?php if ($title == 'Transactions'): ?>
      <!-- <link rel="stylesheet" href="<?php echo base_url().'assets/css/transactions.css' ?>"> -->
    <?php elseif ($title == 'Partners'): ?>
      <!-- <link rel="stylesheet" href="<?php echo base_url().'assets/css/partners.css' ?>"> -->
    <?php endif; ?>
  </head>
  <body>
    <div class="" style="max-height:100vh;"><!-- wrapper. the closing tag is in the footer -->
    <?php if ($title != 'Sign-in'): ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="<?php echo base_url() ?>">
        <img width="120px" class="" src="<?php echo base_url().'assets/imgs/wgt.png' ?>" alt="">
      </a>

      <ul class="navbar-nav mr-auto">
        <li class="nav-item <?php echo ($title == 'Transactions') ? 'active' : '' ?>">
          <a class="nav-link" href="<?php echo base_url().'transactions/view' ?>">Transactions</a>
        </li>
        <li class="nav-item <?php echo ($title == 'Partners') ? 'active' : '' ?>">
          <a class="nav-link" href="<?php echo base_url().'partners' ?>">Partners</a>
        </li>
      </ul>

      <div class="btn-group">
        <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <b><?php echo $user ?></b>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
          <a href="<?php echo base_url().'userlog/signout' ?>" class="dropdown-item">Sign-out</a>
        </div>
      </div>
    </nav>
    <?php endif; ?>
