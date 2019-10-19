function addTransaction() {
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
    't_dispatcher' : document.transaction.t_dispatcher.value
  };

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

  console.log(transaction);
  console.log(order);
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
  for(var q = 0; q < fields.length; q++) {
    sum = sum + parseFloat(fields[q].value);
  }
  document.transaction.t_subtotal.value = sum.toFixed(2);
}

function getGrandT() {
  var grand = parseFloat(document.transaction.t_subtotal.value) + parseFloat(document.transaction.t_dcharge.value);
  document.transaction.t_grandT.value = grand.toFixed(2);
}

console.log("transacions.js loaded");
