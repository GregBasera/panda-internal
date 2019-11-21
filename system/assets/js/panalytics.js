// Daily Transactions
$.ajax({
  type: "GET",
  url: window.origin + "/analytics/varsForDailyTran",
  // data: data,
  // beforeSend: function() {
  //   $('#spinner').show();
  // },
  success: function(result) {
    // $(location).attr('href', window.origin + '/transactions/view');
    result = JSON.parse(result);

    var labels = [];
    var dataDeli = [];
    var dataCanc = [];
    for(var q = 0; q < result.length; q++) {
      labels.push(result[result.length-q-1]['date']);
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
  }
});

// Top 20 Partners
$.ajax({
  type: "GET",
  url: window.origin + "/analytics/varsForTop20",
  // data: data,
  // beforeSend: function() {
  //   $('#spinner').show();
  // },
  success: function(result) {
    // $(location).attr('href', window.origin + '/transactions/view');
    result = JSON.parse(result);

    var labels = [];
    var onRecord = [];
    for(var q = 0; q < result.length; q++) {
      labels.push(result[result.length-q-1]['partner_name']);
      onRecord.push(parseInt(result[result.length-q-1]['trans']));
    }
    // console.log(labels);

    var ctx = document.getElementById('topPartners').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: 'Transactions on record',
          data: onRecord,
          backgroundColor: 'rgba(75, 192, 92, 0.5)',
          borderColor: 'rgba(75, 192, 92, 1)',
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
          text: 'Top 20 Partners'
        }
      }
    });
  }
});

console.log("analytics.js loaded");
