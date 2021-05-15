<?php
session_start();
    include("../login/connection.php");
    include("../login/functions.php");

    $user_data = check_login($con);
    
    $id = $_GET['rn'];
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $vardas = $_POST['vardas'];
        $pavarde = $_POST['pavarde'];
        $telefonas = $_POST['telefonas'];
        $epastas = $_POST['epastas'];

        if(!empty($vardas) && !empty($pavarde) && !empty($telefonas) && !empty($epastas))
        {
            $query = "UPDATE uzsakovas SET vardas ='$vardas', pavarde= '$pavarde', telefonas='$telefonas', epastas='$epastas' WHERE id='$id'";
            mysqli_query($con, $query);
            header("Location:../Klientai.php");
            die;
        }
        else
        {
            header("Location:edit.php?rn=$id&msg=invalidData");
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
        <div class = "dropdown">
                <button class = "dropbtn">Sveiki, <?php echo $user_data['display_name']?></button>
                <div class = "dropdown-content">
                    <a href="account/general.php">Nustatymai</a>
                    <a href="login/logout.php">Atsijungti</a>
                </div>
                
            </div>
        </div>
    <div class="menuSidebar">
        <ul>
            <li class="CurrentPage"><a href="../Klientai.php">Klientai</a></li>
            <li><a href="../uzsakymai.php">Užsakymai</a></li>
            <li><a href="../prekes.php">Prekės</a></li>
            <li><a href="../darbuotojai.php">Darbuotojai</a></li>
            <li><a href="../pelnas.php">Pelnas</a></li>
            <li><a href="../sandeliai.php">Sandeliai</a></li>
            <li><a href="../kontaktai.php">Kontaktai</a></li>
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
        <?php
            $querry = "SELECT p.id, p.vardas, p.pavarde, p.telefonas, p.epastas FROM uzsakovas as p WHERE p.id = $id  LIMIT 1;";
            $result = $con-> query($querry);

            $klientas_data = mysqli_fetch_assoc($result);
        ?>
        <div class = "inputContainer">
            <p class = "inputHeadline">Vardas</p> 
            <input class = 'formInput' type = 'text' name='vardas' value="<?php echo $klientas_data['vardas']?>">
        </div>
        <div class = "inputContainer">
            <p class = "inputHeadline">Pavardė</p> 
            <input class = 'formInput' type = 'text' name='pavarde' value="<?php echo $klientas_data['pavarde']?>">
        </div>
        <div class = "inputContainer">
            <p class = "inputHeadline">Tel. nr.</p> 
            <input class = 'formInput' type = 'tel' name='telefonas' value="<?php echo $klientas_data['telefonas']?>">
        </div>
        <div class = "inputContainer">
            <p class = "inputHeadline">El. paštas</p> 
            <input class = 'formInput' type = 'email' name='epastas' value="<?php echo $klientas_data['epastas']?>">
        </div>
            <a class = "buttonReturn" href="../Klientai.php">Grįžti į sąrašą</a>   
            <input class ='buttonSuccess' type="submit" name="submit" value="Išsaugoti">                       
        </form>
    </div>
</body>
</html>