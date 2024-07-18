<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Confirmation</title>
    <link rel="stylesheet" href="../Css/style.css">
</head>
<style>
   .popup-box {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.4);
    z-index: 2;
}

.popup {
    position: fixed;
    top: 50%;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 3;
    max-width: 300px;
    border-radius: 5px;
    transition: all 0.25s ease;
    background: linear-gradient(100deg, #e0eafc, #cfdef3);
    color: black;
}
.popup input{
    width: 324px;
    height: 50px;
    margin-left: 20px;
    margin-right: 20px;
    margin-top: 20px;
}
.popup textarea{
    width: 370px;
    margin-left: 20px;
    height: 200px;
    margin-right: 20px;
}
.popup label {
    margin-left: 20px;
}

/* Adjustments to make the popups centered */
.popup h2 ,.popup h1{
    text-align: center;
}

.popup .closeBtn , .popup button{
    position: absolute;
    top: 0;
    right: 0;
    transform: translate(50%, -50%);
    background-color: transparent;
    color: red;
    border: none;
    border-radius: 50%;
    padding: 5px;
    cursor: pointer;
    margin-right: 32px;
    margin-top: 32px;
    font-size: 23px;
}

.popup form {
    overflow: hidden; /* Added to clear floats */
}
.popup input[type="submit"] {
    padding: 5px 10px;
    background: red;
    color: rgb(241, 231, 231);
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
    font-size: 16px;
    width: 127px;
    max-width: 150px; /* Added for responsiveness */
    margin-top: 10px;
    margin-bottom: 10px;
    
}


</style>
<body>
<?php include 'sidebar.php'; ?>

<div class="popup-box" style="display:flex; text-align:center;">
    <div class="popup">
        <h2>Logout </h2>
        <hr>
        <p>Are you sure you want to log out?</p>
        <form action="logout.php" method="post">
            <input type="submit" name="confirmLogout" value="Yes, Logout">
            
        </form>
        <button class="closeBtn"  onclick="window.location.href='admin.php'">x</button>
    </div>
</div>
</body>
</html>