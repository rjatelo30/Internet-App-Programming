<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Document</title>
</head>
<body>
 <form action="{{ url('/car') }}" method="POST" enctype="mutipart/form-data">
 @csrf
  Make: <input type="text" name="make" id="make" required>
  Model: <input type="text" name="model" id="model" required>
  Produced on: <input type="date" name="Produced_on" id="Produced_on" required>
  Image: <input type="file" name="image" id="image">
  <input type="submit" value="Submit">
 </form>
</body>
</html>
