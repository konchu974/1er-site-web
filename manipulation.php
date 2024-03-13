<?php

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'site';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    // Connexion à la base de données
    $pdo_conn = new PDO($dsn, $user, $password, $options);

    // Requête SQL pour récupérer les playlists avec leurs musiques
    $sql = "SELECT p.Id_play, p.nom_playlist, m.Id_misc, m.nom_musique, p.photo_src AS playlist_photo, m.photo_path AS musique_photo, m.duree_SC
            FROM T_playlist_play p
            JOIN TJ_liason l ON p.Id_play = l.Id_play
            JOIN T_musique_misc m ON l.Id_misc = m.Id_misc";


    $stmt = $pdo_conn->query($sql);


    $current_playlist = null;
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}
?>

<script>
    function toggleMusic(playlistId) {
        var x = document.getElementById(playlistId);
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>