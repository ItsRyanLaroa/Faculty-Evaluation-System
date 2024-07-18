<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../Css/admin.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
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
    <?php include 'student_sidebar.php'; ?>

    <div class="main content">
        <h2>List Teacher</h2>
        <hr />
        <div class="row3">
            <div class="column3">
                <div class="card3">
                    <div class="search-container">
                        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search for teachers.." />
                        <button onclick="searchTable()">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    <table>
                        <tr>
                            <th>No.</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Action</th>
                        </tr>
                        <tbody>
                            <?php
                                function get_teacher() {
                                    $servername = "localhost";
                                    $username = "root";
                                    $password = "";
                                    $dbname = "faculty_db";

                                    $conn = new mysqli($servername, $username, $password, $dbname);

                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    }

                                    $sql = "SELECT T_id, firstname, lastname FROM teachers";
                                    $result = $conn->query($sql);

                                    $teachers = [];
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            $teachers[] = $row;
                                        }
                                    }
                                    $conn->close();
                                    return $teachers;
                                }

                                $teachers = get_teacher();
                                $search_name = isset($_POST['searchName']) ? $_POST['searchName'] : '';

                                $filtered_teachers = array_filter($teachers, function($teacher) use ($search_name) {
                                    return empty($search_name) || stripos($teacher['firstname'], $search_name) !== false || stripos($teacher['lastname'], $search_name) !== false;
                                });

                                if (!empty($filtered_teachers)) {
                                    foreach ($filtered_teachers as $teacher) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($teacher['T_id']) . "</td>";
                                        echo "<td>" . htmlspecialchars($teacher['firstname']) . "</td>";
                                        echo "<td>" . htmlspecialchars($teacher['lastname']) . "</td>";
                                        echo "<td>
                                            <form style='display:inline;' method='POST' action='Evaluate.php'>
                                                <input type='hidden' name='teacher_id' value='" . htmlspecialchars($teacher['T_id']) . "'>
                                                <button type='submit' class='viewrec'>Evaluate</button>
                                            </form>
                                        </td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>No teachers found</td></tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
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

