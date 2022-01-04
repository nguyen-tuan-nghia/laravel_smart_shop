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
{{--   <img src="/w3images/hamburger.jpg" alt="Avatar" style="width:100%;">
 --}}  <div class="container" style="background-color:white">
  @if($coupon_condition==1)
    <h2><b>{{$coupon_number}}% SALE OFF</b></h2>
  @else
       <h2><b>{{number_format($coupon_number,0,',','.')}}VNĐ SALE OFF</b></h2>
  @endif
    <p>{{$name}}</p>
  </div>
  <div class="container">
    <p>Mã giamr giá: <span>{{$code}}</span></p>
    <p class="expire">Hết hạn: {{$end}}</p>
  </div>
</div>

</body>
</html> 
