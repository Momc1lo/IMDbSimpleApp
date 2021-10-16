<?php
    require_once './Db.php';
    $db = new Db();
    
    if(isset($_GET['reg'])) {
        $fname = $_GET['fname'];
        $lname = $_GET['lname'];
        $email = $_GET['email'];
        $user = $_GET['user'];
        $pass = $_GET['pass'];
        
        $isEmailValid = $_GET['hiddenEmail'];
        if($isEmailValid == "1") {
            $db->addNewUser($fname, $lname, $email, $user, $pass);
            header("Location: login.php");
        }
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Register</title>
        <link href="registerStyle.css" rel="stylesheet" type="text/css"/>
        <script src="logic.js" type="text/javascript"></script>
    </head>
    <body>
        <h2>Register</h2>
        <form id="registerForm" method="get">
            <h2>Register</h2>
            <input type="text" name="fname" placeholder="Firstname" required><br>
            <input type="text" name="lname" placeholder="Lastname" required><br>
            <input type="text" name="email" placeholder="Email" id="email" required><br>
            <p id="worning"></p>
            <br>
            <input type="text" name="user" placeholder="Username" required><br>
            <input type="password" name="pass" placeholder="Password" required><br>
            <input type="hidden" id="hiddenEmail" name="hiddenEmail" value="1" required>
            <input type="submit" name="reg" value="Register" onclick="validateEmail()">
        </form>
    </body>
</html>
