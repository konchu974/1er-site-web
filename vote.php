<?php
session_start();
require_once("manipulation.php");

// Vérifier si des données de vote ont été soumises
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['playlist'], $_POST['vote'])) {
    // Récupérer l'ID de la playlist et le vote de l'utilisateur depuis les données POST
    $playlist_id = $_POST['playlist'];
    $vote = $_POST['vote'];

    // Vous devez également récupérer l'ID de l'utilisateur à partir de la session ou d'autres informations
    // Supposons que l'ID de l'utilisateur est stocké dans $_SESSION['user_id']
    $user_id = null;

    // Enregistrer le vote dans la base de données
    // Assurez-vous d'utiliser des requêtes préparées pour éviter les injections SQL
    try {
        // Préparation de la requête d'insertion
        $stmt = $pdo_conn->prepare("INSERT INTO tj_vote_vt (Id_prsn, Id_playlist, vote) VALUES (?, ?, ?)");
        // Exécution de la requête avec les valeurs récupérées
        $stmt->execute([$user_id, $playlist_id, $vote]);

        // Rediriger l'utilisateur vers la page d'affichage des playlists après le traitement
        header("Location: page3.php");
        exit;
    } catch (PDOException $e) {
        // En cas d'erreur lors de l'enregistrement du vote, afficher un message d'erreur
        echo "Erreur lors de l'enregistrement du vote : " . $e->getMessage();
    }
} else {
    // Si aucune donnée de vote n'a été soumise, rediriger l'utilisateur vers la page d'affichage des playlists
    header("Location: page3.php");
    exit;
}
?>