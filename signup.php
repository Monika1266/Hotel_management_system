<?php

    $host="localhost";
    $user="root";
    $password="";
    $db="register";
    
    session_start();
    if(isset($_SESSION['error_message'])) {
  
      echo '<script>alert("' . $_SESSION['error_message'] . '");</script>';
  
      unset($_SESSION['error_message']);
  }
    
    $conn = mysqli_connect($host,$user,$password,$db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];

    $sql = "INSERT INTO users (username, email, password) VALUES ('$name', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
      header("Location: login.php");
      exit();
    } else {
    
      $_SESSION['error_message'] = "Error: " . $sql . "<br>" . $conn->error;
      
      header("Location: signup.php");
      exit(); 
  }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>signup</title>
<style>
 body {
  margin: 0;
  padding: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
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
input[type="email"],
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
            <h2>Register</h2>
            <div class="form-group">
                <label for="name">Username:</label>
                <input type="text" id="name" name="name" placeholder="Enter Username" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter email" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm_password" required>
            </div>

            <input type="submit" value="Sign in" class="btn">
        </form>
    </div>
</body>
</html>