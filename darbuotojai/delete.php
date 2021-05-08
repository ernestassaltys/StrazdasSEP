<?php
session_start();
    include("../login/connection.php");
    include("../login/functions.php");

    $user_data = check_login($con);
    
    $id = $_GET['rn'];
    $query = "DELETE FROM darbuotojai WHERE id = $id";
    mysqli_query($con, $query);
    header("Location:../darbuotojai.php");
    die;
?>