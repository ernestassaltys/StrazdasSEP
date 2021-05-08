<?php
session_start();
    include("../login/connection.php");
    include("../login/functions.php");

    $user_data = check_login($con);
    
    $id = $_GET['rn'];
    $countQuery = "SELECT id, count(*) as NUM FROM saskaita WHERE fk_Uzsakymasid = $id";
    $result = mysqli_query($con, $countQuery);
    $count = $result->fetch_assoc();
    if($result && $count['NUM'] > 0)
    {
        header("Location:../uzsakymai.php?msg=fkfail");
        die;
    }
    else{
        $query = "DELETE FROM uzsakymas WHERE id = $id";
        mysqli_query($con, $query);
        header("Location:../uzsakymai.php");
        die;
    }  
?>