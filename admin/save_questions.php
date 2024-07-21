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

    // Split the questions by new line
    $questionsArray = explode("\n", $questions);

    // Prepare the insert statement
    $stmt = $conn->prepare("INSERT INTO questions (criteria, question) VALUES (?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ss", $criteria, $question);

    // Execute insert statements for each question
    foreach ($questionsArray as $question) {
        $question = trim($question);
        if (!empty($question)) {
            if (!$stmt->execute()) {
                die("Execute failed: " . $stmt->error);
            }
        }
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();

    // Redirect to manage_questionnaire.php
    header("Location: questionnaire.php");
    exit;
}
?>
