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
  <title>LogBuddy - Darbuotojai</title>
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
            <li class="CurrentPage"><a href="darbuotojai.php">Darbuotojai</a></li>
            <li><a href="pelnas.php">Pelnas</a></li>
            <li><a href="sandeliai.php">Sandeliai</a></li>
            <li><a href="kontaktai.php">Kontaktai</a></li>
        </ul>

    </div>
    <div class="pagrindinis">
    <h2>Darbuotojai</h2>
    <div class="tableTop">
        <a class="addButton" href="darbuotojai/add.php">Pridėti darbuotoją</a>
        <?php
            if (isset($_GET["msg"]) && $_GET["msg"] == 'fkfail') {
                echo "<p class=wrong>Šis darbutojas yra priskirtas sandeliui<p>";
            }
        ?>
    </div>
    <table>
                    <tr>
                        <th>Vardas</th>
                        <th>Pavardė</th>
                        <th>Pareigos</th>
                        <th>Tel. nr.</th>
                        <th>Sandelys</th>
                    </tr>
                    <?php
                        $querry = "SELECT d.id, d.vardas, d.pavarde, d.tel_numeris, s.pavadinimas as pav, r.name as pareigos FROM darbuotojai as d JOIN sandelys as s ON s.id=d.fk_Sandelysid JOIN role as r ON r.id_Role=d.role";
                        $result = $con-> query($querry);

                        if($result-> num_rows > 0){
                            while($row = $result -> fetch_assoc())
                            {
                                echo "<tr><td>".$row["vardas"]."</td><td>".$row["pavarde"]."</td><td>".$row["pareigos"]."</td><td>".
                                $row["tel_numeris"]."</td><td>".$row["pav"]."</td><td>";
                                echo "<a class='actionbutton button-edit' href = 'darbuotojai/edit.php?rn=$row[id]'>Redaguoti</a> <a class='actionbutton button-remove' href = 'darbuotojai/delete.php?rn=$row[id]' onclick='return confirm(`Are you sure?`);'>Pašalinti</a> </td> </tr>";
                            }
                            echo "</table>";
                        }
                        else{
                            echo "Darbuotojų nėra";
                        }
                    
                    ?>
                </table>
    </div>
</body>
</html>

