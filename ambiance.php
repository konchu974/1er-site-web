<?php
session_start();
require_once("manipulation.php");
?>

<!DOCTYPE html>
<html lang="en">

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
    <?php
    // Afficher toutes les ambiances
    $stmt_ambiances = getAllAmbiances();
    if ($stmt_ambiances && $stmt_ambiances->rowCount() > 0) :
    ?>
        <h2>Sélectionnez une ambiance :</h2>
        <ul>
            <?php while ($row_ambiance = $stmt_ambiances->fetch()) : ?>
                <li>
                    <a href="ambiance.php?ambiance=<?php echo $row_ambiance['Id_amb']; ?>">
                        <?php echo $row_ambiance['nom_ambiance']; ?>
                    </a>
                </li>
            <?php endwhile; ?>
        </ul>

        <?php
        // Afficher les playlists associées à l'ambiance sélectionnée
        if (isset($_GET['ambiance'])) {
            $ambiance_id = $_GET['ambiance'];
            $stmt_playlists = getPlaylistsByAmbiance($ambiance_id);

            echo "<div class='playlist-container'>";
            while ($playlist = $stmt_playlists->fetch()) {
                echo "<div class='playlist'>";
                echo "<h3>Playlist : " . $playlist['nom_playlist'] . "</h3>";
                echo "<img src='" . $playlist['photo_src'] . "' alt='Photo de la playlist' style='max-width: 100px;'>";
                echo "<ul>";
                // echo "<li>Musique : " . $playlist['nom_musique'] . " - Durée : " . $playlist['duree_SC'] . "</li>";
                // echo "<li><img src='" . $playlist['musique_photo'] . "' alt='Photo de la musique' style='max-width: 100px;'></li>";
                echo "</ul>";
                echo "</div>";
            }
            echo "</div>";
        }
        ?>
    <?php else : ?>
        <p>Aucune ambiance disponible.</p>
    <?php endif; ?>
</body>

</html>