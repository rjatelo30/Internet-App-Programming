// $(document).ready(function() {
//  $('#api-key-btn').click(function (event) {
//   var confirm_key = confirm ("You are about to generate a new API Key");

//   if(confirm_key){
//    $.ajax({
//     url: "../Php/apikey.php",
//     type: "post",
//     success: function(data){
//      if(data['success'] == 1){
//       //set key in textarea
//       $('#api_key').val(data['message']);
//      }else{
//       alert("Something went wrong. Please try again")
//      }
//     }
//    });
//   }
//  });
// });

/**
 * Function to produce UUID.
 * See: http://stackoverflow.com/a/8809472
 */
function generateUUID() {
 var d = new Date().getTime();

 if (window.performance && typeof window.performance.now === "function") {
  d += performance.now();
 }

 var uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
  var r = (d + Math.random() * 16) % 16 | 0;
  d = Math.floor(d / 16);
  return (c == 'x' ? r : (r & 0x3 | 0x8)).toString(16);
 });

 function Send_Data (uuid){
   var httpr = new XMLHttpRequest();
   httpr.open("POST", .)
 }

 return uuid;
}

/**
 * Generate new key and insert into input value
 */

 $('#keygen').on('click', function () {
  $('#apikey').val(generateUUID());
 });
