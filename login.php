<?php

$host="localhost";
$user="root";
$password="";
$db="register"; 

session_start();
if(isset($_SESSION['alert_message'])) {
  echo '<script>alert("' . $_SESSION['alert_message'] . '");</script>';
  
  unset($_SESSION['alert_message']);
}

$data=mysqli_connect($host,$user,$password,$db);

if($data===false)
{
	die("connection error");
}

if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$username=$_POST["username"];
	$password=$_POST["password"];

	$sql="SELECT * FROM users WHERE username='".$username."' AND password='".$password."' "; 

	$result=mysqli_query($data,$sql);

	$row=mysqli_fetch_array($result);

	if($row)
	{	
		$_SESSION["username"]=$username;

		if($row["usertype"]=="user")
		{	
			header("location: booking.php");
		}
		elseif($row["usertype"]=="admin")
		{
			header("location: admin.php");
		}
		else {
      
      $_SESSION['alert_message'] = "Invalid usertype.";
      header("location: login.php"); 
  }
} else {
  
  $_SESSION['alert_message'] = "Invalid username or password.";
  header("location: login.php");
}
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>login</title>
<style>
 body {
  margin: 0;
  padding: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 30%;
  border-radius: 50%;
}

.container {
  text-align: center;
  color: #fff;
}

.hotel-name {
  font-size: 36px;
}

.login-form {
  background: rgba(255, 255, 255, 0.2);
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.7);
}

.login-form h2 {
  font-size: 24px;
  margin-bottom: 20px;
}

input[type="text"],
input[type="password"] {
  width: 90%;
  padding: 10px;
  margin: 10px 0;
  border: none;
  border-radius: 5px;
}

.btn {
  display: block;
  width: 80px; 
  margin: 0 auto; 
  padding: 10px;
  background: #27ae60;
  color: #fff;
  text-decoration: none;
  border: none;
  border-radius: 5px;
  font-weight: bold;
}


.btn:hover {
  background: #1d8348;
}
</style>
</head>
<body  background="images\login.jpg" style="background-repeat:no-repeat;background-size:cover;">
    <div class="container">
        <h1 class="hotel-name">Moonlight Inn</h1>
        <form class="login-form" action="#" method="POST">
            <h2>Login</h2>
            <div class="imgcontainer">
              <img src="images\img.png" alt="Avatar" class="avatar">
            </div>
            <input type="text" name="username" placeholder="Enter Username" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <input type="submit" value="login" class="btn">
        </form>
    </div>
</body>
</html>