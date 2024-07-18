<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $teacher_id = isset($_POST['teacher_id']) ? $_POST['teacher_id'] : '';
    
    if (empty($teacher_id)) {
        die("Invalid teacher ID");
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

    // Fetch teacher's information
    $stmt = $conn->prepare("SELECT firstname, lastname FROM teachers WHERE T_id = ?");
    $stmt->bind_param("i", $teacher_id);
    $stmt->execute();
    $stmt->bind_result($firstname, $lastname);
    $stmt->fetch();
    $stmt->close();

    // Fetch questions for evaluation
    $sql = "SELECT id, question FROM questions WHERE t_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $teacher_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $questions = [];
    while ($row = $result->fetch_assoc()) {
        $questions[] = $row;
    }
    $stmt->close();
    $conn->close();
} else {
    die("Invalid request");
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../Css/admin.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"
    />
    <link
      rel="stylesheet"
      href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
      
    />
    <style>
        .evaluation-form {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .evaluation-form h2 {
            margin-bottom: 20px;
        }

        .evaluation-form .form-group {
            margin-bottom: 15px;
        }

        .evaluation-form .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .evaluation-form .form-group .radio-group {
            display: flex;
            gap: 10px;
        }

        .evaluation-form button {
            padding: 10px 15px;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }

        .evaluation-form button:hover {
            background-color: #0056b3;
        }
    </style>
  </head>
  <body>
    <!-- Include top bar -->
    <!-- <div class="topnav">
        <a  href="#home">Profile</a>
        <a href="#about">Log out</a>
    </div> -->

    <button class="menu-btn" onclick="toggleMenu()">&#9776;</button>

    <!-- Side navigation menu -->
  <?php include 'student_sidebar.php'; ?>

    <!-- Page content -->
    <div class="main content">
    <div class="evaluation-form">
        <h2>Evaluate Teacher: <?php echo htmlspecialchars($firstname) . ' ' . htmlspecialchars($lastname); ?></h2>
        <form method="POST" action="submit_evaluation.php">
            <?php foreach ($questions as $question): ?>
                <div class="form-group">
                    <label for="question-<?php echo $question['id']; ?>"><?php echo htmlspecialchars($question['question']); ?></label>
                    <div class="radio-group">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <label>
                                <input type="radio" name="responses[<?php echo $question['id']; ?>]" value="<?php echo $i; ?>" required> <?php echo $i; ?>
                            </label>
                        <?php endfor; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            <input type="hidden" name="teacher_id" value="<?php echo htmlspecialchars($teacher_id); ?>">
            <button type="submit">Submit Evaluation</button>
        </form>
    </div>
    </div>

    <script>
        function toggleMenu() {
            var x = document.getElementById("mySidenav");
            if (x.style.width === "250px") {
                x.style.width = "0";
            } else {
                x.style.width = "250px";
            }
        }

        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;

        for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        }
    </script>
  </body>
</html>
