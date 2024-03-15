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
    <div class='playlist'>
        <div class='playlist_aff'>

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

                // Configuration des options de PDO pour afficher les exceptions en cas d'erreur
                $pdo_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                if (isset($_GET['playlist_id'])) {
                    $playlist_id = $_GET['playlist_id'];

                    // Préparation de la requête SQL pour récupérer les données de la playlist
                    $sql = "SELECT * FROM t_playlist_play WHERE Id_play = :playlist_id";

                    // Préparation de la requête
                    $stmt = $pdo_conn->prepare($sql);

                    // Liaison des paramètres
                    $stmt->bindParam(':playlist_id', $playlist_id, PDO::PARAM_INT);

                    // Exécution de la requête
                    $stmt->execute();

                    // Récupération des résultats
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Vérification si une playlist a été trouvée
                    if ($result) {
                        // Affichage des données de la playlist
                        echo "Nom de la playlist : " . $result["nom_playlist"] . "<br>";
                        echo '<img src="' . $result["photo_src"] . '" alt="Photo de la playlist"><br>';
                    } else {
                        echo "Aucune playlist trouvée avec cet ID.";
                    }
                } else {
                    echo "Aucun ID de playlist spécifié dans l'URL.";
                }
            } catch (PDOException $e) {
                // En cas d'erreur PDO, afficher le message d'erreur
                echo "Erreur : " . $e->getMessage();
            }

            ?>

        </div>
    </div>
</body>