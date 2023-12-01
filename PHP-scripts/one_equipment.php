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
		<p class="content_title"> Lab Equipment </p>
			<ul class="titles">
			<?php
				$q = "SELECT idlab_equipment, name FROM lab_equipment";
				$result = $conn->query($q);
			
			
				while($row = mysqli_fetch_assoc($result))
				{
					echo "<li><a href='one_equipment.php?value_key=".$row['idlab_equipment']."'>".$row['name']."</a></li>";
				}
				$result->free_result();
			?>
			</ul>		

		
		</section>
		
		<section class="results">
		
		<?php
				
			if(isset($_GET['value_key'])){
			$idequipment=$_GET['value_key'];} // pobieranie wybranego id projektu 


			$q = "SELECT lab_equipment.name AS name_eq, prod_date, localisation, w_personal_data.name AS imie, w_personal_data.surname AS nazwisko, producer.name as nazwa FROM `lab_equipment` INNER JOIN w_personal_data ON w_personal_data_id_personal_data = id_personal_data INNER JOIN producer on producer_idproducer = idproducer WHERE idlab_equipment =? ;";
			$result = $conn->execute_query($q, [$idequipment]);

			$row = mysqli_fetch_assoc($result);
			$result->free_result();
		?>	
		<h1 class="result_title"> <?php echo $row['name_eq'] ?></h1>
		<b>PRODUCTION DATE: </b><?php echo $row['prod_date'] ?> <br> <br>
		<b>ROOM NUMBER: </b><?php echo $row['localisation'] ?> <br> <br>
		<b>RESPONSIBILITY: </b> <?php echo $row['nazwisko']." ".$row['imie'] ?>  <br> <br>
		<b>PRODUCENT: </b><?php echo $row['nazwa'] ?> <br> <br> <br> <br> <br> <br>
		
		<table class="long">
		<caption style="font-size:20px;padding-bottom:15px;text-shadow: 2px 2px 2px lightgrey;text-align:left;";> <b>      History of services</b> </caption>
			<thead>
				<tr>
				<th>Date</th>
				<th>Serviceman</th>
				<th>Description</th>
				</tr>
			</thead>
			<tbody>
		<?php

			$q = "SELECT service_date, serviceman_surname, description FROM `service` WHERE `lab_equipment_idlab_equipment` = ? ;";
			
			$result = $conn->execute_query($q, [$idequipment]);
			
			while($row = mysqli_fetch_row($result))
			{
				echo "<tr>";
				foreach($row as $col)
				{
					echo "<td>$col</td>";
				}
			}
			echo "</tr>";
			

			$result->free_result();

		?>
		
		</tbody>
		</table>
		
		
		
		<?php
	
		$conn->close();
		
		?>

		</section>
		

	
	</main>
	
 
 </body>
 </html>