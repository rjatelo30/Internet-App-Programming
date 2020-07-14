<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Document</title>
</head>
<body>
 @foreach($car as $cars){
  <li> {{ $cars->make }} </li>
  <li> {{ $cars->model }} </li>
  <li> {{ $cars->Produced_on }}</li>
 }
 @endforeach
</body>
</html>