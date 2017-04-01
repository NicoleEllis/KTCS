  <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
 <link rel="stylesheet" href="css/style.css">

<?php
    error_reporting(E_ALL);
    ini_set('display_errors',1);
    $mid = $_POST['userName'];
    $name = $_POST['fullName'];
    $email = $_POST['email'];
    $phoneNum = $_POST['phone'];
    $licenseNum = $_POST['license'];
    $annualFee = $_POST['memberType'];

    if ($annualFee == 'Bronze'){
        $annualFee = 130;
    }
    else if ($annualFee == 'Silver'){
        $annualFee = 160;
    }
    else{
        $annualFee = 200;
    }



     try{
        $dbh = new PDO('mysql:host=localhost;dbname=ktcs', 'root', '282mysql');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = "SELECT mid from members where mid = $mid";
        $rows = $dbh->query($q);

        if ($rows->rowCount() != 0) {
            echo "Sorry! Looks like this MID is already taken. Go back and try again";
;        }
        else{
            $q = "INSERT INTO members (mid, name, phoneNum, email, licenseNum, annualFee) VALUES ($mid, '$name', $phoneNum, '$email', $licenseNum, $annualFee)";
            $dbh->exec($q);
            echo "<br><br><br><h1> Congrats! You're officially a member</h1>";
            echo "<h1> <a href='./index.html'> Head back to the login page to start using KTCS!</a> </h1>";
            
        }

    } catch(PDOException $e) {
        echo "Did not connect!";
        echo $e->getMessage();
        die();
    }
    

?>