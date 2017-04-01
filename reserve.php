<!DOCTYPE html>
<html >
<head>

  <meta charset="UTF-8">
  <title>Sign-Up/Login Form</title>
  <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  
      <link rel="stylesheet" href="css/style.css">
  
</head>

<?php
    session_start();

    try{
      $dbh = new PDO('mysql:host=localhost;dbname=ktcs', 'root', '282mysql');
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      error_reporting(E_ALL);
      ini_set('display_errors',1);
      $date = $_POST['date'];
    } catch(PDOException $e) {
      echo "Did not connect!";
      echo $e->getMessage();
      die();
    }
?>

<body>
  <br><br>
  <h1> Welcome to the KTCS Pick up/Drop off System </h1>

  <div class="adminform">
      
      <ul class="tab-group">
        <li class="tab active"><a href="#reserve" style="width:100%;">Reserve a car</a></li>
      </ul>
      
    <div class="tab-content">
        <div id="reserve">   

          
          <?php 
                $q = "SELECT distinct cars.make, cars.model, cars.year FROM cars INNER JOIN reservations on cars.vin = reservations.vin WHERE reservations.date != '{$date}'";
                $rows = $dbh->query($q);

                if ($rows->rowCount() == 0) {
                  echo "<h1> Sorry! Looks like there's no cars available for this date. Please go back and try a different one.";
                }

                else{
                  echo "<h1> Here are the cars available for the date you specified, please click on one to reserve it </h1>";
                  foreach($rows as $row){
                  $var = $row['make']." " . $row['model'] . " " . $row['year'];
                  echo "<a href='reservecar.php'> <h1> {$var} </h1> </a>";
                  }
                }

          ?>

        </div>

      </div><!-- tab-content -->
      
</div> <!-- /form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>

</body>
</html>