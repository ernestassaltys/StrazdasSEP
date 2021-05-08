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
  <title>LogBuddy - Klientai</title>
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
            <li class="CurrentPage"><a href="../prekes.php">Prekės</a></li>
            <li><a href="darbuotojai.php">Darbuotojai</a></li>
            <li><a href="pelnas.php">Pelnas</a></li>
        </ul>

    </div>
    <div class="pagrindinis">
    <h2>Prekės</h2>
    <div class="tableTop">
        <a class="addButton" href="prekes/add.php">Pridėti prekę</a>
        <?php
            if (isset($_GET["msg"]) && $_GET["msg"] == 'fkfail') {
                echo "<p class=wrong>Ši prekė yra priskirta kitoms lentelėms<p>";
            }
        ?>
    </div>
    <table>
                    <tr>
                        <th>Pavadinimas</th>
                        <th>Kiekis</th>
                        <th>Kaina</th>
                        <th>Sandelys</th>
                        <th>Funkcijos</th>
                    </tr>
                    <?php
                        $querry = "SELECT p.id, p.pavadinimas, p.kaina, p.kiekis, s.pavadinimas as pav FROM preke as p JOIN sandelys as s ON s.id=p.fk_Sandelysid;";
                        $result = $con-> query($querry);

                        if($result-> num_rows > 0){
                            while($row = $result -> fetch_assoc())
                            {
                                echo "<tr><td>".$row["pavadinimas"]."</td><td>".$row["kiekis"]."</td><td>".$row["kaina"]."</td><td>".
                                $row["pav"]."</td><td>";
                                echo "<a class='actionbutton button-edit' href = 'prekes/edit.php?rn=$row[id]'>Redaguoti</a> <a class='actionbutton button-remove' href = 'prekes/delete.php?rn=$row[id]' onclick='return confirm(`Are you sure?`);'>Pašalinti</a> </td> </tr>";
                            }
                            echo "</table>";
                        }
                        else{
                            echo "Prekių nėra";
                        }
                    
                    ?>
                </table>
    </div>
</body>
</html>

