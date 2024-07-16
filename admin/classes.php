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
      
    </style>
</head>
<body>
    <!-- Include top bar -->
    <!-- <div class="topnav">
       
        <a href="#about">Log out</a>
         <a href="#home"><i class="fas fa-user profile-icon"></i></a>
    </div> -->

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
                    <button class="btn">+Add New</button>
                    <div class="search-container">
                        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search for classes..">
                        <button onclick="searchTable()"><i class="fas fa-search"></i></button>
                    </div>
                    <table>
                        <tr>
                            <th>No.</th>
                            <th>Class</th>
                            <th>Action</th>

                        </tr>
                        <tr>
                            <td>1</td>
                            <td>BSIT-A</td>
                            <td>
                                <button class="icon-btn"><i class="fas fa-edit"></i></button>
                                <button class="icon-btn"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>BSIT-A</td>
                            <td>
                                <button class="icon-btn"><i class="fas fa-edit"></i></button>
                                <button class="icon-btn"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>BSIT-A</td>
                            <td>
                                <button class="icon-btn"><i class="fas fa-edit"></i></button>
                                <button class="icon-btn"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>BSIT-A</td>
                            <td>
                                <button class="icon-btn"><i class="fas fa-edit"></i></button>
                                <button class="icon-btn"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                     
                        <!-- Add more rows as needed -->
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