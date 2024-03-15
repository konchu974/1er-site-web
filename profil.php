<?php
session_start();
require_once("manipulation.php");


$login = $_SESSION['user'];

?>


<html lang="fr">

<head>
    <title>Beat Connect</title>
    <link rel="stylesheet" href="pageco.css">
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Audiowide"
    />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Ultra&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap"
      rel="stylesheet"
    />    <meta charset="utf8">
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
        <img class="round" src=<?php echo $_SESSION['user_img'] ?> alt="user" />


        <h1><?= isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] ?
                ($_SESSION['user']) :
                "Vous n'étes pas connecté" ?></h1>
        <!-- <p>loooooleoeleoeleoe<br /> rfsdlfslfkjsdlkfjdl</p> -->

    </div>
</body>



<!-- ALTER TABLE t_administrateur_ad
MODIFY COLUMN photo_adm varchar(255) DEFAULT "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"; -->