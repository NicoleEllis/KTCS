  <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
 <link rel="stylesheet" href="css/style.css">

<?php
    error_reporting(E_ALL);
    ini_set('display_errors',1);
    $make = $_POST['make'];
    $model= $_POST['model'];
    $year = $_POST['year'];
    $parkingAddress = $_POST['location'];
    $vin = $_POST['vin'];
    $currentOdometer = $_POST['odo'];
    $currentOdometer = (int)$currentOdometer;
    $rental = $_POST['fee'];
    $returnStatus = 'Normal';


     try{
        $dbh = new PDO('mysql:host=localhost;dbname=ktcs', 'root', '282mysql');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $q = "INSERT into cars (vin, make, model, year, rental, parkingAddress, returnStatus, currentOdometer) VALUES ('$vin', '$make', '$model', '$year', '$rental', '$parkingAddress', '$returnStatus', '$currentOdometer')";
        $dbh->exec($q);
        echo "<br><br><br><h1> This car has been officially added to the fleet </h1>";
        
    
    } catch(PDOException $e) {
        echo "Did not connect!";
        echo $e->getMessage();
        die();
    }
    

?>