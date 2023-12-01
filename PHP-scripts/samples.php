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
			<li><a href="patients.php">Patients</a></li>
			<li><a href="experiments.php">Experiments</a></li>
			<li><a href="samples.php">Samples</a></li>
			<li><a href="equipment.php">Equipment</a></li>
			</ul>
		</nav>
	
	</header>	
	
	<main>	
	
		<section class="content">	
		<p class="content_title"> Add Sample: </p>	
	
		<form action="add_sample.php" method="POST">
        	<?php
			
				
			
			class DropDown{
				public function getDropdownOptions($tableName, $valueColumn, $textColumn, $conn) {
					$query = "SELECT $valueColumn, $textColumn FROM $tableName;"; // Modify the query as per your database structure
					$result = mysqli_query($conn,$query);
			
					$options = '';
					while ($row = $result->fetch_assoc()) {
						$value = $row[$valueColumn];
						$text = $row[$textColumn];
						$options .= "<option value='$value'>$text</option>";
					}
					$result -> free_result();
					return $options;
				}
			}
			$dropDown = new DropDown();
			$MatrialType = $dropDown -> getDropdownOptions("material_of_sample","idmaterial_of_sample",
			"name",$conn);
			$PatientsName = $dropDown -> getDropdownOptions("patients","idpatient",
			'CONCAT(name," ",surname)',$conn);
			//$PatientsSurname = $dropDown -> getDropdownOptions("patients","idpatient",
			//"surname",$conn);
			$Experiment = $dropDown -> getDropdownOptions("experiments","idexperiments",
			"name",$conn);
			?>
			<label for="materialType">Material type:</label><br>
			<select name="materialType" id="materialType" required>
				<?php echo $MatrialType ?>
			</select><br><br>
			
			<label for="patientsName">Patients:</label><br>
			<select name="patientsName" id="patientsName" required>
				<?php echo $PatientsName ?>
			</select><br><br>
			
			<!--
			<label for="patientsSurname">Patients surname:</label>
			<select name="patientsSurname" id="patientsSurname" required>
				<?php //echo $PatientsSurname ?>
			</select><br><br>
			-->
			<label for="experiment">Experiment:</label><br>
			<select name="experiment" id="esperiment" required>
				<?php echo $Experiment?>
			</select><br><br>

        	<label for="takingDate">Taking date:</label><br>
        	<input type="date" name="takingDate" id="takingDate" value = "2023-01-01"/><br><br>
			

			<lable for="isControl">Is Control?</label><br>
			<select name="isControl" id="isControl">
				<option value="0">No</option>
				<option value="1">Yes</option>
			</select><br><br>
        	<input type="submit" value="Add Sample">
    </form>
		</section>
		<section class="results">
		<table style="white-space: nowrap;";>
		<caption style="font-size:35px;padding-bottom:15px;text-shadow: 2px 2px 2px lightgrey; ";> <b>Samples</b> </caption>
			<thead>
				<tr>
				<th>Material type</th>				
				<th>Taking date</th>
				<th>Patients' name</th>
				<th>Patients' surname</th>
				<th>Experiment</th>
				<th>Is control?</th>
				</tr>
			</thead>
			<tbody>
		<?php
			$q = "SELECT material_of_sample.name AS material, taking_date, patients.name, patients.surname, experiments.name AS eks, control FROM `samples` INNER JOIN patients ON patients_idpatient = idpatient INNER JOIN experiments ON experiments_idexperiments = idexperiments INNER JOIN material_of_sample ON material_of_sample_idmaterial_of_sample = idmaterial_of_sample;";
			$result = $conn->query($q);
			
			
			
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
			$conn->close();
		?>
		
		</tbody>
		</table>
		</section>
		

	
	</main>
	
 
 </body>
 </html>