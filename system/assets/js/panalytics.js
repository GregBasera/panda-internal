$('#dailyTranSpin').hide();
$('#topPartnersSpin').hide();
$('#barangaysSpin').hide();

function hitSearchArray(obj) {
  var hits = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
  var keys = [
    "Abella", "Bagumbayan", "Balatas", "Calauag", "Cararayan", "Carolina", "Concepcion", "Dayangdang",
    "Del Rosario", "Dinaga", "Igualdad", "Lerma", "Liboton", "Mabolo", "Pacol", "Panicuason", "Penafrancia",
    "Sabang", "San Felipe", "San Francisco", "San Isidro", "Santa Cruz", "Tabuco", "Tinago", "Triangulo"
  ];

  for(var q = 0; q < obj.length; q++) {
    for(var w = 0; w < keys.length; w++) {
      if(obj[q]['postal'].toLowerCase().search(keys[w].toLowerCase()) != -1) {
        hits[w] = hits[w] + 1;
      }
    }
  }

  // console.log(hits);
  // console.log(keys);
  return hits
}

// Daily Transactions
$.ajax({
  type: "GET",
  url: window.origin + "/analytics/varsForDailyTran",
  // data: data,
  beforeSend: function() {
    $('#dailyTranSpin').show();
  },
  success: function(result) {
    // $(location).attr('href', window.origin + '/transactions/view');
    result = JSON.parse(result);

    var labels = [];
    var dataDeli = [];
    var dataCanc = [];
    for(var q = 0; q < result.length; q++) {
      expDate = result[result.length-q-1]['date'].split('-');
      labels.push(expDate[1] + '-' + expDate[2]);

      dataDeli.push(parseInt(result[result.length-q-1]['delivered']));
      dataCanc.push(parseInt(result[result.length-q-1]['cancelled']));
    }

    var ctx = document.getElementById('dailyTran').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: labels,
        datasets: [{
          label: 'Canceled',
          data: dataCanc,
          backgroundColor: '#FF655C',
          borderColor: 'red',
          borderWidth: 2
        }, {
          label: 'Delivered',
          data: dataDeli,
          backgroundColor: 'lightgreen',
          borderColor: 'green',
          borderWidth: 2
        }]
      },
      options: {
        legend: {
          position: 'bottom'
        },
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            },
            stacked: true
          }]
        },
        title: {
          display: true,
          text: 'Daily Transactions [30-day range]'
        }
      }
    });
    $('#dailyTranSpin').hide();
  }
});

// Top 20 Partners
$.ajax({
  type: "GET",
  url: window.origin + "/analytics/varsForTop20",
  // data: data,
  beforeSend: function() {
    $('#topPartnersSpin').show();
  },
  success: function(result) {
    // $(location).attr('href', window.origin + '/transactions/view');
    result = JSON.parse(result);

    var labels = [];
    var onRecord = [];
    for(var q = 0; q < result.length; q++) {
      labels.push(result[q]['partner_name']);
      onRecord.push(parseInt(result[q]['trans']));
    }
    // console.log(labels);

    var ctx = document.getElementById('topPartners').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'horizontalBar',
      data: {
        labels: labels,
        datasets: [{
          label: 'Transactions on record',
          data: onRecord,
          backgroundColor: 'lightgreen',
          borderColor: 'green',
          borderWidth: 1
        }]
      },
      options: {
        legend: {
          position: 'bottom'
        },
        scales: {
          xAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        },
        title: {
          display: true,
          text: 'Top 20 Partners'
        }
      }
    });
    $('#topPartnersSpin').hide();
  }
});

$.ajax({
  type: 'GET',
  url: window.origin + "/analytics/varsForPerBarang",
  // data: data,
  beforeSend: function() {
    $('#barangaysSpin').show();
  },
  success: function(result) {
    hits = hitSearchArray(JSON.parse(result))

    var ctx = document.getElementById('barangays').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [
          "Abella",
          "Bagumbayan N/S",
          "Balatas",
          "Calauag",
          "Cararayan",
          "Carolina",
          "Concepcion GR/PE",
          "Dayangdang",
          "Del Rosario",
          "Dinaga",
          "Igualdad",
          "Lerma",
          "Liboton",
          "Mabolo",
          "Pacol",
          "Panicuason",
          "Peñafrancia",
          "Sabang",
          "San Felipe",
          "San Francisco",
          "San Isidro",
          "Santa Cruz",
          "Tabuco",
          "Tinago",
          "Triangulo"
        ],
        datasets: [{
          label: 'Text Hits',
          data: hits,
          backgroundColor: 'lightgreen',
          borderColor: 'green',
          borderWidth: 1
        }]
      },
      options: {
        legend: {
          position: 'bottom'
        },
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        },
        title: {
          display: true,
          text: 'Per Barangays'
        }
      }
    });
    $('#barangaysSpin').hide();
  }
});

console.log("analytics.js loaded");
