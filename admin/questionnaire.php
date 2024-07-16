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
      .evaluation-form {
    width: 100%;
    max-width: 500px;
    margin: 0 auto;
    padding: 20px;
    background: #f4f4f4;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.evaluation-form h3 {
    margin-bottom: 20px;
    text-align: center;
}

/* Styles for form groups */
.evaluation-form .form-group {
    margin-bottom: 15px;
}

/* Styles for form labels */
.evaluation-form .form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

/* Styles for text input, textarea, and select elements */
.evaluation-form .form-group input,
.evaluation-form .form-group textarea,
.evaluation-form .form-group select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 16px;
}

/* Additional styles for textarea */
.evaluation-form .form-group textarea {
    resize: vertical;
    min-height: 100px;
}

/* Styles for radio buttons */
.evaluation-form .form-group input[type="radio"] {
    width: auto;
    margin-right: 10px;
}

/* Styles for radio group */
.evaluation-form .form-group .radio-group {
    display: flex;
    justify-content: space-between;
}

.evaluation-form .form-group .radio-group label {
    flex: 1;
}

.evaluation-form .form-group .radio-group input {
    margin-right: 5px;
}

/* Styles for the submit button */
.evaluation-form button[type="submit"] {
    width: 100%;
    padding: 10px;
    background: #007bff;
    border: none;
    border-radius: 4px;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
}

.evaluation-form button[type="submit"]:hover {
    background: #0056b3;
}

/* Responsive styles */
@media (max-width: 600px) {
    .evaluation-form {
        padding: 15px;
    }
}
    </style>
</head>
<body>
    <button class="menu-btn" onclick="toggleMenu()">&#9776;</button>

    <!-- Side navigation menu -->
    <?php include 'sidebar.php'; ?>

    <!-- Page content -->
    <div class="main content">
        <h2>Manage Questionnaire</h2>
        <hr>
        <div class="row1"></div>
        <div class="row">
            <div class="column">
                <div class="card4">
                    <form action="save_questions.php" method="post">
                        <div class="form-group">
                            <label for="criteria">Criteria</label>
                            <select id="criteria" name="criteria" required>
                                <option value="">Select Criteria</option>
                                <option value="Criteria 101">Criteria 101</option>
                                <option value="Criteria 102">Criteria 102</option>
                                <!-- Add other criteria options as needed -->
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea name="questions" id="questions" rows="4" placeholder="Enter questions (one per line)" required></textarea>
                        </div>
                        <button type="submit">Save</button>
                    </form>
                </div>
            </div>
            <div class="evaluation-form">
                <h3>Evaluation Form</h3>
                <form id="evaluationForm" method="post">
                
                    <div id="dynamicFields">
                        <?php
                        // Fetch and display questions from the database
                        include 'fetch_questions.php';
                        ?>
                    </div>

                </form>
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
    </script>
</body>
</html>