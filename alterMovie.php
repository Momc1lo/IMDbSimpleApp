<?php
    session_start();
    
    require_once './Db.php';
    $db = new Db();
    
    if(isset($_GET['movieID'])) {
        $movieID = $_GET['movieID'];
    }
    
    $movie = $db->getMovieById($movieID);
    
    if(isset($_POST['alterMovie'])) {
        //echo "alter";
        $movieID = $_POST['movieID'];
        $title = $_POST['title'];
        $year = $_POST['year'];
        $duration = $_POST['duration'];
        $genre = $_POST['genre'];
        $description = $_POST['description'];
        $director = $_POST['director'];
        $screenwriter = $_POST['screenwriter'];
        $actors = $_POST['actors'];
        $production = $_POST['production'];
        //$poster = $title.".jpg";
        
        if(isset($_POST['file'])) {
            
            $file = $_FILES['file'];
            //print_r($file);
            $fileName = $_FILES['file']['name'];
            $fileTmpName = $_FILES['file']['tmp_name'];
            $fileSize = $_FILES['file']['size'];
            $fileError = $_FILES['file']['error'];
            $fileType = $_FILES['file']['type'];

            $fileExt = explode(".", $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png');

            if(in_array($fileActualExt, $allowed)) {
                if($fileError === 0) {
                    if($fileSize < 1000000) {
                        $path = "assets/".$movie['poster'];
                        unlink($path);
                        $fileNameNew = $fileExt[0].".".$fileActualExt;
                        $fileDestination = 'assets/'.$fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);
                        $poster = $fileName;

                        $db->alterMovie($movieID, $title, $year, $duration, $genre, $description, $director, $screenwriter, $actors, $production, $poster);
                        header("Location: index.php?altermoviesuccess");
                    }
                    else {
                        echo "<script>alert('Your file is too big!');</script>";
                    }
                }
                else {
                    echo "<script>alert('There was an error uploading your file!');</script>";
                }
            }
            else {
                echo "<script>alert('You cannot upload files of this type!');</script>";
            }
        
        }
        else {
            $poster = $movie['poster'];
            $db->alterMovie($movieID, $title, $year, $duration, $genre, $description, $director, $screenwriter, $actors, $production, $poster);
            header("Location: index.php?altermoviesuccess");
        }

    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Movie</title>
        <link href="alterMovieStyle.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <ul>
            <li><a href="index.php"><img src="assets/IMDB_Logo.png" width="40px" height="18px"></a></li>
            <li style="float:right"><a class="active" href="index.php?logout">Logout</a></li>
        </ul>
        <br>
        <form id="alterMovieForm" method="post" enctype="multipart/form-data">
            <h2>Edit Movie</h2>
            <p>Title: </p><input type="text" value="<?php echo $movie['title']; ?>" name="title" placeholder="Title"><br>
            <p>Year: </p><input type="text" value="<?php echo $movie['year']; ?>" name="year" placeholder="Year"><br>
            <p>Duration: </p><input type="text" value="<?php echo $movie['duration']; ?>" name="duration" placeholder="Duration"><br>
            <p>Genre: </p><input type="text" value="<?php echo $movie['ganre']; ?>" name="genre" placeholder="Genre"><br>
            <p>Description: </p><input type="text" value="<?php echo $movie['description']; ?>" name="description" placeholder="Description"><br>
            <p>Director: </p><input type="text" value="<?php echo $movie['director']; ?>" name="director" placeholder="Director"><br>
            <p>Screenwriter: </p><input type="text" value="<?php echo $movie['screenwriter']; ?>" name="screenwriter" placeholder="Screenwriter"><br>
            <p>Actors: </p><input type="text" value="<?php echo $movie['actors']; ?>" name="actors" placeholder="Actors"><br>
            <p>Production: </p><input type="text" value="<?php echo $movie['production']; ?>" name="production" placeholder="Production"><br>
            <input type="hidden" name="movieID" value="<?php echo $movieID; ?>">
            <p>Change movie poster: </p><input type="file" name="file" id="file"><br>
            <input type="submit" name="alterMovie" value="Edit Movie"><br>
        </form>
    </body>
</html>
