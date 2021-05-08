<?php
session_start();
include("../login/connection.php");
include("../login/functions.php");

$user_data = check_login($con);

$id = $user_data['id'];
    

if(isset($_POST['general']))
{
    
    $prisijungimo_vardas = $_POST['prisijungimo_vardas'];
    $display_name = $_POST['display_name'];
    $epastas = $_POST['epastas'];
    $telefonas = $_POST['telefonas'];
    if(!empty($prisijungimo_vardas) && !empty($display_name) && !empty($epastas) && !empty($telefonas))
    {
        $query = "UPDATE naudotojas 
        SET prisijungimo_vardas ='$prisijungimo_vardas',
        display_name= '$display_name',
        epastas='$epastas',
        telefonas='$telefonas'
        WHERE id=$id";
        mysqli_query($con, $query);
        header("Location:general.php?msg=success");
        die;
    }
    else{
        header("Location:general.php?msg=invalidData");
    }
}
elseif(isset($_POST['security']))
{
    $old_password= $_POST['old_password'];
    $new_password=$_POST['new_password'];
    $new_password_repeat=$_POST['new_password_repeat'];
    if($old_password === $user_data['slaptazodis'] && $new_password === $new_password_repeat && !empty($new_password))
    {
        $query = "UPDATE naudotojas 
        SET slaptazodis ='$new_password'
        WHERE id=$id";
        mysqli_query($con, $query);
        header("Location:general.php?msg=success");
        die;
    }
    else{
        header("Location:general.php?msg=invalidData");
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
        <div class = "dropdown">
                <button class = "dropbtn">Sveiki, <?php echo $user_data['display_name']?></button>
                <div class = "dropdown-content">
                    <a href="../account/general.php">Nustatymai</a>
                    <a href="../login/logout.php">Atsijungti</a>
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
        </ul>

    </div>
    <div class="pagrindinis">
        <h2>Paskyros nustatymai</h2>
        <div class="tab">
            <button class="tablinks" onclick="openTab(event, 'General')" id="defaultOpen">General</button>
            <button class="tablinks" onclick="openTab(event, 'Security')">Security</button>
        </div>

        <?php
            if (isset($_GET["msg"]) && $_GET["msg"] == 'invalidData') {
                echo "<p class=wrong>Patikslinkite duomenis<p>";
            }
            if (isset($_GET["msg"]) && $_GET["msg"] == 'success') {
                echo "<p class=success>Informacija atnaujinta!<p>";
            }

        ?>
        <form name="general" method ="post">
        <div id="General" class="tabcontent">   
            <div class = "inputContainer">
                <p class = "inputHeadline">Prisijungimo vardas</p> 
                <input class = 'formInput' type = 'text' name='prisijungimo_vardas' value="<?php echo $user_data["prisijungimo_vardas"] ?>">
            </div>
            <div class = "inputContainer">
                <p class = "inputHeadline">Vardas sistemoje</p> 
                <input class = 'formInput' type = 'text' name='display_name' value="<?php echo $user_data["display_name"]?>">
            </div>
            <div class = "inputContainer">
                <p class = "inputHeadline">El. pašto adresas</p> 
                <input class = 'formInput' type = 'email' name='epastas' value="<?php echo $user_data["epastas"]?>">
            </div>
            <div class = "inputContainer">
                <p class = "inputHeadline">Tel. nr.</p> 
                <input class = 'formInput' type = 'tel' name='telefonas' value="<?php echo $user_data["telefonas"]?>">
            </div>
            <input class ='buttonSuccess' type="submit" name="general" value="Išsaugoti">  
        </div>
        </form>
        <form name="security" method="post">
        <div id="Security" class="tabcontent">   
            <div class = "inputContainer">
                <p class = "inputHeadline">Senas slaptažodis</p> 
                <input class = 'formInput' type = 'password' name='old_password' placeholder="Senas slaptažodis">
            </div>
            <div class = "inputContainer">
                <p class = "inputHeadline">Naujas slaptažodis</p> 
                <input class = 'formInput' type = 'password' name='new_password' placeholder="Naujas slaptažodis">
            </div>
            <div class = "inputContainer">
                <p class = "inputHeadline">Pakartokite slaptažodį</p> 
                <input class = 'formInput' type = 'password' name='new_password_repeat' placeholder="Pakartokite slaptažodį">
            </div>
            <input class ='buttonSuccess' type="submit" name="security" value="Išsaugoti">  
        </div>
        </form>
    </div>
</body>
</html>

<script>
    document.getElementById("defaultOpen").click();
    function openTab(evt, Name) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(Name).style.display = "block";
  evt.currentTarget.className += " active";
}

</script>


