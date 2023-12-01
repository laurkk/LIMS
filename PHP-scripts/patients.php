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
				<p class="content_title"> Add Patient: </p>	
	
		<form action="add_patient.php" method="POST">
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

			<b>Personal data:</b><br><br>
			<label for="patientsName">Patients:</label><br>
			<input type='text' name="patientsName" id="patientsName" required>
			</select><br><br>
			

			<label for="patientsSurname">Patients surname:</label>
			<input type='text' name="patientsSurname" id="patientsSurname" required>
			<br><br>
			
			<label for="sex">Sex:</label><br>
			<select name="sex" id="sex" required>
				<option value="1">Female</option>
				<option value="2">Male</option>
				<option value="3">Other</option>
			</select><br><br>
			
						
			<b>Contact data:</b><br><br>
			<label for="patientsPhone">Patients phone:</label>
			<input type='text' name="patientsPhone" id="patientsPhone" required>
			<br><br>
			
			<label for="patientsMail">Patients email:</label>
			<input type='text' name="patientsMail" id="patientsMail" required>
			<br><br>
			
			<b>Address:</b><br><br>
			
			<label for="street">Street:</label>
			<input type='text' name="street" id="street" required>
			<br><br>
			
			<label for="number">Number:</label>
			<input type='text' name="number" id="number" required>
			<br><br>			
			
			<label for="local">Local:</label>
			<input type='text' name="local" id="local" required>
			<br><br>
			
			<label for="city">City:</label>
			<input type='text' name="city" id="city" required>
			<br><br>

			<label for="code">Postal Code:</label>
			<input type='text' name="code" id="code" required>
			<br><br>
			

        	<input type="submit" value="Patient">
    </form>
		</section>
		
		<section class="results">
		<table style="white-space: nowrap;";>
		<caption style="font-size:35px;padding-bottom:15px;text-shadow: 2px 2px 2px lightgrey; ";> <b>Patients</b> </caption>
			<thead>
				<tr>
				<th>Surname</th>
				<th>Name</th>
				<th>Sex</th>
				<th>Phone number</th>
				<th>E-mail</th>
				<th>Street</th>
				<th>Number</th>
				<th>Local</th>
				<th>City</th>
				<th>Postal Code</th>
				</tr>
			</thead>
			<tbody>
		<?php
			$q = "SELECT surname, patients.name, sex, phone_number, email, street, house_number, flat_number, city.name, code FROM patients INNER JOIN sex ON patients.sex_idtable1 = sex.idtable1 INNER JOIN addresses ON patients.addresses_idadresses = addresses.idadresses INNER JOIN city on addresses.City_idtable1 = city.idtable1 INNER JOIN postal_code on addresses.postal_code_idpostal_code = postal_code.idpostal_code";
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