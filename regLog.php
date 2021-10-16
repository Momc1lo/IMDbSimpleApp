<?php
    if(isset($_GET['login']))
        header("Location: login.php");
    if(isset($_GET['register']))
        header("Location: register.php");
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registration/Login</title>
        <link href="regLogStyle.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <form id="regLogForm" method="get">
            <h2>IMDb</h2>
            <p>Do you already have an account?</p>
            <input type="submit" name="login" value="Log in">
            <input type="submit" name="register" value="Register">
        </form>
    </body>
</html>
