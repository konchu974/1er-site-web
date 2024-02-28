<?php
session_start();
require_once("manipulation.php");


$login = $_SESSION['user'];

?>


<html lang="fr">

<head>
    <title>Beat Connect</title>
    <link rel="stylesheet" href="pageco.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide">
    <meta charset="utf8">
    <script src="https://kit.fontawesome.com/dc5f9d95ad.js" crossorigin="anonymous"></script>
</head>

<header>
    <a href="page3.php"><img id="logo-sfond" src="image/Music-Logo-sans-fond.png" alt="Music-Logo-sans-fond" width="100" height="66.6"></a>
    <div class="dropdown">
        <i class="fa-regular fa-user fa-2xl " style="color: #000000;"></i>
        <div class="dropdown-content">
            <a href="profil.php">Profil</a>
            <a href="logout.php">Se deconnecter</a>
        </div>
    </div>

    <h1>Beat Connect</h1>
</header>

<body>


    <div class="card-container">
        <img class="round" src=<?php echo $admini['photo_adm'] ?> alt="user" />


        <h1><?= isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] ?
                ("Welcome " . $_SESSION['user']) :
                "Accueil" ?></h1>
        <p>User interface designer and <br /> front-end developer</p>

    </div>
</body>