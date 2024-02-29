<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Success</title>
</head>
<body>
    <p>L'utilisateur <?=$_GET['email']?> a bien été ajouté.</p>
    <p>Détails : </p>
    <p><?=$_GET['msg']?></p>

    <?php include 'footer.php'; ?>
</body>
</html>