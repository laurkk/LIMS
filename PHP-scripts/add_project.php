<?php
require_once 'connect.php';
$conn = @new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$title = $_POST['title'];
$description= $_POST['description'];
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];
$keywords = $_POST['keywords'];
$budget = $_POST['budget'];
$workerName = $_POST['workerName'];
$projStat= $_POST['projStat'];
$isNull = isset($_POST['null-date']);

if ($isNull) {
 
    $sql = "INSERT INTO projects (title, 
    description, 
    start_date,
    key_words,
    budget,
    w_personal_data_idwokers_data, 
    project_status_idproject_status) 
    VALUES ('$title', '$description', '$startDate','$keywords',
    '$budget','$workerName', '$projStat')";
}else{
    $sql = "INSERT INTO projects (title, 
    description, 
    start_date,
    end_date,
    key_words,
    budget,
    w_personal_data_idwokers_data, 
    project_status_idproject_status) 
    VALUES ('$title', '$description', '$startDate', '$endDate','$keywords',
    '$budget','$workerName', '$projStat')";
}

if ($conn->query($sql) === TRUE) {
    header('Location: projects.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    header('Location: projects.php');
}

// Close the database connection
$conn->close();
?>