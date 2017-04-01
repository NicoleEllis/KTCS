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
        <li class="tab active"><a href="#locations" style="width:25%;">View locations</a></li>
        <li class="tab"><a href="#pickup" style="width:25%;">Pick up a car</a></li>
        <li class="tab"><a href="#dropoff" style="width:25%;">Drop off a car</a></li>
        <li class="tab"><a href="#reserve" style="width:25%;">Reserve a car</a></li>
        <li class="tab"><a href="#history" style="width:100%;">Your history</a></li>
      </ul>
      
      <div class="tab-content">
        <div id="locations">   

          <h1> Here is a list of KTCS locations</h1>
          
          <?php 
                $q = "SELECT parkingAddress from parkingLocations";
                $rows = $dbh->query($q);

                foreach($rows as $row){
                  echo "<h1> {$row['parkingAddress']} </h1>";
                }
          ?>

        </div>
        
        <div id="pickup">   
          <h1> Please enter the following information to confirm pick up for your reservation today</h1>
          
          <form action="./pickup.php" method="post">
          
           <div class="field-wrap">
            <label>
              Car's current odometer<span class="req">*</span>
            </label>
            <input type="text" name="pickupOd" required autocomplete="off"/>
          </div>
          
          
          <button class="button button-block"/>Pick up!</button>
          
          </form>

        </div>

        <div id="dropoff">   
          <h1> Please enter the following information to confirm drop off for your current reservation </h1>
          
          <form action="./dropoff.php" method="post">
          
           <div class="field-wrap">
            <label>
              Car's current odomoeter <span class="req">*</span>
            </label>
            <input type="text" name="vin" required autocomplete="off"/>
          </div>
          
          
          <button class="button button-block"/>Drop off!</button>
          
          </form>

        </div>

        <div id="reserve">   
          <h1> When would you like to reserve a car for?</h1>
          
          <form action="./reserve.php" method="post">
          
           <div class="field-wrap">
            <label>
              Date (YYYY-MM-DD) <span class="req">*</span>
            </label>
            <input type="text" name="date" required autocomplete="off"/>
          </div>
          
          
          <button class="button button-block"/>Find cars</button>
          
          </form>

        </div>

        <div id="history">   
          <h1> Here is a summary of your drop off/pick up history</h1>
          <?php
          $q = "SELECT cars.make, cars.model, memberRentalHistory.pickUpOdometer, memberRentalHistory.dropOffOdometer, memberRentalHistory.location, memberRentalHistory.returnStatus FROM memberRentalHistory INNER JOIN cars ON cars.vin = memberRentalHistory.vin WHERE mid = {$_SESSION['user']}";

          $rows = $dbh->query($q);

          echo "<table>";
          echo "<tr><th>Make</th><th>Model</th><th>Pick up odometer</th><th>Drop off odometer</th> <th>Location</th> <th>Return Status</th></tr>"; 
            foreach($rows as $row){
              echo "<tr><td>" . $row['make'] . "</d>";
              echo "<td>" . $row['model'] . "</td>";
              echo "<td>" . $row['pickUpOdometer'] . "</td>";
              echo "<td>" . $row['dropOffOdometer'] . "</td>";
              echo "<td>" . $row['location'] . "</td>";
              echo "<td>" . $row['returnStatus'] . "</td> </tr>";
            }
            echo '</table>';

          ?>

        </div>
        
         <div id="comments">   
          <h1> Look for available cars from</h1>
          
          <form action="./login.php" method="post">
          
           <div class="field-wrap">
            <input list="locations" name="browser"/>
            <datalist id="locations">
              <option value="383 Earl Street">
              <option value="580 Johnson Street">
              <option value="452 Albert Street">
            </datalist>

          </div>          
          <button class="button button-block"/>Find available cars</button>
          
          </form>

        </div>

      </div><!-- tab-content -->
      
</div> <!-- /form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>

</body>
</html>
