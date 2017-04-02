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

    try{
      $dbh = new PDO('mysql:host=localhost;dbname=ktcs', 'root', '282mysql');
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      error_reporting(E_ALL);
      ini_set('display_errors',1);
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
        <li class="tab active"><a href="#reserve" style="width:100%;">See cars</a></li>
      </ul>
      
    <div class="tab-content">
        <div id="reserve">   

          
          <?php 
                $q = "SELECT cars.vin, make, model, year, currentOdometer, odometerReading FROM cars INNER JOIN carMaintenance on carMaintenance.vin = cars.vin WHERE carMaintenance.latestMaintenance = 1 AND cars.currentOdometer-carMaintenance.odometerReading > 4999";
                $rows = $dbh->query($q);

                if ($rows->rowCount() == 0) {
                   echo "<h1> There are no cars that have > 5000 km since last maintenance</h1>";
                }

                else{
                  echo "<h1> Here are the cars that have > 5000 km since last maintenance</h1>";
                  echo "<table>";
                  echo "<tr><th> Vehicle ID </th><th> Make </th> <th> Model </th> <th> Year</th> <th>Current Odometer </th> <th> Last Maint. Odometer</th></tr>";
                  foreach($rows as $row){
                    echo "<tr><td>" . $row['vin'] . "</td>";
                    echo "<td>" . $row['make'] . "</td>";
                    echo "<td>" . $row['model'] . "</td>";
                    echo "<td>" . $row['year'] . "</td>";
                    echo "<td>" . $row['currentOdometer'] . "</td>";
                    echo "<td>" . $row['odometerReading'] . "</td></tr>";

                  }
                  echo "</table>";
                }

          ?>

        </div>

    </div><!-- tab-content -->
      
</div> <!-- /form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>

</body>
</html>