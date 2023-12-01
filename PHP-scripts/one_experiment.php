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
		<p class="content_title"> Experiments</p>
			<a href="one_addexperiment.php">
				<button>Add Experiment</button>
			</a>
			<ul class="titles">
			<?php
				if (isset($_SESSION['admin'])){
				$q = "SELECT idexperiments, name FROM experiments";
				$result = $conn->query($q); 
				}
				else {
					$q = "SELECT * FROM `experiments` RIGHT OUTER JOIN projects_has_w_personal_data USING (projects_idprojects) WHERE w_personal_data_id_personal_data = ?;";
					$result = $conn->execute_query($q,[$ID]); 
				}
			
			
				while($row = mysqli_fetch_assoc($result))
				{
					echo "<li><a href='one_experiment.php?value_key=".$row['idexperiments']."'>".$row['name']."</a></li>";
				}
				$result->free_result();
			?>
			</ul>		

		
		</section>
		
		<section class="results">
		
		<?php
		
				
			if(isset($_GET['value_key'])){
			$idexperiment=$_GET['value_key'];} // pobieranie wybranego id projektu 

			$q = "SELECT experiments.name, experiments.description as opis, execution_date, result, title AS projekt, method_of_experiment.name as metoda, lab_equipment.name AS used FROM `experiments`INNER JOIN projects ON projects_idprojects = idprojects INNER JOIN method_of_experiment ON method_of_experiment_idmethod_of_experiment = idmethod_of_experiment INNER JOIN lab_equipment ON used_equipment = idlab_equipment WHERE idexperiments =? ;";
			$result = $conn->execute_query($q, [$idexperiment]);
			
			$row = mysqli_fetch_assoc($result)
		?>	
		<h1 style="font-size: 35px";> <?php echo $row['name'] ?></h1>
		<b>PROJECT: </b><?php echo $row['projekt'] ?> <br> <br>
		<b>EXECUTED: </b><?php echo $row['execution_date']  ?> <br> <br>
		<b>DESCRIPTION: </b><?php echo $row['opis'] ?> <br> <br>
		<b>METHOD: </b><?php echo $row['metoda'] ?> <br> <br>
		<b>USED EQUIPMMENT: </b><?php echo "DO ZROBIENIA" ?> <br> <br>
		<b>RESULT: </b><?php echo $row['result'] ?> <br> <br>

		
		
		
		
		<?php
			//$idproject->free_result();
			$conn->close();
		?>

		</section>
		

	
	</main>
	
 
 </body>
 </html>