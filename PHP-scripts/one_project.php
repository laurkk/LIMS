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
				<button>Add Experiment</button>
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
		
		<?php
		
				
			if(isset($_GET['value_key'])){
			$idproject=$_GET['value_key'];} // pobieranie wybranego id projektu 

			$q = "SELECT title, project_status.status, description, budget, w_personal_data.name, w_personal_data.surname, start_date, end_date, key_words FROM `projects` INNER JOIN w_personal_data ON projects.w_personal_data_idwokers_data = w_personal_data.id_personal_data INNER JOIN project_status ON project_status_idproject_status = idproject_status WHERE idprojects =? ;";
			$result = $conn->execute_query($q, [$idproject]);
			
			$row = mysqli_fetch_assoc($result);
			$result->free_result();
		?>	
		<h1 class="result_title"> <?php echo $row['title'] ?></h1>
		<b>STATUS: </b><?php echo $row['status'] ?> <br> <br>
		<b>DURATION: </b><?php echo $row['start_date']." - ".$row['end_date']  ?> <br> <br>
		<b>BUDGET: </b><?php echo $row['budget'] ?> <br> <br>
		<b>PROJECT MANAGER: </b> <?php echo $row['surname']." ".$row['name'] ?>  <br> <br>
		<b>PARTICIPANTS: </b> 
		<?php 
		
		$q = "SELECT name, surname FROM `projects_has_w_personal_data` INNER JOIN w_personal_data ON w_personal_data_id_personal_data = id_personal_data WHERE projects_idprojects = ?;";
		$result = $conn->execute_query($q, [$idproject]);
		
		while($part = mysqli_fetch_row($result))
			{
				foreach($part as $col)
				{
					echo "$col ";

				}
			}
			$result->free_result();
		 ?>  <br> <br>
		<b>DESCRIPTION: </b><?php echo $row['description'] ?> <br> <br>
		<em>Key-words: <?php echo $row['key_words'] ?></em>
		
		
		
		<?php
			//$idproject->free_result();
			$conn->close();
		?>

		</section>
		

	
	</main>
	
 
 </body>
 </html>