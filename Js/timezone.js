var doc = (document).ready(function() {

 var offset = new Date().getTimezoneOffset();
 var timestamp = new Date().getTime();
 var utc_timestamp = timestamp + (6000 * offset);

 console.log(doc('#time_zone_offset').val(offset))
 console.log(doc('#utc_timestamp').val(utc_timestamp))

})
