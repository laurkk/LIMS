<?php

	session_start();
// jezeli nie ma loginu i hasla w globalnej tablicy to przekierujemy na strone logowania	
	if ((!isset($_POST['username'])) || (!isset($_POST['password'])))
	{
		header('Location: index.php');
		exit();
	}

	
	//$servername = "localhost";
	//$username = "root";
//	$password = "";
	//$dbname = "mdb";
	require_once 'connect.php'; //zamiennie - wtedy dane laczenia z baza moga byc w innym pliku

	$conn = @new mysqli($servername, $username, $password, $dbname);

	// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the username and password from the form submission
$usernameInput = $_POST['username']; 
$passwordInput = $_POST['password'];

// zabezpieczenie przed wstrzykiwaniem SQL
$usernameInput = htmlentities($usernameInput, ENT_QUOTES, "UTF-8");
$passwordInput = htmlentities($passwordInput, ENT_QUOTES, "UTF-8");



$stmt = $conn->prepare("SELECT user_name, password, mail, id_personal_data, position_idposition FROM login_data INNER JOIN w_personal_data ON w_personal_data_idwokers_data = id_personal_data WHERE  user_name = ? AND password = ?");
$stmt->bind_param("ss", $usernameInput, $passwordInput);
$stmt->execute();

// znaleiony wiersz
$result = $stmt->get_result();

// sprawdzamy czy znaleziono uzytkownika w bazie
	if ($result->num_rows === 1) {

		$_SESSION['islogged']=true;
// tablica asocjacyjna przechowujaca wartosci ze znalezionego wiersza dotyczacego danych logowania uzytkownika	
		$login_data = $result->fetch_assoc();
		$_SESSION['id'] = $login_data['iddane_logowania'];
		$_SESSION['mail'] = $login_data['mail'];
		
		if ($login_data['position_idposition'] == 6){
			$_SESSION['admin'] = true;
		}
		$_SESSION['ID'] = $login_data['id_personal_data'];


	
		$result->free_result();
		unset($_SESSION['blad']);
		header('Location: home.php');
	
	} else {
// postepowanie w przypadku blednych danych logowania
		$_SESSION['blad'] = '<span style="color:red">Wrong login or password!</span>';
		header('Location: index.php');
	}

// zamykamy poloczenie
$stmt->close();
$conn->close();
?>