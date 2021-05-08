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
            <li class="CurrentPage"><a>Klientai</a></li>
            <li><a href="../uzsakymai.php">Užsakymai</a></li>
            <li><a href="../prekes.php">Prekės</a></li>
            <li><a href="../darbuotojai.php">Darbuotojai</a></li>
            <li><a href="../pelnas.php">Pelnas</a></li>
        </ul>

    </div>
    <div class="pagrindinis">
    <h2>Klientai</h2>
    <div class="tableTop">
        <a class="addButton" href="klientai/add.php">Pridėti klientą</a>
        <?php
            if (isset($_GET["msg"]) && $_GET["msg"] == 'fkfail') {
                echo "<p class=wrong>Ši prekė yra priskirta kitoms lentelėms<p>";
            }
        ?>
    </div>
    <table>
      <tr>
        <th>Vardas</th>
        <th>Pavardė</th>
        <th>Telefonas</th>
        <th>E-Paštas</th>
        <th>Funkcijos</th>
      </tr>
      <?php
                        $querry = "SELECT u.id, u.vardas, u.pavarde, u.telefonas, u.epastas FROM uzsakovas as u";
                        $result = $con-> query($querry);

                        if($result-> num_rows > 0){
                            while($row = $result -> fetch_assoc())
                            {
                                echo "<tr><td>".$row["vardas"]."</td><td>".$row["pavarde"]."</td><td>".$row["telefonas"]."</td><td>".
                                $row["epastas"]."</td><td>";
                                echo "<a class='actionbutton button-edit'href = 'klientai/edit.php?rn=$row[id]'>Redaguoti</a> <a class='actionbutton button-remove' href = 'klientai/delete.php?rn=$row[id]' onclick='return confirm(`Are you sure?`);'>Pašalinti</a> </td> </tr>";
                            }
                            echo "</table>";
                        }
                        else{
                            echo "Klientų nėra";
                        }
                    
                    ?>
    </table>
    </div>
</body>
</html>