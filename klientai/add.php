<?php
session_start();
    include("../login/connection.php");
    include("../login/functions.php");

    $user_data = check_login($con);
    
    $id = generateRandomString(8);
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $vardas = $_POST['vardas'];
        $pavarde = $_POST['pavarde'];
        $telefonas = $_POST['telefonas'];
        $epastas = $_POST['epastas'];

        if(!empty($vardas) && !empty($pavarde) && !empty($telefonas) && !empty($epastas))
        {
            $query = "INSERT INTO uzsakovas (id,vardas,pavarde,telefonas,epastas) VALUES($id,'$vardas','$pavarde', '$telefonas', '$epastas')";
            mysqli_query($con, $query);
            header("Location:../Klientai.php");
            die;
        }
        else
        {
            header("Location:add.php?msg=invalidData");
        }
    }
?>

<!DOCTYPE html>
<html lang="lt">
<head>
  <link href="../Logstyle.css" rel="stylesheet" />
  <meta name="autoriai" content="Domantas Orvidas;Ernestas Šaltys;Lukas Marcinkevičius">
  <meta name="apibūdinimas" content="Logistikos pagalbininkas">
  <meta name="keywords" content="logistika">
  <title>LogBuddy - Klientai</title>
</head>
<body>
    <div class="menuHeader">
        <a href="../index.php"><img src="../LOGO.png"></a>
        <div class="search">
            <input class = "search-field" type="search" placeholder="Paieška">
            <button class ="search-button" type="submit"><i class="search-button-text">Ieškoti</i></button>
        </div>
        <div class = "userData">
                <label for="username">Sveiki, <?php echo $user_data['prisijungimo_vardas']?></label>
                <a href="../login/logout.php"> Atsijungti </a>
            </div>
        </div>
    <div class="menuSidebar">
    <ul>
            <li class="CurrentPage"><a>Klientai</a></li>
            <li><a href="../uzsakymai.php">Užsakymai</a></li>
            <li><a href="../prekes.php">Prekės</a></li>
            <li><a href="../darbuotojai.php">Darbuotojai</a></li>
            <li><a href="../pelnas.php">Pelnas</a></li>
        </ul>

    </div>
    <div class="pagrindinis">
    <h2>Pridėti klientą</h2>
    <?php
        if (isset($_GET["msg"]) && $_GET["msg"] == 'invalidData') {
            echo "<p class=wrong>Įvesti ne visi duomenys!<p>";
        }
    ?>
    <form method = "post">
        <div class = "inputContainer">
            <p class = "inputHeadline">Vardas</p> 
            <input class = 'formInput' type = 'text' name='vardas' placeholder="Vardas">
        </div>
        <div class = "inputContainer">
            <p class = "inputHeadline">Pavardė</p> 
            <input class = 'formInput' type = 'text' name='pavarde' placeholder="Pavardė">
        </div>
        <div class = "inputContainer">
            <p class = "inputHeadline">Tel. nr.</p> 
            <input class = 'formInput' type = 'tel' name='telefonas' placeholder="Telefonas">
        </div>
        <div class = "inputContainer">
            <p class = "inputHeadline">El. paštas</p> 
            <input class = 'formInput' type = 'email' name='epastas' placeholder="El. paštas">
        </div>  
            <a class = "buttonReturn" href="../Klientai.php">Grįžti į sąrašą</a>  
            <input class ='buttonSuccess' type="submit" name="submit" value="Išsaugoti">                       
        </form>
    </div>
</body>
</html>