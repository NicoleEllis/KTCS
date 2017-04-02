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
      $location = $_POST['location'];
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
                $q = "SELECT distinct cars.vin, cars.make, cars.model, cars.year FROM cars INNER JOIN reservations on cars.vin = reservations.vin WHERE reservations.date != CURDATE() and cars.parkingAddress = '$location'";
                $rows = $dbh->query($q);

                if ($rows->rowCount() == 0) {
                   echo "<h1> This car hasn't been rented.. Yet!</h1>";
                }

                else{
                  echo "<h1> Here are the available cars for today for $location </h1>";
                  echo "<table>";
                  echo "<tr><th> Vehicle ID </th> <th> Make </th> <th> Model </th> <th> Year </th></tr>";
                  foreach($rows as $row){
                    echo "<tr><td>" . $row['vin'] . "</td>";
                    echo "<td>" . $row['make'] . "</td>";
                    echo "<td>" . $row['model'] . "</td>";
                    echo "<td>" . $row['year'] . "</td></tr>";

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