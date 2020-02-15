$('#transactionFormAlert').hide();
$('#spinner').hide();

$('#dailyMod').hide();
$('#monthlyMod').hide();
$('#yearlyMod').hide();

$('#del_spinner').hide();
$('#edit_spinner').hide();

// $('.multi-transac-preview-modal').modal('toggle');

function removeTransacModal() {
  $('.add-transac-modal').modal('hide');
}

function isDeliv() {
  $("#isDeliv").html((document.transaction.isDelivered.checked == true) ? "Delivered" : "Cancelled");
  $("#deliv").html((document.Print.isDelivered.checked == true) ? "Delivered" : "Cancelled");
  $("#e_isDeliv").html((document.getElementById('e_isDelivered').checked == true) ? "Delivered" : "Cancelled");
}

function addTransaction() {
  $('#transactionFormAlert').hide();
  var isValid = true;

  var transaction = {
    't_datetime' : document.transaction.t_date.value+' '+document.transaction.t_time.value,
    'c_fname' : document.transaction.c_fname.value,
    'c_lname' : document.transaction.c_lname.value,
    'c_contact' : document.transaction.c_contact.value,
    'c_address' : document.transaction.c_address.value,
    'c_directions' : document.transaction.c_directions.value,
    't_partner' : document.transaction.t_partner.value,
    't_subtotal' : document.transaction.t_subtotal.value,
    't_dcharge' : document.transaction.t_dcharge.value,
    't_grandT' : document.transaction.t_grandT.value,
    't_ordernum' : document.transaction.t_ordernum.value,
    't_dispatched_by' : document.transaction.t_dispatched_by.value,
    't_encoded_by' : document.transaction.t_encoded_by.value,
    't_isDelivered' : (document.transaction.isDelivered.checked == true) ? 'true' : 'false'
  };console.log(transaction);

  var order = new Array(document.getElementsByName("i_price").length);
  if(order.length == 1){ // one item entry requires diff proccess due to html restictions
    order[0] = {
      'i_quantity' : document.transaction.i_quantity.value,
      'i_name' : document.transaction.i_name.value,
      'i_price' : document.transaction.i_price.value
    };
  } else { // many item entry requires diff proccess due to html restictions
    for(var q = 0; q < order.length; q++) {
      order[q] = {
        'i_quantity' : document.transaction.i_quantity[q].value,
        'i_name' : document.transaction.i_name[q].value,
        'i_price' : document.transaction.i_price[q].value
      };
    }
  }

  Object.keys(transaction).forEach(function (key) {
    if (transaction[key] == '') {
      $('#transactionFormAlert').html('One or more input field seems to be empty.');
      $('#transactionFormAlert').show();
      isValid = false;
    }
    if (key == 'c_contact' && !(transaction[key].match(/^(09|\+639)\d{9}$/))) {
      $('#transactionFormAlert').html("Sorry, one of those phone numbers might be invalid.");
      $('#transactionFormAlert').show();
      isValid = false;
    }
    if ((key == 't_subtotal' || key == 't_dcharge' || key == 't_grandT' || key == 't_ordernum') && !(transaction[key].match(/^\d*\.?\d*$/))) {
      $('#transactionFormAlert').html("A Non-numeric input was detected in an input field that expects numeric inputs.");
      $('#transactionFormAlert').show();
      isValid = false;
    }
  });

  for(var q = 0; q < order.length; q++) {
    Object.keys(order[q]).forEach(function (key) {
      if (order[q][key] == '') {
        $('#transactionFormAlert').html('One or more input field seems to be empty.');
        $('#transactionFormAlert').show();
        isValid = false;
      }
      if ((key == 'i_quantity' || key == 'i_price') && !(order[q][key].match(/^\d*\.?\d*$/))) {
        $('#transactionFormAlert').html('A Non-numeric input was detected in an input field that expects numeric inputs.');
        $('#transactionFormAlert').show();
        isValid = false;
      }
    });
  }

  if (isValid) {
    var data = {'t' : transaction, 'o' : order};
    $.ajax({
      type: "POST",
      url: window.origin + "/transactions/addTransaction/t",
      data: data,
      beforeSend: function() {
        $('#spinner').show();
      },
      success: function(result) {
        // $(location).attr('href', window.origin + '/transactions/view');
        $('.add-transac-modal').modal('hide');
        $('#transactionFormAlert').hide();
      }
    });
  }
}

function addItem() {
  var itemRow = '<div class="row mt-2"><div class="col-3 pr-1"> <input class="form-control form-control-sm text-center" type="number" name="i_quantity" value="" placeholder="Quantity"></div><div class="col px-1"> <input class="form-control form-control-sm" type="text" name="i_name" value="" placeholder="Item Name"></div><div class="col-2 px-1"> <input class="form-control form-control-sm text-center" type="text" name="i_price" value="" placeholder="Price" onkeyup="getSubtotal();getGrandT();"></div><div class="col-auto pl-1"> <button class="btn btn-danger btn-sm" type="button" name="button" onclick="removeItem(this);getSubtotal();getGrandT();"> <i class="fa fa-times"></i> </button></div></div>';
  $(itemRow).appendTo('#orders');
}

