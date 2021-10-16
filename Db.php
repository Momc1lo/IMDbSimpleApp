<?php

    class Db {
        
        const hostname = 'localhost';
        const username = 'root';
        const password = '';
        const database = 'imdb';
        
        private $dbh;
        
        function __construct() {
            try {
                $connection_string = "mysql:host=".self::hostname.";dbname=".self::database;
                $this->dbh = new PDO($connection_string, self::username, self::password);
            } catch (PDOException $ex) {
                die($ex->getMessage());
            }
        }
        
        function __destruct() {
            $this->dbh = null;
        }
        
        function getAllMovies() {
            try {
                $sql = "select * from movie";
                $pdo_expression = $this->dbh->query($sql);
                $array = $pdo_expression->fetchAll(PDO::FETCH_ASSOC);
                return $array;
            } catch (PDOException $ex) {
                die($ex->getMessage());
            }
        }
        
        function loginCheckUsername($user, $pass) {
            try {
                $sql = "select * from user where username='$user' and password='$pass'";
                $pdo_expression = $this->dbh->query($sql);
                $obj = $pdo_expression->fetch(PDO::FETCH_ASSOC);
                return $obj;
            } catch (PDOException $ex) {
                die($ex->getMessage());
            }
        }
        
        function loginCheckEmail($email, $pass) {
            try {
                $sql = "select * from user where email='$email' and password='$pass'";
                $pdo_expression = $this->dbh->query($sql);
                $obj = $pdo_expression->fetch(PDO::FETCH_ASSOC);
                return $obj;
            } catch (PDOException $ex) {
                die($ex->getMessage());
            }
        }
        
        function loginCheck($user_email, $pass) {
            try {
                $objUser = $this->loginCheckUsername($user_email, $pass);
                $objEmail = $this->loginCheckEmail($user_email, $pass);
                if($objUser) {
                    return $objUser;
                }
                else if($objEmail) {
                    return $objEmail;
                }
                else {
                    return null;
                }
            } catch (PDOException $ex) {
                die($ex->getMessage());
            }
        }
        
        function addNewUser($fname, $lname, $email, $user, $pass) {
            try {
                $sql = "insert into user(fname, lname, email, username, password, isAdmin)";
                $sql.= " values('$fname', '$lname', '$email', '$user', '$pass', '0')";
                $pdo_expression = $this->dbh->exec($sql);
            } catch (PDOException $ex) {
                die($ex->getMessage());
            }
        }
        
        function getUserById($id) {
            try {
                $sql = "select * from user where id=$id";
                $pdo_expression = $this->dbh->query($sql);
                $obj = $pdo_expression->fetch(PDO::FETCH_ASSOC);
                return $obj;
            } catch (PDOException $ex) {
                die($ex->getMessage());
            }
        }
        
        function getMovieById($id) {
            try {
                $sql = "select * from movie where id=$id";
                $pdo_expression = $this->dbh->query($sql);
                $obj = $pdo_expression->fetch(PDO::FETCH_ASSOC);
                return $obj;
            } catch (PDOException $ex) {
                die($ex->getMessage());
            }
        }
        
        function searchMovie($criteria) {
            try {
                $sql = "select * from movie where title like '%$criteria%' or ganre like '%$criteria%'";
                $pdo_expression = $this->dbh->query($sql);
                $array = $pdo_expression->fetchAll(PDO::FETCH_ASSOC);
                return $array;
            } catch (PDOException $ex) {
                die($ex->getMessage());
            }
        }
        
        function averageMark($movieID) {
            try {
                $sql = "SELECT AVG(mark) as average from marks where movieID = $movieID";
                $pdo_expression = $this->dbh->query($sql);
                $obj = $pdo_expression->fetch(PDO::FETCH_ASSOC);
                return $obj['average'];
            } catch (PDOException $ex) {
                die($ex->getMessage());
            }
        }
        
        function markExists($userID, $movieID) {
            try {
                $sql = "select * from marks where userID=$userID and movieID = $movieID";
                $pdo_expression = $this->dbh->query($sql);
                $obj = $pdo_expression->fetch(PDO::FETCH_ASSOC);
                return $obj;
            } catch (PDOException $ex) {
                die($ex->getMessage());
            }
        }
        
        function addMark($userID, $movieID, $mark) {
            try {
                $sql = "insert into marks(userID, movieID, mark) values('$userID', '$movieID', '$mark')";
                $pdo_expression = $this->dbh->exec($sql);
            } catch (PDOException $ex) {
                die($ex->getMessage());
            }
        }
        
        function alterMark($userID, $movieID, $mark) {
            try {
                $sql = "update marks set mark=$mark where userID=$userID and movieID=$movieID";
                $pdo_expression = $this->dbh->exec($sql);
            } catch (PDOException $ex) {
                die($ex->getMessage());
            }
        }
        
        function addMovie($title, $year, $duration, $genre, $description, $director, $screenwriter, $actors, $production, $poster) {
            try {
                $sql = "insert into movie(title, year, duration, ganre, description, director, screenwriter, actors, production, poster)";
                $sql.= " values('$title', '$year', '$duration', '$genre', '$description', '$director', '$screenwriter', '$actors', '$production', '$poster')";
                $pdo_expression = $this->dbh->exec($sql);
            } catch (PDOException $ex) {
                die($ex->getMessage());
            }
        }
        
        function deleteMovie($movieID) {
            try {
                $sql = "delete from movie where id=$movieID";
                $pdo_expression = $this->dbh->exec($sql);
            } catch (PDOException $ex) {
                die($ex->getMessage());
            }
        }
        
        function alterMovie($id, $title, $year, $duration, $genre, $description, $director, $screenwriter, $actors, $production, $poster) {
            try {
                $this->dbh->beginTransaction();
                $sth = $this->dbh->exec("UPDATE movie SET title='$title' WHERE id=$id");
                $sth = $this->dbh->exec("UPDATE movie SET year=$year WHERE id=$id");
                $sth = $this->dbh->exec("UPDATE movie SET duration=$duration WHERE id=$id");
                $sth = $this->dbh->exec("UPDATE movie SET ganre='$genre' WHERE id=$id");
                $sth = $this->dbh->exec("UPDATE movie SET description='$description' WHERE id=$id");
                $sth = $this->dbh->exec("UPDATE movie SET director='$director' WHERE id=$id");
                $sth = $this->dbh->exec("UPDATE movie SET screenwriter='$screenwriter' WHERE id=$id");
                $sth = $this->dbh->exec("UPDATE movie SET actors='$actors' WHERE id=$id");
                $sth = $this->dbh->exec("UPDATE movie SET production='$production' WHERE id=$id");
                $sth = $this->dbh->exec("UPDATE movie SET poster='$poster' WHERE id=$id");
                $this->dbh->commit();
            } catch (PDOException $ex) {
                $this->dbh->rollBack();
                die($ex->getMessage());
            }
        }
        
    }
    
?>
