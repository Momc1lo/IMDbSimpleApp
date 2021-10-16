<?php

    require_once './Db.php';
    $db = new Db();
    
    if(isset($_GET['deleteM'])) {
        $movieID = $_GET['deleteM'];
        $movie = $db->getMovieById($movieID);
        $path = "assets/".$movie['poster'];
        unlink($path);
        
        $db->deleteMovie($movieID);
        header("Location: index.php");
    }

?>

