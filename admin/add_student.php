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
$school_id = $_POST['school_id']; // Assuming you have an input field for school ID

$username = $school_id;
$password = $lastname;

$sql = "INSERT INTO students (firstname, lastname, class, username, password) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $firstname, $lastname, $class, $username, $password);

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
