<?php
session_start();
    include("connection.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];

        if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
        {
            $query = "select * from naudotojas where prisijungimo_vardas = '$user_name' limit 1";
            $result = mysqli_query($con, $query);

            if($result)
            {
                if($result && mysqli_num_rows($result) > 0)
                {
                    $user_data = mysqli_fetch_assoc($result);
                    if($user_data['slaptazodis'] === $password)
                    {
                        $_SESSION['user_id'] = $user_data['id'];
                        header("Location: ../index.php");
                        die;
                    }
                }
            }
            header("Location:login.php?msg=failed");
        }
        else
        {
            header("Location:login.php?msg=failed");
        }
    }

?>
<html>
<head>
<title>Prisijungimo forma</title>
    <link rel="stylesheet" type="text/css" href="LoginStyle.css">
<body>
    <div class="loginbox">
    <img src="LoginAssets/avatar.jpg" class="avatar">
        <h1>Prisijungimas</h1>
        <form method="post">
            <?php
            if (isset($_GET["msg"]) && $_GET["msg"] == 'failed') {
                echo "<p class=wrong>Wrong username or password!<p>";
                }
            ?>
            <p>Vartotojo vardas</p>
            <input type="text" name="user_name" placeholder="Įveskite vardą">
            <p>Slaptažodis</p>
            <input type="password" name="password" placeholder="Įveskite slaptažodį">
            <input type="submit" value="Prisijungti">
            <a href="signup.php">Neturite paskyros?</a><br>
        </form>

    </div>

</body>
</head>
</html>
