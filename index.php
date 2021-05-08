<?php
session_start();
    include("login/connection.php");
    include("login/functions.php");

    $user_data = check_login($con);
    
?>

<!DOCTYPE html>
<html lang="lt">
<head>
  <link href="Logstyle.css" rel="stylesheet" />
  <meta name="autoriai" content="Domantas Orvidas;Ernestas Šaltys;Lukas Marcinkevičius">
  <meta name="apibūdinimas" content="Logistikos pagalbininkas">
  <meta name="keywords" content="logistika">
  <title>LogBuddy - Užsakymai</title>
</head>
<body>
<div class="menuHeader">
        <a href="index.php"><img src="LOGO.png"></a>
        <div class="search">
            <input class = "search-field" type="search" placeholder="Paieška">
            <button class ="search-button" type="submit"><i class="search-button-text">Ieškoti</i></button>
        </div>
        <div class = "userData">
                <label for="username">Sveiki, <?php echo $user_data['prisijungimo_vardas']?></label>
                <a href="login/logout.php"> Atsijungti </a>
            </div>
        </div>
    <div class="menuSidebar">
        <ul>
            <li><a href="Klientai.php">Klientai</a></li>
            <li><a href="uzsakymai.php">Užsakymai</a></li>
            <li><a href="../prekes.php">Prekės</a></li>
            <li><a href="../darbuotojai.php">Darbuotojai</a></li>
            <li><a href="../pelnas.php">Pelnas</a></li>
        </ul>

    </div>
    <div style="text-align:center" class="pagrindinis">
    <h2>LogBuddy</h2>
    <p style = "padding:0 20%;text-align:center">Tai išmanus pagalbininkas, kiekvienai įmonei, norinčiai atlikti savo sandėlio patikras didesniu našumu. Mūsų sistema, padeda efektyviai susidoroti su painiais prekių sekimais ir problematiškais jų skaičiavimais, bei kitomis smulkmenomis, kurias atliekant ranką prarandame daug brangaus laiko. Taip pat, sistemą galite įdiegti į savo infrastruktūra, taip užtikrindami sklandų jos veikimą. Visi duomenys yra užšifruoti ir mes užtikriname jų saugumą. </p>
    <h4>Nuo ko šiandien pradėsite savo darbą <?php echo $user_data['prisijungimo_vardas']?>?</h4>
    </div>
</body>
</html>