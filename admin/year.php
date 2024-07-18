<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags and CSS links -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        .close {
            color: #aaa;
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
    </style>
</head>
<body>
    <button class="menu-btn" onclick="toggleMenu()">&#9776;</button>

    <!-- Sidebar -->
    <?php include 'sidebar.php'; ?>

    <!-- Page content -->
    <div class="main content">
        <h2>Class List</h2>
        <hr>
        <div class="row3">
            <div class="column3">
                <div class="card3">
                    <!-- Add new evaluation button -->
                    <button class="btn" onclick="document.getElementById('addEvalModal').style.display='block'">+Add New</button>
                    <!-- Search bar -->
                    <div class="search-container">
                        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search for classes..">
                        <button onclick="searchTable()"><i class="fas fa-search"></i></button>
                    </div>
                    <!-- Table for displaying evaluations -->
                    <table>
                        <tr>
                            <th>No.</th>
                            <th>Year</th>
                            <th>Semester</th>
                            <th>Evaluation Status</th>
                            <th>Action</th>
                        </tr>
                        <?php
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

                        // Handle form submission
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $year = $_POST['year'];
                            $semester = $_POST['semester'];
                            $status = $_POST['status'];

                            // Prepare SQL statement for insertion
                            $sql = "INSERT INTO academic_year (year, semester, status) VALUES (?, ?, ?)";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("sss", $year, $semester, $status);

                            // Execute SQL statement
                            if ($stmt->execute()) {
                                echo "<script>alert('Evaluation added successfully!');</script>";
                            } else {
                                echo "<script>alert('Error: " . $stmt->error . "');</script>";
                            }

                            $stmt->close();
                        }

                        // Fetch and display existing evaluations
                        $sql = "SELECT id, year, semester, status FROM academic_year";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>" . $row["id"]. "</td>
                                        <td>" . $row["year"]. "</td>
                                        <td>" . $row["semester"]. "</td>
                                        <td>" . $row["status"]. "</td>
                                        <td>
                                            <button class='icon-btn'><i class='fas fa-edit'></i></button>
                                            <button class='icon-btn'><i class='fas fa-trash'></i></button>
                                        </td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No evaluations found</td></tr>";
                        }

                        $conn->close();
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div id="addEvalModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('addEvalModal').style.display='none'">&times;</span>
            <h2>Add New Evaluation</h2>
            <form method="POST" action="">
                <label for="year">Year:</label>
                <input type="text" id="year" name="year" required><br>
                <label for="semester">Semester:</label>
                <input type="text" id="semester" name="semester" required><br>
                <label for="status">Evaluation Status:</label>
                <input type="text" id="status" name="status" required><br>
                <button type="submit">Submit</button>
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

