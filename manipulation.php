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

    // Exécuter la requête pour récupérer les playlists
    $stmt = $pdo_conn->query($sql);

    // Requête SQL pour compter les likes pour chaque playlist
    $sql_likes = "SELECT Id_playlist, COUNT(*) AS like_count FROM tj_vote_vt WHERE vote = 'like' GROUP BY Id_playlist";

    // Exécuter la requête pour compter les likes
    $stmt_likes = $pdo_conn->query($sql_likes);

    // Initialiser un tableau pour stocker les résultats des votes
    $playlist_likes = [];

    // Parcourir les résultats de la requête et stocker les likes dans le tableau
    while ($row_likes = $stmt_likes->fetch()) {
        $playlist_likes[$row_likes['Id_playlist']] = $row_likes['like_count'];
    }
    $current_playlist = null;
    $current_playlist_id = null;




    $sqlpro = "SELECT *, (SELECT MAX(vote) FROM tj_vote_vt) AS vote_max
    FROM T_administrateur_ad
    JOIN t_ambiance_amb ON t_administrateur_ad.Id_amb = t_ambiance_amb.Id_amb;";

    $ambpref = "SELECT t_ambiance_amb.Id_amb, COUNT(t_administrateur_ad.Id_ad) AS nombre_apparitions
    FROM t_administrateur_ad
    JOIN t_ambiance_amb ON t_administrateur_ad.Id_amb = t_ambiance_amb.Id_amb
    GROUP BY t_ambiance_amb.Id_amb";

    $stmtpro = $pdo_conn->query($sqlpro);
    $resultat = $pdo_conn->query($sql);


    $current_pro = null;
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