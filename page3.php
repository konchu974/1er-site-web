<?php
require_once("manipulation.php");

session_start();

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
    <img id="logo-sfond" src="image/Music-Logo-sans-fond.png" alt="Music-Logo-sans-fond" width="100" height="66.6">
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
            <?php
           echo "<div class='playlist-container'>";

           while ($row = $stmt->fetch()) {
            if ($row['nom_playlist'] != $current_playlist) {
                if ($current_playlist !== null) {
                    echo "</div>"; // Fermer la précédente div de la playlist
                }
                echo "<div>"; // Ouvrir une nouvelle div pour la playlist
                echo "<h2>Playlist : " . $row['nom_playlist'] . "</h2>";
                echo "<img src='" . $row['playlist_photo'] . "' alt='Photo de la playlist' class='playlist-photo' onclick=\"toggleMusic('playlist_" . $row['Id_play'] . "')\">";
                $current_playlist = $row['nom_playlist']; // Mettre à jour la playlist actuelle
            }
        
            // Condition pour parcourir les musiques de la playlist
            if ($row['nom_playlist'] == $current_playlist) {
                echo "<div>";
                echo "<h3>Musique : " . $row['nom_musique'] . "</h3>";
                echo "<img src='" . $row['musique_photo'] . "' alt='Photo de la musique' class='musique-photo'>";
                echo "</div>";
            }
        }
        
        if ($current_playlist !== null) {
            echo "</div>"; // Fermer la dernière div de la playlist
        }
        
          ?>
        </body>

</html>










</html>