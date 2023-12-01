<?php
// jesli uzytkownik nie jest zalogowany to przenosimy go na strone logowania
	session_start();
	
	if (!isset($_SESSION['islogged']))
	{
		header('Location: index.php');
		exit();
	}
	
	require_once 'connect.php';
	$conn = @new mysqli($servername, $username, $password, $dbname);
	mysqli_set_charset($conn, "utf8");
	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	}

	$ID = $_SESSION['ID'];
	
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
		<p class="content_title"> Available projects</p>
			<a href="one_addproject.php"> <!--Przycisk do projektu -->
				<button>Create new project</button>
			</a>
			<ul class="titles">
			<?php
			
			if (isset($_SESSION['admin'])){
				$q = "SELECT idprojects, title FROM projects";
				$result = $conn->query($q); 
			}
			else {
				$q = "SELECT idprojects, title FROM projects INNER JOIN projects_has_w_personal_data ON idprojects =  projects_idprojects WHERE `projects_has_w_personal_data`.`w_personal_data_id_personal_data` = ?;";
				$result = $conn->execute_query($q,[$ID]); 
			}
			
			
				while($row = mysqli_fetch_assoc($result))
				{
					echo "<li><a href='one_project.php?value_key=".$row['idprojects']."'>".$row['title']."</a></li>";
				}
				
				
				$result->free_result();
				$conn->close();
			?>
			</ul>		
		</section>
		
		<section class="results">
		<p class="communicate"> Select a project from the menu </p>
		</section>
		
	</main>
	
 
 </body>
 </html>