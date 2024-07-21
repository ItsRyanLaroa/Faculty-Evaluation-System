<?php
session_start();

$servername = "localhost";
$username = "root"; // Use your database username
$password = ""; // Use your database password
$dbname = "faculty_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error_message = "";
$id_error = false;
$password_error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identifier = $_POST['identifier'];
    $pass = $_POST['password'];

    $roles = ['admin', 'faculty_list', 'students'];
    $user_found = false;

    foreach ($roles as $role) {
        $sql = ($role == 'admin') ? "SELECT * FROM $role WHERE email = ?" : "SELECT * FROM $role WHERE school_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $identifier);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Verify password
            if (password_verify($pass, $row['password'])) {
                $_SESSION['identifier'] = $identifier;
                $_SESSION['role'] = $role;
                if ($role == 'faculty_list') {
                    $_SESSION['f_id'] = $row['f_id']; // Save f_id for faculty
                } elseif ($role == 'students') {
                    $_SESSION['s_id'] = $row['s_id']; // Save s_id for students
                }
                // Redirect based on role
                if ($role == 'admin') {
                    header("Location: admin/admin.php");
                } elseif ($role == 'faculty_list') {
                    header("Location: teacherDesign.php");
                } else {
                    header("Location: student/dashboard.php");
                }
                $user_found = true;
                exit;
            } else {
                $error_message = "Invalid password.";
                $password_error = true;
                $user_found = true;
                break;
            }
        }
        $stmt->close();
    }

    if (!$user_found) {
        $error_message = "No user found.";
        $id_error = true;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Simple Responsive Website in HTML CSS</title>
    <link rel="stylesheet" href="Css/login.css" />
    <script src="../custom-scripts.js" defer></script>
    <style>
      .invalid-input {
        border: 1px solid red;
      }
    </style>
  </head>
  <body>
    <main>
      <!-- Header Start -->
      <header>
        <nav class="nav container">
          <h2 class="nav_logo"><a href="#">Faculty Evaluation System</a></h2>
          <ul class="menu_items">
            <li><a href="index.php" class="nav_link">Login</a></li>
            <li><a href="register.php" class="nav_link">Register</a></li>
          </ul>
          <img src="images/bars.svg" alt="timesicon" id="menu_toggle" />
        </nav>
      </header>
      <div class="loginContainer">
        <form action="index.php" method="POST" class="sign-up-form">
          <img class="logo" src="images/file.png" width="200px" />
          <h2 class="title">FACULTY EVALUATION SYSTEM</h2>
          <br>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input
              type="text"
              name="identifier"
              placeholder="School ID or Email"
              required
              class="<?= $id_error ? 'invalid-input' : '' ?>"
            />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input
              type="password"
              name="password"
              placeholder="Password"
              required
              class="<?= $password_error ? 'invalid-input' : '' ?>"
            />
          </div>
       
          <input type="submit" class="btn" value="Log in" />
        </form>
      </div>
      <!-- Header End -->

      <!-- Hero Start -->

      <!-- Hero End-->
    </main>

    <script>
      const header = document.querySelector('header')
      const menuToggler = document.querySelectorAll('#menu_toggle')

      menuToggler.forEach(toggler => {
        toggler.addEventListener('click', () =>
          header.classList.toggle('showMenu')
        )
      })
    </script>
  </body>
</html>
