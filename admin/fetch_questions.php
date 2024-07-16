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

$sql = "SELECT criteria, question FROM questions";
$result = $conn->query($sql);

$currentCriteria = null;
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if ($currentCriteria !== $row['criteria']) {
            if ($currentCriteria !== null) {
                echo '</div>';
            }
            $currentCriteria = $row['criteria'];
            echo '<div class="form-group">';
            echo "<label>{$row['criteria']}</label>";
            echo '</div>';
        }
        echo '<div class="form-group">';
        echo "<label>{$row['question']}</label>";
        echo '<div class="radio-group">';
        for ($i = 1; $i <= 5; $i++) {
            echo '<label>';
            echo "<input type=\"radio\" name=\"{$row['criteria']}-rating-{$row['question']}\" value=\"$i\" required> $i";
            echo '</label>';
        }
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
} else {
    echo "No questions found.";
}

$conn->close();
?>
