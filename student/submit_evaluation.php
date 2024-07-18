<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $teacher_id = isset($_POST['teacher_id']) ? $_POST['teacher_id'] : '';
    $responses = isset($_POST['responses']) ? $_POST['responses'] : [];

    if (empty($teacher_id) || empty($responses)) {
        die("Invalid input");
    }

    // Database connection parameters
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

    // Insert evaluation responses
    $stmt = $conn->prepare("INSERT INTO evaluations (teacher_id, question_id, response) VALUES (?, ?, ?)");

    foreach ($responses as $question_id => $response) {
        $stmt->bind_param("iis", $teacher_id, $question_id, $response);
        $stmt->execute();
    }

    $stmt->close();
    $conn->close();

    echo "Evaluation submitted successfully!";
} else {
    die("Invalid request");
}
?>
