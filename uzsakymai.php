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
            <li class="CurrentPage"><a href="uzsakymai.php">Užsakymai</a></li>
            <li><a href="../prekes.php">Prekės</a></li>
            <li><a href="../darbuotojai.php">Darbuotojai</a></li>
            <li><a href="../pelnas.php">Pelnas</a></li>
        </ul>

    </div>
    <div class="pagrindinis">
    <h2>Užsakymai</h2>
    <div class="tableTop">
        <a class="addButton" href="uzsakymai/add.php">Pridėti užsakymą</a>
        <?php
            if (isset($_GET["msg"]) && $_GET["msg"] == 'fkfail') {
                echo "<p class=wrong>Ši prekė yra priskirta kitoms lentelėms<p>";
            }
        ?>
    </div>
    <table>
      <tr>
        <th>ID</th>
        <th>Užsakovas</th>
        <th>Užsakymo data</th>
        <th>Pristatymo data</th>
        <th>Adresas</th>
        <th>Funkcijos</th>

      </tr>
      <?php
            $querry = "SELECT u.id, u.uzsakymo_data, u.pristatymo_data, u.adresas,
            u.busena, c.vardas as uzsVardas, c.pavarde as uzsPav FROM uzsakymas as u JOIN uzsakovas as c ON c.id = u.fk_Uzsakovasid";
            $result = $con-> query($querry);

            if($result-> num_rows > 0){
                while($row = $result -> fetch_assoc())
                {
                    echo "<tr><td>".$row["id"]."</td><td>".$row["uzsVardas"]." ".$row["uzsPav"]."</td><td>".$row["uzsakymo_data"]."</td><td>".$row["pristatymo_data"]."</td><td>".
                    $row["adresas"]."</td><td>";
                    echo "<a class='actionbutton button-edit' href = 'uzsakymai/edit.php?rn=$row[id]'>Redaguoti</a> <a class='actionbutton button-remove' href = 'uzsakymai/delete.php?rn=$row[id]' onclick='return confirm(`Are you sure?`);'>Pašalinti</a> </td> </tr>";
                }
                echo "</table>";
            }
            else{
                echo "Užsakymų nėra";
            }
                    
        ?>
    </table>
    </div>
</body>
</html>