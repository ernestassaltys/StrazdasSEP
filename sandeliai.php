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
  <title>LogBuddy - Sandeliai</title>
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
            <li class="CurrentPage"><a href="sandeliai.php">Sandeliai</a></li>
            <li><a href="kontaktai.php">Kontaktai</a></li>
        </ul>

    </div>
    <div class="pagrindinis">
    <h2>Sandeliai</h2>
    <div class="tableTop">
        <a class="addButton" href="sandeliai/add.php">Pridėti sandelį</a>
        <?php
            if (isset($_GET["msg"]) && $_GET["msg"] == 'fkfail') {
                echo "<p class=wrong>Sandelyje yra prekių<p>";
            }
            if (isset($_GET["msg"]) && $_GET["msg"] == 'fkfaildarb') {
                echo "<p class=wrong>Sandelyje yra darbuotojų<p>";
            }
        ?>
    </div>
    <table>
                    <tr>
                        <th>Pavadinimas</th>
                        <th>Adresas</th>
                        <th>Būsena</th>
                        <th>Funkcijos</th>
                    </tr>
                    <?php
                        $querry = "SELECT s.id, s.pavadinimas, s.adresas, b.name as san_busena FROM sandelys as s JOIN busena_sandelys as b ON b.id_Busena_sandelys=s.busena;";
                        $result = $con-> query($querry);

                        if($result-> num_rows > 0){
                            while($row = $result -> fetch_assoc())
                            {
                                echo "<tr><td>".$row["pavadinimas"]."</td><td>".$row["adresas"]."</td><td>".$row["san_busena"]."</td><td>";
                                echo "<a class='actionbutton button-edit' href = 'sandeliai/edit.php?rn=$row[id]'>Redaguoti</a> <a class='actionbutton button-remove' href = 'sandeliai/delete.php?rn=$row[id]' onclick='return confirm(`Are you sure?`);'>Pašalinti</a> </td> </tr>";
                            }
                            echo "</table>";
                        }
                        else{
                            echo "Sandelių nėra";
                        }
                    
                    ?>
                </table>
    </div>
</body>
</html>

