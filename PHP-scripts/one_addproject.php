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
		<p class="content_title"> Available projects</p><br>
            <a href="one_addproject.php">
				<button>Add Project</button>
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
			?>
			</ul>		

		
		</section>
		
		<section class="results">
		<p class="content_title"> Create New Project: </p>	
		<form action="add_project.php" method="POST">
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
			
            $workerName = $dropDown -> getDropdownOptions("w_personal_data","id_personal_data",
			'CONCAT(name," ",surname)',$conn);

			$projStat = $dropDown -> getDropdownOptions("project_status","idproject_status",
			"status",$conn);
			?>
			
            <label for="title">Project Title: </label>
            <input type="text" name="title" id="title" required><br><br>

            <label for="description">Project Description: </label><br>
            <textarea name="description" id="description" wrap="hard" rows="6" cols="30" minlength="0"maxlength="50000" required>
            </textarea><br><br>

            <label for="startDate">Start date: </label>
        	<input type="date" name="startDate" id="startDate" value = "" required><br><br>
			
            <label for="endDate">End date: </label>
            <input type="date" name="endDate" id="endDate" >
            <label for="null-date">
            <input type="checkbox" name="null-date" id="null-date"> No End Date
            </label><br><br>

            <label for="keywords">Keywords: </label>
            <input type="test" name="keywords" id="keywords"required><br><br>

            <label for="budget">Budget: </label>
            <input type="number" name="budget" id="budget" min='0'><br><br>

            <label for="workerName">Project Manager: </label>
			<select name="workerName" id="workerName" required>
				<?php echo $workerName; ?>
			</select><br><br>
			
			<label for="projStat">Project Status: </label>
			<select name="projStat" id="projStat" required>
				<?php echo $projStat; ?>
			</select><br><br>
			
            <input type="submit" value="Add Project">
			

        	
			
    </form>
		
		
		
		<?php
			
			$conn->close();
		?>

		</section>
		

	
	</main>
	
 
 </body>
 </html>