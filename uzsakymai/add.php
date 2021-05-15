<?php
session_start();
    include("../login/connection.php");
    include("../login/functions.php");

    $user_data = check_login($con);
    
    $id = generateRandomString(8);
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $uzs_data = $_POST['uzsakymo_data'];
        $pri_data = $_POST['pristatymo_data'];
        $adresas = $_POST['adresas'];
        $busena = $_POST['busena'];
        $naudotojas = $user_data['id'];
        $uzsakovas= $_POST['uzsakovai'];

        if(!empty($uzs_data) && !empty($pri_data) && !empty($adresas) && !empty($busena) && !empty($naudotojas) && !empty($uzsakovas)
        && $uzs_data < $pri_data)
        {
            $query = "INSERT INTO uzsakymas (id,uzsakymo_data,pristatymo_data,adresas,busena, fk_Naudotojasid, fk_Uzsakovasid) 
            VALUES($id,'$uzs_data','$pri_data', '$adresas', '$busena', '$naudotojas', '$uzsakovas')";
            mysqli_query($con, $query);
            header("Location:../uzsakymai.php");
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
            <li class="CurrentPage"><a href="../uzsakymai.php">Užsakymai</a></li>
            <li><a href="../prekes.php">Prekės</a></li>
            <li><a href="../darbuotojai.php">Darbuotojai</a></li>
            <li><a href="../pelnas.php">Pelnas</a></li>
            <li><a href="../sandeliai.php">Sandeliai</a></li>
            <li><a href="../kontaktai.php">Kontaktai</a></li>
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
            <p class = "inputHeadline">Užsakymo data</p> 
            <input class = 'formInput' type = 'date' name='uzsakymo_data' value=<?php echo date('Y-m-d') ?>>
        </div>
        <div class = "inputContainer">
            <p class = "inputHeadline">Pristatymo data</p> 
            <input class = 'formInput' type = 'date' name='pristatymo_data' placeholder="Pristatymo data">
        </div>
        <div class = "inputContainer">
            <p class = "inputHeadline">Adresas</p> 
            <input class = 'formInput' type = 'text' name='adresas' placeholder="Adresas">
        </div>
        <div class = "inputContainer">
            <p class = "inputHeadline">Busena</p> 
            <?php
                        $sandeliai = "SELECT * FROM busena_uzsakymas";
                        $result = $con-> query($sandeliai);
                        echo "<select name='busena' id='busena'>";
                        if($result-> num_rows > 0){
                            while($row = $result -> fetch_assoc())
                            {
                                echo "<option value='".$row["id_Busena_uzsakymas"]."'>".$row["name"]."</option>";
                            }
                        }
                        else{
                            echo "Būsenų nėra";
                        }
                        ?>
            </select>
        </div>
        <div class = "inputContainer">
            <p class = "inputHeadline">Užsakymą sudarė</p>
            <input class = 'formInput' type = 'text' name='kaina' value='<?php echo $user_data['prisijungimo_vardas']?>' disabled> 
        </div>
        
        <div class = "inputContainer">
            <p class = "inputHeadline">Užsakovas</p> 
            <?php
                        $sandeliai = "SELECT * FROM uzsakovas";
                        $result = $con-> query($sandeliai);
                        echo "<select name='uzsakovai' id='uzsakovai'>";
                        if($result-> num_rows > 0){
                            while($row = $result -> fetch_assoc())
                            {
                                echo "<option value='".$row["id"]."'>".$row["vardas"]." ".$row["pavarde"]."</option>";
                            }
                        }
                        else{
                            echo "Sandelių nėra";
                        }
                        ?>
            </select>
        </div>
        <br>  
            <a class = "buttonReturn" href="../uzsakymai.php">Grįžti į sąrašą</a>  
            <input class ='buttonSuccess' type="submit" name="submit" value="Išsaugoti">                       
        </form>
    </div>
</body>
</html>
