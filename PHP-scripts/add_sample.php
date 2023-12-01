<?php

require_once 'connect.php';
$conn = @new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$materialType = $_POST['materialType'];
$takingDate = $_POST['takingDate'];
$patientsName = $_POST['patientsName'];
$patientsSurname = $_POST['patientsSurname'];
$experiment = $_POST['experiment'];
$isControl = $_POST['isControl'];


// Insert data into the database
$sql = "INSERT INTO samples (taking_date, 
control, 
patients_idPatient, 
experiments_idexperiments, 
material_of_sample_idmaterial_of_sample) 
VALUES ('$takingDate', '$isControl', '$patientsName', '$experiment', '$materialType')";

if ($conn->query($sql) === TRUE) {
    header('Location: samples.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    header('Location: samples.php');
}

// Close the database connection
$conn->close();
?>




