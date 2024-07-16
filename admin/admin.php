<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <!-- Include top bar -->
    <!-- <div class="topnav">
        <a  href="#home">Profile</a>
        <a href="#about">Log out</a>
    </div> -->

    <button class="menu-btn" onclick="toggleMenu()">&#9776;</button>

    <!-- Side navigation menu -->
    <?php include 'sidebar.php'; ?>
    <!-- Page content -->
    <div class="main content">
         <h2>Dashboard</h2>
         <hr>
        <div class="row1">
            <div class="column1">
                <div class="card1">Academic Year: 2020-2021 1st Semester
                    Evaluation Status: On-going</div>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <div class="card"><p>1</p>Total Faculties</div>
            </div>
            <div class="column">
                <div class="card"><p>2</p>Total Students</div>
            </div>
            <div class="column">
                <div class="card"><p>4</p>Total Classes</div>
            </div>
            <div class="column">
                <div class="card"><p>6</p>Total Staffs</div>
            </div>
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
