<?php
    session_start();
    require_once './Db.php';
    $db = new Db();
    
    if(isset($_POST['addNewMovie'])) {
        $title = $_POST['title'];
        $year = $_POST['year'];
        $duration = $_POST['duration'];
        $genre = $_POST['genre'];
        $description = $_POST['description'];
        $director = $_POST['director'];
        $screenwriter = $_POST['screenwriter'];
        $actors = $_POST['actors'];
        $production = $_POST['production'];
        //$poster = $_GET['fileToUpload'];
        
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
                    $fileNameNew = $fileExt[0].".".$fileActualExt;
                    $fileDestination = 'assets/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    $poster = $fileName;
        
                    $db->addMovie($title, $year, $duration, $genre, $description, $director, $screenwriter, $actors, $production, $poster);
                    header("Location: index.php?uploadsuccess");
                    //header("Location: index.php?uploadsuccess");
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
        /*
        $poster = $fileName;
        
        $db->addMovie($title, $year, $duration, $genre, $description, $director, $screenwriter, $actors, $production, $poster);
        header("Location: index.php");
         * 
         */
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add Movie</title>
        <link href="addMovieStyle.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <ul>
            <li><a href="index.php"><img src="assets/IMDB_Logo.png" width="40px" height="18px"></a></li>
            <li style="float:right"><a class="active" href="index.php?logout">Logout</a></li>
        </ul>
        <br>
        <form id="addMovieFrom" method="post" enctype="multipart/form-data">
            <h2>Add Movie</h2>
            <input type="text" name="title" placeholder="Title" required><br>
            <input type="text" name="year" placeholder="Year" required><br>
            <input type="text" name="duration" placeholder="Duration" required><br>
            <input type="text" name="genre" placeholder="Genre" required><br>
            <input type="text" name="description" placeholder="Description" required><br>
            <input type="text" name="director" placeholder="Director" required><br>
            <input type="text" name="screenwriter" placeholder="Screenwriter" required><br>
            <input type="text" name="actors" placeholder="Actors" required><br>
            <input type="text" name="production" placeholder="Production" required><br>
            Insert movie poster: <br><input type="file" name="file" id="file"><br>
            <input type="submit" name="addNewMovie" value="Add Movie"><br>
        </form>
    </body>
</html>
