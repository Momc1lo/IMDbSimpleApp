<?php
    session_start();
    if(!isset($_SESSION['ath']))
        header("Location: regLog.php");
    
    require_once './Db.php';
    $db = new Db();
    
    $user = $db->getUserById($_SESSION['ath']);
    $movies = $db->getAllMovies();
    
    if(isset($_GET['logout'])) {
        session_destroy();
        header("Location: login.php");
    }
    if(isset($_GET['searchFor'])) {
        $movies = $db->searchMovie($_GET['searchMovie']);
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>IMDb</title>
        <link href="indexStyle.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <ul>
            <li><a href="index.php"><img src="assets/IMDB_Logo.png" width="40px" height="18px"></a></li>
            <li style="float:right"><a class="active" href="index.php?logout">Logout</a></li>
            <?php
                if($user['isAdmin']) {
            ?>
            <li style="float:right"><a class="active" href="addMovie.php">Add Movie</a></li>
            <?php        
                }
            ?>
        </ul>
        <form method="get" class="formSearch">
            <input type="search" id="searchMovie" name="searchMovie" placeholder="Search movie by title or by genre...">
            <input type="submit" name="searchFor" value="Search" id="searchMovieSubmit">
        </form>
        <div id="movieDisplay">
            <?php
                foreach($movies as $movie) {
            ?>
            <div id="movieBox">
            <a href="movie.php?movieID=<?php echo $movie['id']; ?>">
                <div class="movie">
                    <img src="assets/<?php echo $movie['poster']; ?>" style="width: 200px; height: 300px">
                    <h2 id="movieTitle"><?php echo $movie['title']; ?></h2>
                </div>
            </a>
            </div>
            <?php
                }
            ?>
        </div>
    </body>
</html>
