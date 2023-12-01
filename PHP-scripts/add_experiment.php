<?php
require_once 'connect.php';
$conn = @new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$expeName = $_POST['expeName'];
$expeDes = $_POST['expeDes'];
$expDate = $_POST['expDate'];
$exeName = $_POST['exeName'];
$expResu = $_POST['expResu'];
$projName = $_POST['projName'];
$metOfExp = $_POST['metOfExp'];
$usedEq = $_POST['usedEq'];

// Insert data into the database
$sql = "INSERT INTO experiments (name, 
description, 
execution_date, 
id_executor, 
result, 
projects_idprojects,
method_of_experiment_idmethod_of_experiment,
used_equipment) 
VALUES ('$expeName', '$expeDes', '$expDate', '$exeName', '$expResu','$projName',
'$metOfExp','$usedEq');";

if ($conn->query($sql) === TRUE) {
    header('Location: experiments.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    header('Location: experiments.php');
}

// Close the database connection
$conn->close();
?>