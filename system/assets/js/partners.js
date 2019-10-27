$('#partnerFormAlert').hide();
$('#spinner').hide();

function addPartner() {
  $('#partnerFormAlert').hide();
  var isValid = true;

  var partner = {
    'p_name' : document.Partner.p_name.value,
    'p_address' : document.Partner.p_address.value,
    'p_contact' : document.Partner.p_contact.value,
    'p_email' : document.Partner.p_email.value,
    'o_name' : document.Partner.o_name.value,
    'o_contact' : document.Partner.o_contact.value,
    'o_email' : document.Partner.o_email.value,
    'p_percentage' : document.Partner.p_percentage.value,
    'p_execution' : document.Partner.p_execution.value
  };

  Object.keys(partner).forEach(function (key) {
    if (partner[key] == '') {
      $('#partnerFormAlert').html('One or more input field seems to be empty.');
      $('#partnerFormAlert').show();
      isValid = false;
    }
    if ((key == 'p_contact' || key == 'o_contact') && !(partner[key].match(/^(09|\+639)\d{9}$/))) {
      $('#partnerFormAlert').html("Sorry, one of those phone numbers might be invalid.");
      $('#partnerFormAlert').show();
      isValid = false;
    }
    if (key == 'p_percentage' && !(partner[key].match(/^\d*\.?\d*$/))) {
      $('#partnerFormAlert').html("Sorry, Contract Percentage must either be a whole or a decimal number.");
      $('#partnerFormAlert').show();
      isValid = false;
    }
    if ((key == 'p_email' || key == 'o_email') && !(partner[key].match(/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/))) {
      $('#partnerFormAlert').html("Sorry, that e-mail might be invalid.");
      $('#partnerFormAlert').show();
      isValid = false;
    }
  });

  if (isValid) {
    $.ajax({
      type: "POST",
      url: window.origin + "/partners/addPartner",
      data: partner,
      beforeSend: function() {
        $('#spinner').show();
      },
      success: function(result) {
        $(location).attr('href', window.origin + '/partners');
      }
    });
  }
}

console.log("patners.js loaded");
