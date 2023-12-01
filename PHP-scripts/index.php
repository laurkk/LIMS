<?php

	session_start();
//jesli jestem zalogowany to przeniesie mnie na strone glowna
	if ((isset($_SESSION['islogged'])) && ($_SESSION['islogged']==true))
	{
		header('Location: home.php');
		exit();
	}
	
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login to LIMS</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 100px;
      padding: 20px;
      background-color: #f4f4f4;
    }
    
    h1 {
      text-align: center;
    }
    
    .container {
      max-width: 400px;
      margin: 0 auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    
    label, input {
      display: block;
      margin-bottom: 10px;
    }
    
    input[type="submit"] {
      background-color: #4CAF50;
      color: #fff;
      border: none;
      padding: 10px;
      width: 100%;
      cursor: pointer;
    }
	.reg{
	  background-color: darkgreen;
      color: #fff;
      border: none;
      padding: 10px;
      max-width: 100%;
      cursor: pointer;
	  text-align:center;
	  margin: auto;
	  font-size: 14px;
	}
	.reg a{
		color: #fff;
		text-decoration: none;	
	}
  </style>
</head>
<body>
  <div class="container">
    <h1>Welcome to LIMS! Login, please.</h1>
    <form action="login.php" method="post">
      <label for="username">Username</label>
      <input type="text" id="username" name="username" required>
      
      <label for="password">Password</label>
      <input type="password" id="password" name="password" required>
      
      <input type="submit" value="Log In">
    </form>
	
	<div class="reg">
	<a href="rejestracja.php">Register</a>
	</div>
	
	<?php
	if(isset($_SESSION['blad'])) echo $_SESSION['blad'];
?>
	
  </div>
  

  
</body>
</html>
