//create a form validation fuction to be called when the form is submitted

function validateForm(){
 var fname = document.forms["user_details"]["first_name"].value;
 var lname = document.forms["user_details"]["last_name"].value;
 var city = document.forms["user_details"]["city_name"].value;

 if (fname == null || lname == "" || city == ""){
  alert("Please fill out the form completely");
  return false;
 }
 return true;
}