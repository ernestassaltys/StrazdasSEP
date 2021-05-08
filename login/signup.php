<?php
session_start();
    include("connection.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $display_name = $_POST['display_name'];

        $query = "SELECT * FROM `naudotojas` WHERE `prisijungimo_vardas` = '$user_name' OR `epastas` = '$email'";
        $result = mysqli_query($con, $query);

        if(!empty($user_name) && !empty($password) && !empty($email) && !empty($phone) && !is_numeric($user_name ) && !empty($display_name))
        {
            if($result && mysqli_num_rows($result) > 0)
            {
                header("Location:signup.php?msg=exists");
            }
            else
            {
                $user_id = generateRandomString(8);
                $query = "insert into naudotojas (id, prisijungimo_vardas, display_name, slaptazodis, epastas, telefonas) 
                values ('$user_id', '$user_name', '$display_name', '$password', '$email', '$phone')";
                mysqli_query($con, $query);
                header("Location: login.php");
                die; 
            }
        }
        else
        {
            header("Location:signup.php?msg=failed");
        }
    }
?>

<html>
<head>
<title>Registracijos forma</title>
    <link rel="stylesheet" type="text/css" href="LoginStyle.css">
<body>
    <div class="loginbox">
    <img src="LoginAssets/avatar.jpg" class="avatar">
        <h1>Registracija</h1>
        <form method="post">
            <?php
            if (isset($_GET["msg"]) && $_GET["msg"] == 'failed') {
                echo "<p class=wrong>Įvesti ne visi duomenys!<p>";
                }
            if (isset($_GET["msg"]) && $_GET["msg"] == 'exists') {
                echo "<p class=wrong>Toks naudotojas jau yra!<p>";
                }
            ?>
            <p> Prisijungimo Vardas </p>
            <input type="text" name="user_name" placeholder="Iveskite norimą prisijungimo vardą">
            <p> Vardas sistemoje </p>
            <input type="text" name="display_name" placeholder="Iveskite norimą vardą sistemoje">
            <p> El. paštas </p>
            <input type="email" name="email" placeholder="Iveskite el. pašto adresą">
            <p> Tel. nr.</p>
            <input type="tel" name="phone" placeholder="Iveskite telefono numerį">
            <p>Slaptažodis</p>
            <input type="password" name="password" placeholder="Iveskite norimą slaptažodį">
            <input type="submit" value="Registruotis">
            <a href="login.php">Turite paskyra? Prisijunkite</a><br>
        </form>

    </div>

</body>
</head>
</html>