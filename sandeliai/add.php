<?php
session_start();
    include("../login/connection.php");
    include("../login/functions.php");

    $user_data = check_login($con);
    
    $id = generateRandomString(8);
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $pavadinimas = $_POST['pavadinimas'];
        $adresas = $_POST['adresas'];
        $sandelys_busena = $_POST['sandelys_busena'];

        if(!empty($pavadinimas) && !empty($adresas) && !empty($sandelys_busena))
        {
            $query = "INSERT INTO sandelys (id,pavadinimas,kiekis,adresas,busena) VALUES($id,'$pavadinimas',0, '$adresas', '$sandelys_busena')";
            mysqli_query($con, $query);
            header("Location:../sandeliai.php");
            die;
        }
        else{
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
  <title>LogBuddy - Prekės</title>
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
            <li><a href="../Klientai.php">Klientai</a></li>
            <li><a href="../uzsakymai.php">Užsakymai</a></li>
            <li><a href="../prekes.php">Prekės</a></li>
            <li><a href="../darbuotojai.php">Darbuotojai</a></li>
            <li><a href="../pelnas.php">Pelnas</a></li>
            <li class="CurrentPage"><a href="../sandeliai.php">Sandeliai</a></li>
            <li><a href="../kontaktai.php">Kontaktai</a></li>
        </ul>

    </div>
    <div class="pagrindinis">
    <h2>Pridėti sandelį</h2>
    <?php
        if (isset($_GET["msg"]) && $_GET["msg"] == 'invalidData') {
            echo "<p class=wrong>Įvesti ne visi duomenys!<p>";
        }
    ?>
    <form method = "post">
        <div class = "inputContainer">
            <p class = "inputHeadline">Pavadinimas</p> 
            <input class = 'formInput' type = 'text' name='pavadinimas' placeholder="Pavadinimas">
        </div>
        <div class = "inputContainer">
            <p class = "inputHeadline">Adresas</p> 
            <input class = 'formInput' type = 'text' name='adresas' placeholder="Adresas">
        </div>
        <div class = "inputContainer">
            <p class = "inputHeadline">Būsena</p> 
            <?php
                        $sandeliai = "SELECT * FROM busena_sandelys";
                        $result = $con-> query($sandeliai);
                        echo "<select name='sandelys_busena' id='sandelys_busena'>";
                        if($result-> num_rows > 0){
                            while($row = $result -> fetch_assoc())
                            {
                                echo "<option value='".$row["id_Busena_sandelys"]."'";
                                if($row["id_Busena_sandelys"] === $sandelys_data["bid"]){
                                    echo "selected='selected'";
                                }
                                echo ">".$row["name"]."</option>";
                            }
                        }
                        else{
                            echo "Sandelių nėra";
                        }
                        ?>
            </select>
        </div>
        <br>  
            <a class = "buttonReturn" href="../sandeliai.php">Grįžti į sąrašą</a>  
            <input class ='buttonSuccess' type="submit" name="submit" value="Išsaugoti">                       
        </form>
    </div>
</body>
</html>
