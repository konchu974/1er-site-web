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
    require_once("manipulation.php");
    echo "<div class='playlist-container'>";

    while ($row = $stmt->fetch()) {
        if ($row['nom_playlist'] != $current_playlist) {
            if ($current_playlist !== null) {
                echo "</div>"; // Fermer la div pour la playlist précédente
            }
            echo "<div class='playlist'>"; // Nouvelle div pour la playlist
            echo "<h2>Playlist : " . $current_playlist . "</h2>";
            echo "<button onclick=\"toggleMusic('playlist_" . $row['Id_play'] . "')\">Voir les musiques</button>";
            echo "<img src='" . $row['playlist_photo'] . "' alt='Photo de la playlist' class='playlist-photo'>";
            // Ajouter un identifiant unique à la liste de musiques de la playlist
            echo "<ul id='playlist_" . $row['Id_play'] . "' style='display:none;'>";
            $current_playlist = $row['nom_playlist']; // Mettre à jour la playlist actuelle
        }

        echo "<li>";
        echo "Musique: " . $row['nom_musique'] . " - Durée: " . $row['duree_SC'];
        echo "<br>";
        echo "Photo: <img src='" . $row['musique_photo'] . "' alt='Photo de la musique' class='musique-photo'><br>";
        echo "</li>";
    }

    if ($current_playlist !== null) {
        echo "</ul>";
        echo "</div>"; // Fermer la dernière div pour la dernière playlist
    }
    ?>
     <script src="script.js"></script>
</body>

</html>