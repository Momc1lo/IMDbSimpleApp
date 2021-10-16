<?php
    require_once './Db.php';
    $db = new Db();
    
    if(isset($_GET['sub'])) {
        $user = $_GET['user'];
        $pass = $_GET['pass'];
        
        $User = $db->loginCheck($user, $pass);
        
        if($User) {
            session_start();
            setcookie("user", $user, time() + 86400 * 2);
            if(isset($_GET['remember']))
                setcookie ("pass", $pass, time() + 86400 * 2);
            $_SESSION['ath'] = $User['id'];
            header("Location: index.php");
        }
        else
            echo "<script>alert('Invalid input data, check your credentials!');</script>";
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link href="loginStyle.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <form id="loginForm" method="get">
            <h2>Login</h2>
            <input type="text" name="user" placeholder="Username/Email"><br>
            <input type="password" name="pass" placeholder="Password"><br>
            <input type="checkbox" name="remember">&nbsp;Remember<br>
            <input type="submit" name="sub" value="Log in">
        </form>
    </body>
</html>
