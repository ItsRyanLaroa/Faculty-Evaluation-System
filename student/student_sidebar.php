<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sidebar</title>
    <link rel="stylesheet" href="../Css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="sidenav" id="mySidenav">
        <img class="logo" src="../img/logo.png" />
        <a href="dashboard.php"><i class="fas fa-desktop"></i> Dashboard</a>
        <a href="teacher.php"><i class="fas fa-users"></i> Teacher</a>
        <a href="profile.php"><i class="fas fa-question-circle"></i> Profile</a>
        <hr />
        <a href="confirmLogout.php"><i class="fas fa-sign-out-alt"></i> Log out</a>
    </div>

    <script>
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
