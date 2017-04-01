<link rel="stylesheet" type="text/css" href="style.css">

<?php
    error_reporting(E_ALL);
    ini_set('display_errors',1);
    session_start();

    $_SESSION['user'] = $_GET['username'];


     try{
        $dbh = new PDO('mysql:host=localhost;dbname=ktcs', 'root', '282mysql');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = "SELECT mid FROM admins WHERE mid = {$_SESSION['user']}";
        $rows = $dbh->query($q);

        if ($rows->rowCount() !=0) {
            header("Location: ./administration.html");
        }
        else{
            header("Location: ./main.php");
        }

    } catch(PDOException $e) {
        echo "Did not connect!";
        echo $e->getMessage();
        die();
    }
    

?>