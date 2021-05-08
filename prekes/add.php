<?php
session_start();
    include("../login/connection.php");
    include("../login/functions.php");

    $user_data = check_login($con);
    
    $id = generateRandomString(8);
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $pavadinimas = $_POST['pavadinimas'];
        $kaina = $_POST['kaina'];
        $kiekis = $_POST['kiekis'];
        $sandelys = $_POST['sandeliai'];

        if(!empty($pavadinimas) && !empty($kaina) && !empty($kiekis) && !empty($sandelys))
        {
            $query = "INSERT INTO preke (id,pavadinimas,kaina,kiekis,fk_Sandelysid) VALUES($id,'$pavadinimas',$kaina, $kiekis, '$sandelys')";
            mysqli_query($con, $query);
            header("Location:../prekes.php");
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
        <div class = "userData">
                <label for="username">Sveiki, <?php echo $user_data['prisijungimo_vardas']?></label>
                <a href="../login/logout.php"> Atsijungti </a>
            </div>
        </div>
    <div class="menuSidebar">
    <ul>
            <li><a href="../Klientai.php">Klientai</a></li>
            <li><a href="../uzsakymai.php">Užsakymai</a></li>
            <li class="CurrentPage"><a href="../prekes.php">Prekės</a></li>
            <li><a href="../darbuotojai.php">Darbuotojai</a></li>
            <li><a href="../pelnas.php">Pelnas</a></li>
        </ul>

    </div>
    <div class="pagrindinis">
    <h2>Pridėti prekę</h2>
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
            <p class = "inputHeadline">Kiekis</p> 
            <input class = 'formInput' type = 'number' name='kiekis' placeholder="Kiekis">
        </div>
        <div class = "inputContainer">
            <p class = "inputHeadline">Kaina</p> 
            <input class = 'formInput' type = 'number' name='kaina' placeholder="Kaina">
        </div>
        <div class = "inputContainer">
            <p class = "inputHeadline">Sandelys</p> 
            <?php
                        $sandeliai = "SELECT * FROM sandelys";
                        $result = $con-> query($sandeliai);
                        echo "<select name='sandeliai' id='sandeliai'>";
                        if($result-> num_rows > 0){
                            while($row = $result -> fetch_assoc())
                            {
                                echo "<option value='".$row["id"]."'>".$row["pavadinimas"]."</option>";
                            }
                        }
                        else{
                            echo "Sandelių nėra";
                        }
                        ?>
            </select>
        </div>
        <br>  
            <a class = "buttonReturn" href="../prekes.php">Grįžti į sąrašą</a>  
            <input class ='buttonSuccess' type="submit" name="submit" value="Išsaugoti">                       
        </form>
    </div>
</body>
</html>
