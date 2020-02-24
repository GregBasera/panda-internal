var cookieArrray = document.cookie.split(";");
for(var q = 0; q < cookieArrray.length; q++) {
  if(cookieArrray[q].split("=")[0] == 'sticky-date') {
    $('#for-sticky-date').val(cookieArrray[q].split("=")[1]);
  }
}
console.log(document.cookie);

console.log("general.js loaded");
