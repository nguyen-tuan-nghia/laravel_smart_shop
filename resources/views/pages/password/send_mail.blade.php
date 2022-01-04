<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Gửi mai</title>
</head>
<style>
body{
	font-size: 20px;
}
.send{
  border: 1px solid;
  padding: 10px;
  box-shadow: 5px 10px 8px 10px #888888;
}
</style>
<body>
	<div class="send">
			<p><strong>Smart shop:</strong></p>
			<p>Xin chào: {{$name}}</p>
			<p>Hãy vào link trên để thay đổi mật khẩu của bạn: {{$link}}</p>
	</div>
</body>
</html>