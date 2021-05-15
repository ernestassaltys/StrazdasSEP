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
  <title>LogBuddy - Kontaktai</title>

<style>
* {
  box-sizing: border-box;
}
.column {
  float: left;
  width: 33.33%;
  padding: 10px;
}
.row:after {
  content: "";
  display: table;
  clear: both;
}
h3{
  text-align: center;
}
p{
  text-align: center;
}
.avatar{
    width: 250px;
    height: 250px;
    display: block;
    margin-left: auto;
    margin-right: auto;
    border-radius: 50%;
}
</style>
</head>
<body>
<div class="menuHeader">
        <a href="index.php"><img src="LOGO.png"></a>
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
            <li><a href="Klientai.php">Klientai</a></li>
            <li><a href="uzsakymai.php">Užsakymai</a></li>
            <li><a href="prekes.php">Prekės</a></li>
            <li><a href="darbuotojai.php">Darbuotojai</a></li>
            <li><a href="pelnas.php">Pelnas</a></li>
            <li><a href="sandeliai.php">Sandeliai</a></li>
            <li class="CurrentPage"><a href="kontaktai.php">Kontaktai</a></li>
        </ul>

    </div>
    <div class="row" style="margin-left: 288px">
    <h2>Kontaktai</h2>

  <div class="column" style="background-color: #e6e6e6;">
    <h3>Domantas Orvidas</h3>
    <img src="Images/defAvatar.jpg" alt="defaultAvatar" class="avatar">
    <p>Front-end, Dizainas</p>
    <p>domorv@ktu.lt</p>
    <p>-------</p>
  </div>
  <div class="column" style="background-color:#bbb; ">
    <h3>Ernestas Šaltys</h3>
    <img src="Images/defAvatar.jpg" alt="defaultAvatar" class="avatar">
    <p>Front-end, Back-end</p>
    <p>ernsal@ktu.lt</p>
    <p>-------</p>
  </div>
  <div class="column" style="background-color: #e6e6e6;">
    <h3>Lukas Marcinkevičius</h3>
    <img src="Images/defAvatar.jpg" alt="defaultAvatar" class="avatar">
    <p>Testuotojas, Back-end</p>
    <p>lukmar@ktu.lt</p>
    <p>-------</p>
  </div>
</div>
</body>
</html>