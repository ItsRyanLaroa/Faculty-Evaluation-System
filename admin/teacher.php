<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Teachers</title>
    <link rel="stylesheet" href="../Css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <style>
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
            height: 45vh;
            border-radius: 4px;
            overflow: hidden;
           
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
            margin-bottom: 10px;
            overflow: hidden;
     
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
        content: 'for free';
        position: absolute;
        opacity: 0;
        top: 0;
        right: -20px;
        transition: 0.7s;
        }

        .button:hover span {
        padding-right: 3.55em;
        }

        .button:hover span:after {
        opacity: 4;
        right: 0;
        } */
        .text{
            margin-bottom:5px;
        }
    </style>
</head>
<body>
    <button class="menu-btn" onclick="toggleMenu()">&#9776;</button>
    <?php include 'sidebar.php'; ?>
    <div class="main content">
        <h2>Teacher List</h2>
        <hr>
        <div class="row3">
            <div class="column3">
                <div class="card3">
                    <button class="btn" id="addTeacherBtn">+Add New</button>
                    <div class="search-container">
                        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search for teachers..">
                        <button onclick="searchTable()"><i class="fas fa-search"></i></button>
                    </div>
                    <table id="teacherTable">
                    <tr style="border: 3px #b22222 solid;/* background-color: #333; */padding: 20px;">
                            <th>No.</th>
                            <th>Last Name</th>
                            <th>First Name</th>                          
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

                        $sql = "SELECT T_id, firstname, lastname FROM teachers";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["T_id"]. "</td><td>". $row["lastname"]. "</td><td>". $row["firstname"]. "</td><td><button class='icon-btn'><i class='fas fa-edit'></i></button><button class='icon-btn'><i class='fas fa-trash'></i></button></td></tr>";
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

    <!-- Modal for adding new teacher -->
    <div id="addTeacherModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Add New Teacher</h2>
            <hr>
            <form id="addTeacherForm">
                <input class="input" type="text" id="firstname" name="firstname" placeholder="First Name" required>
                <input class="input" type="text" id="lastname" name="lastname" placeholder="Last Name" required>
                <input class="input" type="text" id="id" name="id" placeholder="ID" required>
                <button class="button" type="submit" style="vertical-align:middle"><span>Save</span></button>
            </form>
        </div>
    </div>

    <script>
        var modal = document.getElementById("addTeacherModal");
        var btn = document.getElementById("addTeacherBtn");
        var span = document.getElementsByClassName("close")[0];
        var form = document.getElementById("addTeacherForm");

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
            var firstname = document.getElementById("firstname").value;
            var lastname = document.getElementById("lastname").value;
            var id = document.getElementById("id").value;
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "add_teacher.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var newTeacher = JSON.parse(xhr.responseText);
                    addTeacherToTable(newTeacher.id, newTeacher.firstname, newTeacher.lastname);
                    modal.style.display = "none";
                    form.reset();
                }
            }
            xhr.send("firstname=" + firstname + "&lastname=" + lastname + "&id=" + id);
        }

        function addTeacherToTable(id, firstname, lastname) {
            var table = document.getElementById("teacherTable");
            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);

            cell1.innerHTML = rowCount;
            cell2.innerHTML = firstname;
            cell3.innerHTML = lastname;
            cell4.innerHTML = id;
            cell5.innerHTML = '<button class="icon-btn"><i class="fas fa-edit"></i></button><button class="icon-btn"><i class="fas fa-trash"></i></button>';
        }
    </script>
</body>
</html>
