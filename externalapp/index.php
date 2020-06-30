<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">

 <script src="jquery.min.js"></script>
 <script type="text/javascript" src="../JS/placeholder.js"></script>

  <!-- Css -->
 <link rel="stylesheet" type="text/css" href="../Css/validate.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

 <!-- Bootstrap -->
 <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
 <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
 <title>Document</title>
</head>
<body>
<div class="container mt-5 mb-5">
 <p class="display-4">It is time to communicate with the exposed API, all we need is the API Key to be passed in the header</p>
 <br>
 <h4>1. Feature 1 - Placing an order</h4>

 <form name="order_form" id="order_form">
  <fieldset>
   <legend>Place Order</legend>
   <input type="text" name="name_of_food" id="name_of_food" required placeholder="Name of Food"> <br>
   <input type="number" name="number_of_units" id="number_of_units" required placeholder="Number of units"><br>
   <input type="number" name="unit_price" id="unit_price" required placeholder="Unit Price"><br><br>
   <input type="hidden" name="status" id="status" required value="Order Placed"><br><br>

   <button class="btn btn-primary" id="btn-place-order" type="submit">Place Order</button>

  </fieldset>
 </form>

 <hr>
 <h4>2. Feature 2 - Checking order status</h4>
 <hr>
 <form name="order_status form" id="order_status form" action="<?=$_SERVEER['PHP_SELF']?>" method="post">
 <fieldset>
  <legend>check order status</legend>
  <input type="number" name="order_id" id="order_id" required placeholder="Order ID"><br><br>

  <button class="btn btn-warning" type="submit">Check Order Status</button>
 </fieldset>
 </form>
</div>
</body>
</html>