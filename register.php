<html>
<html lang="fr">

<head>
  <link rel="stylesheet" href="index.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Ultra&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet" />
</head>
<header>
  <img id="logo-sfond" src="image/Music-Logo-sans-fond.png" alt="Music-Logo-sans-fond" width="100" height="66.6">

  <h1>Beat Connect</h1>
</header>

<body>
<div class="bg-image"></div>
  <div class="form-container">
    <h1>S'enregistrer</h1>
    <form action="addUser.php" method="POST">
      <input type="text" id="pseudo" name="pseudo" placeholder="Pseudo" class="entrer" value=""><br>
      <input type="password" id="password" name="password" placeholder="Mot de passe" class="entrer" value=""><br>
      <input type="password" id="password" name="password_check" placeholder="Vérification Mot de passe" class="entrer" value=""><br><br>
      <button type="submit" class="btn-inv" name="login">Creer compte</button>
    </form>
    <span><a href="connection.html">ANNULER</a></span>
  </div>
  <?php
  if (isset($_GET['login'])) {
    echo ('<script>alert("Bienvenue ' . $_GET['login'] . '");</script>');
  }

  ?>

</body>