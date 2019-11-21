    </div><!-- wrapper. the opening tag is in the header -->
  </body>

  <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script> -->
  <script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.4.1.min.js' ?>"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script type="text/javascript" src="<?php echo base_url().'assets/js/general.js' ?>"></script>

  <?php if ($title == 'Transactions' || $title == 'Search Results'): ?>
    <script type="text/javascript" src="<?php echo base_url().'assets/js/transactions.js' ?>"></script>
  <?php elseif ($title == 'Partners'): ?>
    <script type="text/javascript" src="<?php echo base_url().'assets/js/partners.js' ?>"></script>
  <?php elseif ($title == 'Analytics'): ?>
    <script type="text/javascript" src="<?php echo base_url().'assets/js/panalytics.js' ?>"></script>
  <?php endif; ?>

  <script type="text/javascript">
    $(function(){
      $('[data-toggle="popover"]').popover();
      $('[data-toggle="tooltip"]').tooltip();
    });
  </script>
</html>
