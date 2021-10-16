<?php
    session_start();
    require_once './Db.php';
    $db = new Db();
    
    if(isset($_GET['movieID'])) {
        $movie = $db->getMovieById($_GET['movieID']);
    }
    
    $user = $db->getUserById($_SESSION['ath']);
    
    if(isset($_GET['grade'])) {
        if($db->markExists($_SESSION['ath'], $_GET['movieID'])) {
            $db->alterMark($_SESSION['ath'], $_GET['movieID'], $_GET['giveMark']);
        }
        else {
            $db->addMark($_SESSION['ath'], $_GET['movieID'], $_GET['giveMark']);
        }
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $movie['title']; ?></title>
        <link href="movieStyle.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <ul>
            <li><a href="index.php"><img src="assets/IMDB_Logo.png" width="40px" height="18px"></a></li>
            <li style="float:right"><a class="active" href="index.php?logout">Logout</a></li>
            <?php
                if($user['isAdmin']) {
            ?>
            <li style="float:right"><a class="active" href="alterMovie.php?movieID=<?php echo $movie['id']; ?>">Edit Movie</a></li>
            <li style="float:right"><a class="active" href="deleteMovie.php?deleteM=<?php echo $movie['id']; ?>">Delete Movie</a></li>
            <?php        
                }
            ?>
        </ul>
        <div id="container">
            <div id="dleft">
                <h1><?php echo $movie['title']; echo "  (".$movie['year'].")";?></h1>
                <p>
                    <b>Duration:</b>
                    <?php
                        $dd = $movie['duration'];
                        $h = floor($dd / 60);
                        $m = $dd % 60;
                        echo $h."h ".$m."min";
                    ?>
                </p>
                <img src="assets/<?php echo $movie['poster']; ?>" style="width: 200px; height: 300px">
            </div>
            <div id="dright">
                <div id="innerRight">
                    <p>
                        <b>IMDb RATING:</b>
                        <?php
                            $am = $db->averageMark($movie['id']);
                            if($am == NULL)
                                echo "No reviews so far";
                            else {
                                $format_number = number_format($am, 1, '.', '');
                                echo $format_number;
                            }
                        ?>
                    </p>
                    <p><b>Genre:</b> <?php echo $movie['ganre']; ?></p>
                    <p><b>Description:</b> <?php echo $movie['description']; ?></p>
                    <p><b>Director:</b> <?php echo $movie['director']; ?></p>
                    <p><b>Screenwriter:</b> <?php echo $movie['screenwriter']; ?></p>
                    <p><b>Actors:</b> <?php echo $movie['actors']; ?></p>
                    <p><b>Production:</b> <?php echo $movie['production']; ?></p>
                    
                    <?php
                        if(!$user['isAdmin']) {
                    ?>
                    <form id="reviewFrom" method="get">
                        <select name="giveMark">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                        <input type="hidden" name="movieID" value="<?php echo $movie['id']; ?>">
                        <input type="submit" name="grade" value="Grade">
                    </form>
                    <?php
                        }
                    ?>
                </div>
            </div>
            
        </div>
    </body>
</html>
