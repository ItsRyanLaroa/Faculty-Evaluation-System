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
        /* Add some basic styling for the table */
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
            height: 44vh;
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
/* 
        .button span {
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
    </style>
</head>
<body>
    <button class="menu-btn" onclick="toggleMenu()">&#9776;</button>

    <!-- Side navigation menu -->
 
    <?php include 'sidebar.php'; ?>
    <!-- Page content -->
    <div class="main content">
         <h2>Class List</h2>
         <hr>
        <div class="row3">
            <div class="column3">
                <div class="card3">
                    <button class="btn" onclick="document.getElementById('addStudentModal').style.display='block'">+Add New</button>
                    <div class="search-container">
                        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search for classes..">
                        <button onclick="searchTable()"><i class="fas fa-search"></i></button>
                    </div>
                    <table>
                    <tr style="border: 3px #b22222 solid;/* background-color: #333; */padding: 20px;">
                            <th>ID</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Class</th>
                            <th>Action</th>
                        </tr>
                        <?php
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

                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $firstname = $_POST['firstname'];
                            $lastname = $_POST['lastname'];
                            $class = $_POST['class'];

                            $sql = "INSERT INTO students (firstname, lastname, class) VALUES (?, ?, ?)";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("sss", $firstname, $lastname, $class);

                            if ($stmt->execute()) {
                                echo "<script>alert('Student added successfully!');</script>";
                            } else {
                                echo "<script>alert('Error: " . $stmt->error . "');</script>";
                            }

                            $stmt->close();
                        }

                        $sql = "SELECT id, firstname, lastname, class FROM students";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>" . $row["id"]. "</td>
                                    <td>" . $row["firstname"]. "</td>
                                    <td>" . $row["lastname"]. "</td>
                                    <td>" . $row["class"]. "</td>
                                    <td>
                                        <button class='icon-btn'><i class='fas fa-edit'></i></button>
                                        <button class='icon-btn'><i class='fas fa-trash'></i></button>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No students found</td></tr>";
                        }
                        $conn->close();
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div id="addStudentModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('addStudentModal').style.display='none'">&times;</span>
            <h2>Add New Student</h2>
            <hr>
            <form method="POST" action="add_student.php">
                    <input class="input" type="text" id="firstname" name="firstname"  placeholder="Last Name"required>

                    <input  class="input" type="text" id="lastname" name="lastname"  placeholder="Last Name" required>

                    <input class="input" type="text" id="class" name="class"  placeholder="Last Name" required>

                    <input class="input" type="text" id="school_id" name="school_id" placeholder="Last Name" required>

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

        function searchTable() {
            // Function to filter table rows based on search input
            var input, filter, table, tr, td, i, j, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.querySelector(".card3 table");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) {
                tr[i].style.display = "none";
                td = tr[i].getElementsByTagName("td");
                for (j = 0; j < td.length; j++) {
                    if (td[j]) {
                        txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                            break;
                        }
                    }
                }
            }
        }
    </script>
</body>
</html>
