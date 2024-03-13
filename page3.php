<?php
session_start();
require_once("manipulation.php");
?>


<html lang="fr">

<head>
    <title>Beat Connect</title>
    <link rel="stylesheet" href="pageco.css">
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
            <a href="profil.php">Profil</a>
            <a href="logout.php">Se deconnecter</a>
        </div>
    </div>

    <h1>Beat Connect</h1>
</header>

<body>
    <div class="titlepl">
        <h1>choisissez votre playlist</h1>
        <p>une playlist, une ambiance. Vous decidez!</p>
    </div>
    <?php

    echo "<div class='playlist-container'>";

    while ($row = $stmt->fetch()) {
        if ($row['nom_playlist'] != $current_playlist) {
            if ($current_playlist !== null) {
                echo "</div>"; // Fermer la div pour la playlist précédente
                // Afficher le formulaire de vote pour la playlist précédente
                echo "<div class='vote-form'>";
                echo "<form action='vote.php' method='POST'>";
                echo "<input type='hidden' name='playlist' value='$current_playlist_id'>";
                echo "<label for='vote'>Vote :</label>";
                echo "<select name='vote' id='vote'>";
                $current_playlist_id = $row['Id_play'];
                echo "<option value='like'>J'aime</option>";
                echo "<option value='dislike'>Je n'aime pas</option>";
                echo "</select>";
                echo "<button type='submit'>Valider</button>";
                echo "</form>";
                echo "</div>";
            }
            echo "<div class='playlist'>"; // Nouvelle div pour la playlist
            echo "<div class='playlist_aff'>";
            echo "<img src='" . $row['playlist_photo'] . "' alt='Photo de la playlist' class='playlist-photo'>";
            echo "<h3>Playlist : " . $row['nom_playlist'] . "</h3>";
            echo "<button onclick=\"toggleMusic('playlist_" . $row['Id_play'] . "')\">Voir les musiques</button>";
            echo "</div>";
            // Ajouter un identifiant unique à la liste de musiques de la playlist
            $current_playlist = $row['nom_playlist']; // Mettre à jour la playlist actuelle
            $current_playlist_id = $row['Id_play'];
            echo "<section class='muse'>";
            echo "<ul id='playlist_" . $row['Id_play'] . "' style='display:none;'>";
        }

        echo "<li class='slide'>";
        echo "Musique: " . $row['nom_musique'] . " - Durée: " . $row['duree_SC'];
        echo "<br>";
        echo "<img src='" . $row['musique_photo'] . "' alt='Photo de la musique' class='musique-photo'><br>";
        echo "</li>";
    }


    if ($current_playlist !== null) {
        echo "</ul>";
        echo "</div>"; // Fermer la dernière div pour la dernière playlist
        echo "<div class='vote-form'>";
        echo "<form action='vote.php' method='POST'>";
        echo "<input type='hidden' name='playlist' value='$current_playlist_id'>";
        echo "<label for='vote'>Vote :</label>";
        echo "<select name='vote' id='vote'>";
        echo "<option value='like'>J'aime</option>";
        echo "<option value='dislike'>Je n'aime pas</option>";
        echo "</select>";
        echo "<button type='submit'>Valider</button>";
        echo "</form>";
        echo "</div>";
    }
    echo "</div>"; // Fermer la div pour la liste de toutes les playlists

    // Afficher les likes pour chaque playlist
    foreach ($playlist_likes as $playlist_id => $like_count) {
        echo "Playlist ID: " . $playlist_id . ", Nombre de votes 'like': " . $like_count . "<br>";
    }
    echo "Playlist ID: " . $playlist_id . ", Nombre de votes 'like': " . $row['vote_max'] . "<br>";



    ?>
    <script src="script.js"></script>
</body>

</html>