$(document).ready(function() {
 $('#api-key-btn').click(function (event) {
  var confirm_key = confirm ("You are about to generate a new API Key");

  if(!confirm_key){
   return;
  }
  $.ajax({
   url: "apikey.php",
   type: "post",
   success: function(data){
    if(data['success'] == 1){
     //set key in textarea
     $('#api_key').val(data['message']);
    }else{
     alert("Something went wrong. Please try again")
    }
   }
  });
 });
});