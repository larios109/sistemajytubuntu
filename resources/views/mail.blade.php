<!DOCTYPE html>
<html>
<head>
  <title>Mail Sending</title>
</head>
<body>
  <table align='center' style='height: 200px;width: 200px'>
   <tr><td colspan='2' bgcolor='skyblue' style='text-align: center;font-weight: 
  bold;size: 20px;'><label> Mail Check </label></td></tr>
   <tr bgcolor='#fff7e6'>
   <tr><td style='color: magenta;font-weight: bold;'><label><b>Your UserName:</b> 
 </label></td><td><b>{{$name}}</b></td></tr><br>
   <tr><td style='color: magenta;font-weight: bold;'><label><b>Your LoginID:</b> 
 </label></td><td><b>{{$userid}}</b></td></tr><br>
 <tr><td style='color: magenta;font-weight: bold;'><label><b>Your Password:</b> 
 </label></td><td><b>{{$password}}</b></td><br></tr>
</tr>
<tr><td colspan='2' align='center' bgcolor='orange'><a 
href='http://localhost/larashop/laravelProject/public/login'>
<button>Login</button></a></td></tr></table>
</body>
</html>