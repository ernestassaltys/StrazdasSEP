<?php
session_start();
    include("../login/connection.php");
    include("../login/functions.php");

    $user_data = check_login($con);
    
    $id = $_GET['rn'];
    $countQuery = "SELECT id, count(*) as NUM FROM uzsakymas WHERE fk_Uzsakovasid = $id";
    $result = mysqli_query($con, $countQuery);
    $count = $result->fetch_assoc();
    if($result && $count['NUM'] > 0)
    {
        header("Location:../Klientai.php?msg=fkfail");
        die;
    }
    else{
        $query = "DELETE FROM uzsakovas WHERE id = $id";
        mysqli_query($con, $query);
        header("Location:../Klientai.php");
        die;
    }  
?>