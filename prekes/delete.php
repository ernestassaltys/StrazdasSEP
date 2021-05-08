<?php
session_start();
    include("../login/connection.php");
    include("../login/functions.php");

    $user_data = check_login($con);
    
    $id = $_GET['rn'];
    $countQuery = "SELECT id, count(*) as NUM FROM pelnas WHERE fk_Prekeid = $id";
    $result = mysqli_query($con, $countQuery);
    $count = $result->fetch_assoc();
    if($result && $count['NUM'] > 0)
    {
        header("Location:../prekes.php?msg=fkfail");
        die;
    }
    else{
        $query = "DELETE FROM preke WHERE id = $id";
        mysqli_query($con, $query);
        header("Location:../prekes.php");
        die;
    }  
?>