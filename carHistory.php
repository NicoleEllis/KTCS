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
      $vin = $_POST['vin'];
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
                $q = "select * from carRentalHistory where vin = '$vin'";
                $rows = $dbh->query($q);

                if ($rows->rowCount() == 0) {
                   echo "<h1> This car hasn't been rented.. Yet!</h1>";
                }

                else{
                  echo "<h1> Here is the rental history for the specified car</h1>";
                  echo "<table>";
                  echo "<tr><th> Vehicle ID </th><th> Member ID </th> <th> Pick Up Odometer </th> <th> Drop Off Odometer</th> <th> Return Status </th> <th> Drop Off Date</th> <th> Drop Off Time</th></tr>";
                  foreach($rows as $row){
                    echo "<tr><td>" . $row['vin'] . "</td>";
                    echo "<td>" . $row['mid'] . "</td>";
                    echo "<td>" . $row['pickUpOdometer'] . "</td>";
                    echo "<td>" . $row['dropOffOdometer'] . "</td>";
                    echo "<td>" . $row['returnStatus'] . "</td>";
                    echo "<td>" . $row['dropOffTime'] . "</td>";
                    echo "<td>" . $row['dropOffDate'] . "</td></tr>";

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