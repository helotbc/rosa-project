<?php
// Error checking from ChatGPT
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Assuming you have a MySQL database set up
$servername = "10.0.4.3";
$username = "root";
$password = "";
$dbname = "applicants";
$tablename = "applicants";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
//echo $conn;

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];

$sql = "INSERT INTO $tablename (firstname, lastname, email) VALUES ('$firstname', '$lastname', '$email')";

if ($conn->query($sql) === TRUE) {
    echo "Record added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>