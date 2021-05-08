<?php
session_start();
    include("../login/connection.php");
    include("../login/functions.php");

    $user_data = check_login($con);
    
    $id = $_GET['rn'];
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $vardas = $_POST['vardas'];
        $pavarde = $_POST['pavarde'];
        $asmens_kodas = $_POST['asmens_kodas'];
        $tel_numeris= $_POST['tel_numeris'];
        $epastas = $_POST['epastas'];
        $role = $_POST['roles'];
        $sandelys = $_POST['sandeliai'];

        if(!empty($vardas) && !empty($pavarde) && !empty($asmens_kodas) && !empty($tel_numeris) && !empty($epastas) && !empty($role) &&!empty($sandelys)) 
        {
            $query = "UPDATE darbuotojai SET vardas ='$vardas', pavarde= '$pavarde', asmens_kodas='$asmens_kodas', tel_numeris='$tel_numeris',
            epastas='$epastas', role='$role', fk_Sandelysid='$sandelys' WHERE id='$id'";
            mysqli_query($con, $query);
            header("Location:../darbuotojai.php");
            die;
        }
        else{
            header("Location:edit.php?msg=invalidData");
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
  <title>LogBuddy - Darbuotojai</title>
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
            <li><a href="Klientai.php">Klientai</a></li>
            <li><a href="uzsakymai.php">Užsakymai</a></li>
            <li><a href="prekes.php">Prekės</a></li>
            <li class="CurrentPage"><a href="darbuotojai.php">Darbuotojai</a></li>
            <li><a href="pelnas.php">Pelnas</a></li>
        </ul>

    </div>
    <div class="pagrindinis">
    <h2>Pridėti darbuotoją</h2>
    <?php
        if (isset($_GET["msg"]) && $_GET["msg"] == 'invalidData') {
            echo "<p class=wrong>Įvesti ne visi duomenys!<p>";
        }
    ?>
    <form method = "post">
    <?php
            $querry = "SELECT d.id, d.vardas, d.pavarde, d.tel_numeris, d.epastas, d.asmens_kodas, s.id as sid, r.id_Role as rid 
            FROM darbuotojai as d JOIN sandelys as s ON s.id=d.fk_Sandelysid JOIN role as r ON r.id_Role=d.role WHERE d.id = $id LIMIT 1";
             $result = $con-> query($querry);

            $darbuotojas_data = mysqli_fetch_assoc($result);
        ?>
        <div class = "inputContainer">
            <p class = "inputHeadline">Vardas</p> 
            <input class = 'formInput' type = 'text' name='vardas' value="<?php echo $darbuotojas_data['vardas'];?>">
        </div>
        <div class = "inputContainer">
            <p class = "inputHeadline">Pavardė</p> 
            <input class = 'formInput' type = 'text' name='pavarde' value="<?php echo $darbuotojas_data['pavarde'];?>">
        </div>
        <div class = "inputContainer">
            <p class = "inputHeadline">Pareigos</p> 
            <?php
                        $roles = "SELECT * FROM role";
                        $result = $con-> query($roles);
                        echo "<select name='roles' id='roles'>";
                        if($result-> num_rows > 0){
                            while($row = $result -> fetch_assoc())
                            {
                                echo "<option value='".$row["id_Role"]."'";
                                if($row["id_Role"] === $darbuotojas_data["rid"]){
                                    echo "selected='selected'";
                                }
                                echo ">".$row["name"]."</option>";
                            }
                        }
                        else{
                            echo "Rolių nėra";
                        }
                        ?>
            </select>
        </div>
        <div class = "inputContainer">
            <p class = "inputHeadline">Asmens kodas</p> 
            <input class = 'formInput' type = 'text' name='asmens_kodas' value="<?php echo $darbuotojas_data['asmens_kodas'];?>">
        </div>
        <div class = "inputContainer">
            <p class = "inputHeadline">Tel. nr.</p> 
            <input class = 'formInput' type = 'tel' name='tel_numeris' value="<?php echo $darbuotojas_data['tel_numeris'];?>">
        </div>
        <div class = "inputContainer">
            <p class = "inputHeadline">El. paštas</p> 
            <input class = 'formInput' type = 'email' name='epastas' value="<?php echo $darbuotojas_data['epastas'];?>">
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
                                echo "<option value='".$row["id"]."'";
                                if($row["id"] === $darbuotojas_data["sid"]){
                                    echo "selected='selected'";
                                }
                                echo ">".$row["pavadinimas"]."</option>";
                            }
                        }
                        else{
                            echo "Sandelių nėra";
                        }
                        ?>
            </select>
        </div>
        <br>  
            <a class = "buttonReturn" href="../darbuotojai.php">Grįžti į sąrašą</a>  
            <input class ='buttonSuccess' type="submit" name="submit" value="Išsaugoti">                       
        </form>
    </div>
</body>
</html>
