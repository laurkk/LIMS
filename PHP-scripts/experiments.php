<?php
// jesli uzytkownik nie jest zalogowany to przenosimy go na strone logowania
	session_start();
	
	if (!isset($_SESSION['islogged']))
	{
		header('Location: index.php');
		exit();
	}
	
	$ID = $_SESSION['ID'];
	
	require_once 'connect.php';
	$conn = @new mysqli($servername, $username, $password, $dbname);
	mysqli_set_charset($conn, "utf8");
	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	}

?>
 
 <!DOCTYPE html>
 <html>
 <head>
 
	<meta charset="utf-8" />
	<title> Home Page | LIMS </title>
	
	<link rel="stylesheet" href="style.css" type="text/css" />
	
	
 </head>
 
 
 <body>
 
 
	
	<header>
		
		<h1 class="logo">LIMS</h1>
		<h4 class="logo">Lab Information Management System <p class="out"> <a href="logout.php">Log out!</a></p>
		</h4>
		

		
		<nav>
			<ul class="menu">
			<li><a href="projects.php">Projects</a></li>
			<?php 
			if (isset($_SESSION['admin'])){
				echo "<li><a href='patients.php'>Patients</a></li>";
				echo "<li><a href='samples.php'>Samples</a></li>";}
			?>
			<li><a href="experiments.php">Experiments</a></li>
			<li><a href="equipment.php">Equipment</a></li>
			</ul>
		</nav>
	
	</header>	
	
	<main>	
	
		<section class="content">	
		<p class="content_title"> Experiments </p>
			<a href="one_addexperiment.php">
				<button>Add Experiment</button>
			</a>
			<ul class="titles">
			<?php
			
			if (isset($_SESSION['admin'])){
				$q = "SELECT idexperiments, name FROM `experiments`";
				$result = $conn->query($q); 
			}
			else {
				$q = "SELECT idexperiments, name FROM `experiments` INNER JOIN projects ON projects_idprojects = idprojects INNER JOIN projects_has_w_personal_data ON projects_has_w_personal_data.projects_idprojects = idprojects WHERE projects_has_w_personal_data.w_personal_data_id_personal_data = '$ID';";
				$result = $conn->query($q); 
			}
			
				while($row = mysqli_fetch_assoc($result))
				{
					echo "<li><a href='one_experiment.php?value_key=".$row['idexperiments']."'>".$row['name']."</a></li>";
				}
				$result->free_result();
				$conn->close();
			?>
			</ul>		
		</section>
		
		<section class="results">
		<p class="communicate"> Select an experiment from the menu </p>
		</section>
		
	</main>
	
 
 </body>
 </html>