<?php
session_start();
require_once("manipulation.php");


$login = $_SESSION['user'];

?>


<html lang="fr">

<head>
    <title>Beat Connect</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Ultra&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet" />
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

    <ul>
        <li><a class="active" href="admin_dashboard.php">utilisateurs</a></li>
        <li><a href="#news">News</a></li>
        <li><a href="#contact">Contact</a></li>
        <li><a href="#about">About</a></li>
    </ul>

    <div style="margin-left:25%;padding:1px 16px;height:1000px;" class="contenu">
        <div class="div1">

            <table>
                <tr>
                    <th>Photo de profil</th>
                    <th>pseudo</th>
                    <th>motdepasse</th>
                    <th>preference</th>

                </tr>
                <?php

                while ($row = $stmtpro->fetch()) {
                    if ($row['pseudo_adm'] != $current_pro) {
                        if ($current_pro !== null) {
                            echo "</tr>"; // Fermer la div pour la playlist précédente
                        }
                        echo "<tr>"; // Nouvelle div pour la playlist
                        echo "<th><img src='" . $row['photo_adm'] . "' alt='Photo de profil' class='profil-photo'></th>";
                        // Ajouter un identifiant unique à la liste de musiques de la playlist
                        $current_pro = $row['pseudo_adm']; // Mettre à jour la playlist actuelle
                        echo "<th>" . $row['pseudo_adm'] . "</th>";
                        echo "<th class='mdp'>" . $row['motdepasse'] . "</th>";
                        echo "<th >" . $row['nom_ambiance'] . "</th>";
                    }
                    
                }


                if ($current_pro !== null) {
                    echo "</tr>"; // Fermer la dernière div pour la dernière playlist
                }
                ?>
            </table>
        </div>

        <div class="div2"></div>

        <div class="div3"></div>

        <div class="div4">


        </div>

        <div class="div5"></div>

        <div class="div6">
            <div class="progress-bar" style="--value: 85; --col: #FF5089">
                <progress id="utilisateur" min="0" max="100" value="85"></progress>
            </div>

            <label for="utilisateur" class="progress-bar-title">
                <h2>nombre utilisateur</h2>

                <?php

                ?>
            </label>
        </div>

    </div>
</body>



<!-- ALTER TABLE t_administrateur_ad
MODIFY COLUMN photo_adm varchar(255) DEFAULT "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"; -->