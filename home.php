<!DOCTYPE html>
<html>
<head>
    <title>home</title>
    <style>
body {
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    position: relative; 
}

.container {
    text-align: center;
    color: #1d1b1b;
}

.buttons {
    position: absolute; 
    top: 10px; 
    right: 10px; 
}

.btn {
    display: inline-block;
    padding: 10px 20px;
    background: #27ae60;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    margin: 10px;
    font-weight: bold;
}

.hotel-name {
  font-family: Arial, sans-serif; 
  font-size: 50px; 
  font-weight: bold; 
  font-style: italic;
  color: #000066; 
}

.tagline {
  font-family: 'Times New Roman', serif; 
  font-size: 25px; 
  font-style: italic; 
  color: black; 
}

.hotl {
  font-family: Roboto, sans-serif; 
  font-size: 36px;
  font-weight: bold;
  font-style: italic;
  color: black; 
}

</style>
</head>
<body background="images\home.jpg" style="background-repeat:no-repeat;background-size:cover;">
<div class="buttons">
    <a href="signup.php" class="btn">Sign Up</a>
    <a href="login.php" class="btn">Login</a>
</div>    
<div class="container">
        <h1 class="hotel-name">MOONLIGHT INN</h1>
        <p class="tagline">Your Comfort, Our Priority</p>
        <p class="hotl">A Place where service is an attitude...</p>
        <p class="hotl"> Luxury is a standard...</p>
        <p class="hotl"> Hospitality is a tradition...</p>
        <p class="tagline"> Experience comfort, Embrace luxury.</p>
</div>
</body>
</html>
