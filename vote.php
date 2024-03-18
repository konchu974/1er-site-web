<?php
session_start();
require_once("manipulation.php");

// Vérifier si des données de vote ont été soumises
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['playlist'], $_POST['vote'])) {
    // Récupérer l'ID de la playlist et le vote avec POST
    $playlist_id = $_POST['playlist'];
    $vote = $_POST['vote'];


    $user_id = null;


    try {
        // requête d'insertion
        $stmt = $pdo_conn->prepare("INSERT INTO tj_vote_vt (Id_prsn, Id_playlist, vote) VALUES (?, ?, ?)");
        // Exécution requête avec les valeurs récupérées
        $stmt->execute([$user_id, $playlist_id, $vote]);

       
        header("Location: page3.php");
        exit;
    } catch (PDOException $e) {

        echo "Erreur lors de l'enregistrement du vote : " . $e->getMessage();
    }
} else {
    // Si aucune donnée de vote n'a été soumise, rediriger l'utilisateur vers la page d'affichage des playlists
    header("Location: page3.php");
    exit;
}
?>