<?php
$servername = "localhost";
$username = "root"; // Change this if your MySQL user is different
$password = ""; // Change this if you have a MySQL password
$dbname = "faculty_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $criteria = $_POST['criteria'];
    $questions = $_POST['questions'];

    // Convert questions from textarea into an array
    $questionsArray = array_filter(array_map('trim', explode("\n", $questions)));

    if (count($questionsArray) > 10) {
        echo "You can only upload a maximum of 10 questions per criteria.";
        exit;
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO questions (criteria, question) VALUES (?, ?)");

    foreach ($questionsArray as $question) {
        $stmt->bind_param("ss", $criteria, $question);
        $stmt->execute();
    }

    header('Location: questionnaire.php');
    $stmt->close();
}

$conn->close();
?>
