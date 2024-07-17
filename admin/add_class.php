<?php
$servername = "localhost";
$username = "root"; // replace with your database username
$password = ""; // replace with your database password
$dbname = "faculty_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $className = $_POST['className'];
    $sql = "INSERT INTO classes (name) VALUES ('$className')";

    if ($conn->query($sql) === TRUE) {
        $id = $conn->insert_id;
        echo json_encode(['id' => $id, 'name' => $className]);
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
