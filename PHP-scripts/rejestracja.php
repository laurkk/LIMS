<?php 


	session_start();

	// walidacja- sprawdzamy najpierw obojetnie jaka zmienna zeby sprawdzic czy zostal przeslany formularz
	if (isset($_POST['email']))
	{
		//Flaga, ktora mowi nam ze wszystko ok, ale zmieni sie na false jesli cos pojdzie nie tak
		$wszystko_OK=true;
		
		//czy wprowadzono imie
		$name = $_POST['name'];
		$name = htmlentities($name, ENT_QUOTES, "UTF-8");
		
		if ((strlen($name)<2) || (strlen($name)>30))
		{
			$wszystko_OK=false;
			$_SESSION['err_name']="Please, enter correct name.";
		}
		
		$surname = htmlentities($_POST['surname'], ENT_QUOTES, "UTF-8");

		
		if ((strlen($surname)<2) || (strlen($surname)>40))
		{
			$wszystko_OK=false;
			$_SESSION['err_surname']="Please, enter correct surname.";
		}
		
		$idposition = $_POST['position'];
		
		if ($idposition == '---')
		{
			$wszystko_OK=false;
			$_SESSION['err_position']="Please, select your position.";
		}
		
		//poprawność nickname'a

		$user_name = htmlentities($_POST['user_name', ENT_QUOTES, "UTF-8");
		
		//Sprawdzenie długości nicka minimum 3 max 20 znakow
		if ((strlen($user_name)<3) || (strlen($user_name)>20))
		{
			$wszystko_OK=false;
			$_SESSION['err_user_name']="Username must be 3-20 characters long.";
		}
		//Tylko znaki alfanumeryczne
		if (ctype_alnum($user_name)==false)
		{
			$wszystko_OK=false;
			$_SESSION['err_user_name']="Special characters are forbidden.";
		}
		
		// Sprawdź poprawność adresu email
		$email = htmlentities($_POST['email', ENT_QUOTES, "UTF-8");
		
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
		{
			$wszystko_OK=false;
			$_SESSION['err_email']="Enter correct e-mail, please.";
		}
		
		//Sprawdzamy poprawność hasła
		
		$password1 = htmlentities($_POST['password1', ENT_QUOTES, "UTF-8");
		$password2 = htmlentities($_POST['password2', ENT_QUOTES, "UTF-8");
		
		if ((strlen($password1)<8) || (strlen($password1)>20))
		{
			$wszystko_OK=false;
			$_SESSION['err_password']="Password must be 8-20 characters long.";
		}
		
		if ($password1!=$password2)
		{
			$wszystko_OK=false;
			$_SESSION['err_password']="Your passwords don't match!";
		}	
		
		#hashujemy elegancko haslo
		$password_hash = password_hash($password1, PASSWORD_DEFAULT);
					
		
		
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try 
		{
			$conn = @new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{	
				
				
				//Czy email już istnieje?
				$result = $conn->query("SELECT iddane_logowania FROM login_data WHERE mail='$email'");
				
				if (!$result) throw new Exception($conn->error);
				
				$ile_takich_maili = $result->num_rows;
				if($ile_takich_maili>0)
				{
					$wszystko_OK=false;
					$_SESSION['err_email']="This e-mail is already used!";
				}		

				//Czy nick jest już zarezerwowany?
				
				if (!$result) throw new Exception($conn->error);
				
				$ile_takich_nickow = $result->num_rows;
				if($ile_takich_nickow>0)
				{
					$wszystko_OK=false;
					$_SESSION['err_user_name']="This username is already used.";
				}
				

				//$result = $conn->query("SELECT iddane_logowania FROM login_data WHERE idposition='$idposition'");
				//if (!$result) throw new Exception($conn->error);


									// First INSERT statement
$query1 = "INSERT INTO w_personal_data (name, surname, position_idposition) VALUES ('$name', '$surname', $idposition)";
$result1 = $conn->query($query1);

if ($result1) {
  // Get the last inserted ID from the first query
  $lastInsertId = $conn->insert_id;

  // Second INSERT statement
  $query2 = "INSERT INTO login_data (w_personal_data_idwokers_data, user_name, password, mail) VALUES ('$lastInsertId', '$user_name', '$password_hash', '$email')";
  $result2 = $conn->query($query2);

  if ($result2) {
    $_SESSION['success'] = true;
    header('Location: home.php');
  } else {
    throw new Exception($conn->error);
  }
} else {
  throw new Exception($conn->error);
}
				
		
				

				
				$conn->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Server error, try again later!</span>';
			echo '<br />Details: '.$e;
		}
		
	}
	
	
?>

<!DOCTYPE html>
<html>

 <head>
 
	<meta charset="utf-8" />
	<title> Register to LIMS </title>
	
	<link rel="stylesheet" href="style.css" type="text/css" />
	
	
 </head>


<body>

	<form method="post" class="register-form">
	<h2>Register to LIMS</h2>
	
		Name: <br /> <input type="text" value="<?php
			if (isset($_SESSION['name']))
			{
				echo $_SESSION['name'];
				unset($_SESSION['name']);
			}
		?>" name="name" /><br />
		
		<?php //jezeli jest blad to wyswietl jego wartosc na ekranie
			if (isset($_SESSION['err_name']))
			{
				echo '<div class="error">'.$_SESSION['err_name'].'</div>';
				unset($_SESSION['err_name']);
			}
		?>
		
		Surname: <br /> <input type="text" value="<?php
			if (isset($_SESSION['surname']))
			{
				echo $_SESSION['surname'];
				unset($_SESSION['surname']);
			}
		?>" name="surname" /><br />
		
		<?php
			if (isset($_SESSION['err_surname']))
			{
				echo '<div class="error">'.$_SESSION['err_surname'].'</div>';
				unset($_SESSION['err_surname']);
			}
		?>
		
		<?php
		require_once "connect.php";
		$conn = @new mysqli($servername, $username, $password, $dbname);
		$results = $conn->query("SELECT * FROM `position` WHERE idposition != 6"); ?>		
		
		
		<label for="position">Position:</label><br />
		<select id="position" name="position">
		<option value="0" selected>---</option>
		<?php
		while($rows = $results -> fetch_assoc())
		{
			echo "<option value='".$rows['idposition']."'>".$rows['position_name']."</option>";
		}
		$conn -> close();
		?>
		</select><br />
		
		<?php //jezeli jest blad to wyswietl jego wartosc na ekranie
			if (isset($_SESSION['err_position']))
			{
				echo '<div class="error">'.$_SESSION['err_position'].'</div>';
				unset($_SESSION['err_position']);
			}
		?>
			
		
		Username: <br /> <input type="text" value="<?php
			if (isset($_SESSION['user_name']))
			{
				echo $_SESSION['user_name'];
				unset($_SESSION['user_name']);
			}
		?>" name="user_name" /><br />
		
		<?php 
			if (isset($_SESSION['err_user_name']))
			{
				echo '<div class="error">'.$_SESSION['err_user_name'].'</div>';
				unset($_SESSION['err_user_name']);
			}
		?>		
		
		E-mail: <br /> <input type="text" value="<?php
			if (isset($_SESSION['email']))
			{
				echo $_SESSION['email'];
				unset($_SESSION['email']);
			}
		?>" name="email" /><br />
		
		<?php
			if (isset($_SESSION['err_email']))
			{
				echo '<div class="error">'.$_SESSION['err_email'].'</div>';
				unset($_SESSION['err_email']);
			}
		?>
		
		Password: <br /> <input type="password"  value="<?php
			if (isset($_SESSION['password1']))
			{
				echo $_SESSION['password1'];
				unset($_SESSION['password1']);
			}
		?>" name="password1" /><br />
		
		<?php
			if (isset($_SESSION['err_password']))
			{
				echo '<div class="error">'.$_SESSION['err_password'].'</div>';
				unset($_SESSION['err_password']);
			}
		?>		
		
		Repeat password: <br /> <input type="password" value="<?php
			if (isset($_SESSION['password2']))
			{
				echo $_SESSION['password2'];
				unset($_SESSION['password2']);
			}
		?>" name="password2" /><br /><br />
		
		
		
		<input type="submit" value="Register" />
		
	</form>

  

  
</body>
</html>
