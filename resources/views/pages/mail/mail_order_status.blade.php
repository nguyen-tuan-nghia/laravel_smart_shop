<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial;
}

.coupon {
  border: 5px dotted #bbb;
  width: 80%;
  border-radius: 15px;
  margin: 0 auto;
  max-width: 600px;
}

.container {
  padding: 2px 16px;
  background-color: #f1f1f1;
}

.promo {
  background: #ccc;
  padding: 3px;
}

.expire {
  color: red;
}
</style>
</head>
<body>

<div class="coupon">
  <div class="container">
    <h3>Smart Shop</h3>
  </div>
   <div class="container" style="background-color:white">
    <p><span>{{$code}}</span></p>
  </div>
</div>
</body>
</html> 