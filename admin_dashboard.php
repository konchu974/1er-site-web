<?php
session_start();
require_once("manipulation.php");


$login = $_SESSION['user'];

if ($login == "") {
    $msg = "Il n'y a rien a voir ici" . "<br>";
    header("Location: error.php?msg=" . $msg);
    exit();
} else {
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
        <img id="logo-sfond" src="image/Music-Logo-sans-fond.png" alt="Music-Logo-sans-fond" width="100" height="66.6">
        <div class="dropdown">
            <i class="fa-regular fa-user fa-2xl " style="color: #000000;"></i>
            <div class="dropdown-content">

                <a href="logout.php">Se deconnecter</a>
            </div>
        </div>

        <h1>Beat Connect</h1>
    </header>

    <body>

        <ul>
            <li><a class="active" href="admin_dashboard.php">utilisateurs</a></li>
            <li><a href="#news">musique</a></li>
            <li><a href="#contact">parametre</a></li>
            <li><a href="#about">siteweb</a></li>
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
                                echo "</tr>";
                            }
                            echo "<tr>";
                            echo "<th><img src='" . $row['photo_adm'] . "' alt='Photo de profil' class='profil-photo'></th>";

                            $current_pro = $row['pseudo_adm']; // Mettre à jour profil
                            echo "<th>" . $row['pseudo_adm'] . "</th>";
                            echo "<th class='mdp'>" . $row['motdepasse'] . "</th>";
                            echo "<th >" . $row['nom_ambiance'] . "</th>";
                        }
                    }


                    if ($current_pro !== null) {
                        echo "</tr>";
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


            </div>

        </div>
    </body>

<?php
}
?>

<!-- ALTER TABLE t_user
MODIFY COLUMN photo_adm varchar(255) DEFAULT "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"; -->