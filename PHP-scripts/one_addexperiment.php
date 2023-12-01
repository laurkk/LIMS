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
		
	
		<p class="content_title"> Add Experiment: </p>	
		<form action="add_experiment.php" method="POST">
        	<?php
			
				
			
			class DropDown{//class ktora pozwala stworzyc funkcje i prosciej wykorzystac pobieranie 
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
			$metOfExp = $dropDown -> getDropdownOptions("method_of_experiment","idmethod_of_experiment",
			"name",$conn);
			$exeName = $dropDown -> getDropdownOptions("w_personal_data","id_personal_data",
			'CONCAT(name," ",surname)',$conn);
			$usdEq = $dropDown -> getDropdownOptions("lab_equipment","idlab_equipment",
			"name",$conn);
			$projName = $dropDown -> getDropdownOptions("projects","idprojects",
			"title",$conn);
			?>
			
			<label for='expeName'>Experiment Name: </label>
			<input type='text' name='expeName' id='expeName'required><br><br>


			<label for='expeDes'>Experiment Description: </label><br>
			<!--<input type='text' name='expeDes' id='expeDes' wrap="hard" rows="6" cols="30" required><br><br> -->
            <textarea name="expeDes" id="expeDes" wrap="hard" rows="6" cols="30" minlength="0"maxlength="50000" required> 
            </textarea><br><br>

			<label for="expDate">Date of Experiment: </label>
        	<input type="date" name="expDate" id="expDate" value = "2023-01-01"/><br><br>


			<label for="exeName">Executor Name: </label>
			<select name="exeName" id="exeName" required>
				<?php echo $exeName; ?>
			</select><br><br>


			<label for="expResu">Experiment Results: </label><br>
        	<input type='text' name='expResu' id='expResu' required ><br><br>
			<textarea name="expResu" id="expResu" wrap="hard" rows="6" cols="30" minlength="0"maxlength="50000" required> </textarea><br><br>
			<!--
			<textarea name='expResu' id='expResu' rows='5' cols='25' >
			
			</textarea><br><br>
			-->

			<label for="projName">Project Name: </label>
			<select name="projName" id="projName" required>
				<?php echo $projName; ?>
			</select><br><br>
			
			
			<label for="metOfExp">Method Of Experiment: </label>
			<select name="metOfExp" id="metOfExp" required>
				<?php echo $metOfExp;?>
			</select><br><br>


        	<label for="usedEq">Used Equipment: </label>
			<select name="usedEq" id="usedEq" required>
				<?php echo $usdEq;?>
			</select><br><br>
			

			
        	<input type="submit" value="Add Experiment">
    </form>
		
		<?php
			
			$conn->close();
		?>

		</section>
		

	
	</main>
	
 
 </body>
 </html>