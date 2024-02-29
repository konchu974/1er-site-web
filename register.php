<html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide">
</head>
<header>
    <img id="logo-sfond" src="image/Music-Logo-sans-fond.png" alt="Music-Logo-sans-fond" width="100" height="66.6">

    <h1>Beat Connect</h1>
</header>

<body>

    <div class="form-container">
        <h1>S'enregistrer</h1>
        <form action="addUser.php" method="POST">
            <input type="text" id="pseudo" name="pseudo" placeholder="Pseudo" class="entrer" value=""><br>
            <input type="password" id="password" name="password" placeholder="Mot de passe" class="entrer" value="">
            <input type="password" id="password" name="password_check" placeholder="Vérification Mot de passe" class="entrer" value="">
            <br>
            <br>
            <button type="submit" class="bouton" name="login">Creer compte</button>
        </form>
        <span><a href="connection.html">ANNULER</a></span>
    </div>
    <?php
    if (isset($_GET['login'])) {
        echo ('<script>alert("Bienvenue ' . $_GET['login'] . '");</script>');
    }

    ?>

</body>