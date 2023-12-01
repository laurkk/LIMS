<?php
require_once 'connect.php';
$conn = @new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$prodName = $_POST['prodName'];
$prodDate = $_POST['prodDate'];
$empName = $_POST['empName'];
$eqName = $_POST['eqName'];
$locali = $_POST['locali'];


// Insert data into the database
$sql = "INSERT INTO lab_equipment (name, 
prod_date, 
localisation, 
w_personal_data_id_personal_data, 
producer_idproducer) 
VALUES ('$eqName', '$prodDate', '$locali', '$empName', '$prodName')";

if ($conn->query($sql) === TRUE) {
    header('Location: equipment.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    header('Location: equipment.php');
}

// Close the database connection
$conn->close();
?>