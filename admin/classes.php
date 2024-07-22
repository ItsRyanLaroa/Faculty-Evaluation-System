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
    <style>
        .view{
            display: inline-block;
        border-radius: 7px;
        border: none;
        background: #1875FF;
        color: white;
        font-family: inherit;
        text-align: center;
        font-size: 13px;
        box-shadow: 0px 14px 56px -11px #1875FF;
        width: 5em;
        padding: 1em;
        transition: all 0.4s;
        cursor: pointer;
            text-decoration: none;
        }
        .card3 table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .card3 th, .card3 td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .card3 th {
            background-color: #f2f2f2;
        }
        .icon-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1.2em;
            margin-right: 5px;
        }
        .icon-btn .fa-edit {
            color: blue;
        }
        .icon-btn .fa-trash {
            color: red;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 60px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #ffff;
            margin: 65px auto;
            padding: 40px;
            border: 1px solid #888;
            width: 300px;
            height: 20vh;
            border-radius: 4px;
        }
        .close {
            color: red;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
       
        .input{
            border-radius: 4px;
            padding: 10px;
            width: 270px;
        }
        .button {
        display: inline-block;
        border-radius: 7px;
        border: none;
        background: #1875FF;
        color: white;
        font-family: inherit;
        text-align: center;
        font-size: 13px;
        box-shadow: 0px 14px 56px -11px #1875FF;
        width: 10em;
        padding: 1em;
        transition: all 0.4s;
        cursor: pointer;
        float:right;
        margin:10px;
        }

        /* .button span {
        cursor: pointer;
        display: inline-block;
        position: relative;
        transition: 0.4s;
        }

        .button span:after {
        content: '=>';
        position: absolute;
        opacity: 0;
        top: 0;
        right: -20px;
        transition: 0.7s;
        } */

        /* .button:hover span {
        padding-right: 3.55em;
        }

        .button:hover span:after {
        opacity: 4;
        right: 0;
        } */
    </style>
</head>
<body>
    <button class="menu-btn" onclick="toggleMenu()">&#9776;</button>
    <?php include 'sidebar.php'; ?>
    <div class="main content">
         <h2>Class List</h2>
         <hr>
        <div class="row3">
            <div class="column3">
                <div class="card3">
                    <button class="btn" id="addClassBtn">+Add New</button>
                    <div class="search-container">
                        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search for classes..">
                        <button onclick="searchTable()"><i class="fas fa-search"></i></button>
                    </div>
                    <table id="classTable">
                    <tr style="border: 3px #b22222 solid;/* background-color: #333; */padding: 20px;">
                            <th>No.</th>
                            <th>Class</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        // Fetch data from the database
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

                        $sql = "SELECT id, name FROM classes";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td><a href='ManageStudents.php' class='view'>view</a><button class='icon-btn'><i class='fas fa-edit'></i></button><button class='icon-btn'><i class='fas fa-trash'></i></button></td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3'>No classes found</td></tr>";
                        }

                        $conn->close();
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for adding new class -->
    <div id="addClassModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Add New Class</h2>
            <hr>
            <form id="addClassForm">
                <input type="text" id="className" name="className" class="input" placeholder="Class Name" required>
                <button class="button" type="submit" style="vertical-align:middle"><span>Save</span></button>
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

        var modal = document.getElementById("addClassModal");
        var btn = document.getElementById("addClassBtn");
        var span = document.getElementsByClassName("close")[0];
        var form = document.getElementById("addClassForm");

        btn.onclick = function() {
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        form.onsubmit = function(event) {
            event.preventDefault();
            var className = document.getElementById("className").value;
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "add_class.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var newClass = JSON.parse(xhr.responseText);
                    addClassToTable(newClass.id, newClass.name);
                    modal.style.display = "none";
                    form.reset();
                }
            }
            xhr.send("className=" + className);
        }

        function addClassToTable(id, name) {
            var table = document.getElementById("classTable");
            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);

            cell1.innerHTML = rowCount;
            cell2.innerHTML = name;
            cell3.innerHTML = '<button class="icon-btn"><i class="fas fa-edit"></i></button><button class="icon-btn"><i class="fas fa-trash"></i></button>';
        }
    </script>
</body>
</html>
