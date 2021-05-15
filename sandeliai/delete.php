<?php
session_start();
    include("../login/connection.php");
    include("../login/functions.php");

    $user_data = check_login($con);
    
    $id = $_GET['rn'];
    $countQuery = "SELECT id, count(*) as NUM FROM preke WHERE fk_Sandelysid = $id";
    $result = mysqli_query($con, $countQuery);
    $count = $result->fetch_assoc();
    $darbCountQuery = "SELECT id, count(*) as NUM FROM darbuotojai WHERE fk_Sandelysid = $id";
    $darbresult = mysqli_query($con, $darbCountQuery);
    $darbCount = $darbresult->fetch_assoc();
    if($result && $count['NUM'] > 0)
    {
        header("Location:../sandeliai.php?msg=fkfail");
        die;
    }
    else if($darbresult && $darbCount['NUM'] > 0)
    {
        header("Location:../sandeliai.php?msg=fkfaildarb");
        die;
    }
    else{
        $query = "DELETE FROM sandelys WHERE id = $id";
        mysqli_query($con, $query);
        header("Location:../sandeliai.php?msg=success");
        die;
    }  
?>