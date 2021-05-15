<?php
    $dbhost = "localhost";
    $dbuser = "ernsal";
    $dbpassword = "HeeDee5EeCatain2";
    $dbname = "ernsal";


    if(!$con = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname))
    {
        die("failed to connect!");
    }
?>