function removeItem(elem) {
  $(elem).parent().parent().remove();
}

function getSubtotal() {
  var sum = 0.0;
  var fields = document.getElementsByName("i_price");
  var quantity = document.getElementsByName("i_quantity");
  for(var q = 0; q < fields.length; q++) {
    sum = sum + (parseFloat(fields[q].value) * parseFloat(quantity[q].value));
  }
  document.transaction.t_subtotal.value = sum.toFixed(2);
}

function getGrandT() {
  var grand = parseFloat(document.transaction.t_subtotal.value) + parseFloat(document.transaction.t_dcharge.value);
  document.transaction.t_grandT.value = grand.toFixed(2);
}

function kindToMod() {
  $('#dailyMod').hide();
  $('#monthlyMod').hide();
  $('#yearlyMod').hide();
  var kind = document.Print.kind.value;

  if(kind == 'daily') {
    $('#dailyMod').show();
  } else if (kind == 'monthly') {
    $('#monthlyMod').show();
  } else if (kind == 'yearly') {
    $('#yearlyMod').show();
  }
}

// $(document.Print.sumContract).hide();
$('#labelCont').hide();
function reportSummary() {
  if(document.Print.partner.value == '') {
    document.Print.sumContract.checked = false;
    // document.Print.sumContract.disabled = true;
    // $(document.Print.sumContract).hide();
    $('#labelCont').hide();
  } else {
    // document.Print.sumContract.disabled = false;
    // $(document.Print.sumContract).show();
    $('#labelCont').show();
  }
}

function deleteModalTriggd(id) {
  $('#t_delete').attr('onclick', 't_delete("'+id+'");')
}

function editModalTriggd(id) {
  $('#edit_spinner').show();
  var data = {'id' : id}
  $.ajax({
    type: "POST",
    url: window.origin + "/transactions/getForEdit",
    data: data,
    // beforeSend: function() {
    //   $('#spinner').show();
    // },
    success: function(result) {
      // $(location).attr('href', window.origin + '/transactions/view');
      var fromServer = JSON.parse(result);
      var datetime = fromServer[0]['transaction_date'].split(' ');

      $('#e_t_date').val(datetime[0]);
      $('#e_t_time').val(datetime[1]);
      $('#e_c_fname').val(fromServer[0]['customer_fname']);
      $('#e_c_lname').val(fromServer[0]['customer_lname']);
      $('#e_c_contact').val(fromServer[0]['customer_contact']);
      $('#e_c_address').val(fromServer[0]['delivery_address']);
      $('#e_c_directions').val(fromServer[0]['landmark_directions']);
      $('#e_t_partner').val(fromServer[0]['partner_ID']);
      $('#e_t_ordernum').val(fromServer[0]['order_number']);
      $('#e_t_dispatched_by').val(fromServer[0]['dispatched_by']);
      if(fromServer[0]['isDelivered'] == '1') {
        $('#e_isDelivered').attr('checked', 'true');
        isDeliv();
      }

      $('#edit_spinner').hide();
    }
  });

  $('#t_edit').attr('onclick', "t_edit('"+id+"')");
}

function t_delete(id) {
  console.log(id);
  var data = {'t_id' : id};
  $.ajax({
    type: "POST",
    url: window.origin + "/transactions/t_delete",
    data: data,
    beforeSend: function() {
      $('#del_spinner').show();
    },
    success: function(result) {
      $(location).attr('href', window.origin + '/transactions/view');
    }
  });
}

function t_edit(id) {
  var data = {
    'id' : id,
    'e_t_date' : document.getElementById('e_t_date').value,
    'e_t_time' : document.getElementById('e_t_time').value,
    'e_c_fname' : document.getElementById('e_c_fname').value,
    'e_c_lname' : document.getElementById('e_c_lname').value,
    'e_c_contact' : document.getElementById('e_c_contact').value,
    'e_c_address' : document.getElementById('e_c_address').value,
    'e_c_directions' : document.getElementById('e_c_directions').value,
    'e_t_partner' : document.getElementById('e_t_partner').value,
    'e_t_ordernum' : document.getElementById('e_t_ordernum').value,
    'e_t_dispatched_by' : document.getElementById('e_t_dispatched_by').value,
    'e_isDelivered' : (document.getElementById('e_isDelivered').checked == true) ? true : false
  };

  // console.log((document.getElementById('e_isDelivered').checked == true) ? "true" : "false");
  $.ajax({
    type: "POST",
    url: window.origin + "/transactions/t_edit",
    data: data,
    beforeSend: function() {
      $('#edit_spinner').show();
    },
    success: function(result) {
      $(location).attr('href', window.origin + '/transactions/view');
    }
  });
}

console.log("transacions.js loaded");
