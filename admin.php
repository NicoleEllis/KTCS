<link rel="stylesheet" type="text/css" href="style.css">

<?php
    error_reporting(E_ALL);
    $action= $_POST['selection'];
    echo $action;
    header("Location: ./{$action}.html");
 

?>