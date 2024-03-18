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


    <?php


        if (isset($_GET['playlist_id'])) {
            $playlist_id = $_GET['playlist_id'];

            // requête pour récupérer donnéesplaylist
            $sql = "SELECT * FROM t_playlist_play WHERE Id_play = :playlist_id";


            $stmt = $pdo_conn->prepare($sql);


            $stmt->bindParam(':playlist_id', $playlist_id, PDO::PARAM_INT);


            $stmt->execute();


            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // Vérification si une playlist a été trouvée
            if ($result) {

                echo "<div class='playlist_vote'>";
                echo "<h2>la playlist la plus votée est : " . $result["nom_playlist"] . "<h2>";
                echo '<img src="' . $result["photo_src"] . '" alt="Photo de la playlist" class="img_vote">';

                echo "</div>";
            } else {
                echo "Aucune playlist trouvée avec cet ID.";
            }
        } else {
            echo "Aucun ID de playlist spécifié";
        }


    ?>

<div class="container_btn">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <button type="submit" name="sup" class="btn">Supprimer les votes</button>
    </form>
</div>

    <?php
    if (isset($_POST['sup'])) {
        $sql = "DELETE FROM tj_vote_vt;";
        $pdo_conn->exec($sql);
        header("Location: page3.php");
        exit();
    }

    ?>


</body>