<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "faculty_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$class = $_POST['class'];

$sql = "INSERT INTO students (firstname, lastname, class) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $firstname, $lastname, $class);

$response = array();
if ($stmt->execute()) {
    $response["success"] = true;
} else {
    $response["success"] = false;
    $response["message"] = "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

echo json_encode($response);
?>
