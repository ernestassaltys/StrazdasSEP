<?php
session_start();
    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>IFZ-9/2 Webpage</title>
        <link rel="stylesheet" href = "../style.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;500&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class = "topBanner">
            <a class = "logo" href = index.html>
                Logo
            </a>
            <div class = "login">
                <form action = "/login/login.php">
                    <label for="username">Sveiki, <?php echo $user_data['user_name']?></label>
                    <a href="logout.php"> Atsijungti </a>
                </form>
                
            </div>
        </div>
        <div class = "main">
            <div class = "infoHeader">
                <div class = "infoTxt">
                    <h2>LogBuddy </h2>
                    <p>
                        tai išmanus pagalbininkas, kiekvienai įmonei, norinčiai atlikti savo sandėlio patikras didesniu našumu. 
                        Mūsų sistema, padeda efektyviai susidoroti su painiais prekių sekimais ir problematiškais jų skaičiavimais, 
                        bei kitomis smulkmenomis, kurias atliekant ranką prarandame daug brangaus laiko. Taip pat, sistemą galite 
                        įdiegti į savo infrastruktūra, taip užtikrindami sklandų jos veikimą. Visi duomenys yra užšifruoti ir 
                        mes užtikriname jų saugumą.
                    </p>
                </div>
            </div>
            <a href = "prekes.html">
            <div class = "buttons" >  
                <div class = "button1" id="category-buttons">
                    <div class = "txtContainer">
                        <h2 class = "btntxt">
                            Prekių paieška
                        </h2>
                        <p class = "btntxt">
                            Egzistuojančių sandėlyje ir būsimų prekių paieška, suteikiama informacija apie jas, išmatavimai, kuriame sandėlyje.
                        </p>
                    </div>
                    <img src = ..\Images\warehouse.jpg>
                </div>
            </a>
                <a href = "formavimas.html">
                    <div class = "button2" id="category-buttons">
                        <div class = "txtContainer">
                            <h2 class = "btntxt">
                                Užsakymo formavimas
                            </h2>
                            <p class = "btntxt">
                                Pateikiama užsakymo forma, sandėlio papildymui ar prekių perkėlimui į kitą sandėlį.
                            </p>
                        </div>
                        <img src = ..\Images\formavimas.jpg>
                    </div>
                </a>
            <a href = "kontaktai.html">
                <div class = "button3" id="category-buttons">
                    <div class = "txtContainer">
                        <h2 class = "btntxt">
                            Tiekėjai, kontaktai
                        </h2>
                        <p class = "btntxt">
                            Informacija apie tai, iš kur gaunamos prekes ar žaliavos jų gamybai, bei suteikiami įmonės kontaktai.
                        </p>
                    </div>
                    <img src = ..\Images\contacts.jpg>
                </div>
            </a>
            </div>
        </div>
    </body>
</html>

