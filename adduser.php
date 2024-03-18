<?php

//check si bon requete recu 
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    $msg = "Méthode POSt attendue. Reçu :" . $_SERVER["REQUEST_METHOD"];
    header("Location: error.php?msg=" . $msg);
    exit();
}


$login = (isset($_POST['pseudo'])) ? $_POST['pseudo'] : "";

$pwd_unhashed = (isset($_POST['password'])) ? $_POST['password'] : "";
$pwd_unhashed_check = (isset($_POST['password_check'])) ? $_POST['password_check'] : "";



if ($pwd_unhashed != $pwd_unhashed_check) {
    $msg = "Les deux mots de passes ne correspondent pas.";
    header("Location: error.php?msg=" . $msg);
    exit();
}



// verifie erreur
                                                
if (
    $login == "" || $pwd_unhashed == ""
) {
    $msg = "Une des valeurs est vide :" . "<br>";
    $msg = $msg . " - Pseudo -> " . $login . "<br>";
    $msg = $msg . " - Password -> " . $pwd_unhashed . "<br>";
    header("Location: error.php?msg=" . $msg);
    exit();
}




//connexion BDD
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
    $pdo_conn = new PDO($dsn, $user, $password, $options);
} catch (PDOException $e) {
    $msg = $e->getMessage();
    header("Location: error.php?msg=" . $msg);
    die("Connection failed: " . $e->getMessage() . ' <br> Wtih error n° ' . (int)$e->getCode());
}







//requete sql
$msg = "";

$sql = "SELECT COUNT(*) AS cnt
        FROM t_user
        WHERE pseudo_adm = :login";
$stmt = $pdo_conn->prepare($sql);
$stmt->bindParam(':login', $login);
$stmt->execute();

if ($row = $stmt->fetch()) {
    if ((int)$row["cnt"] != 0) {
        $msg = "Login already exists in DB.";
    }
} else {
    $msg = "Erreur SQL ?";
}
if ($msg != "") {
    header("Location: error.php?msg=" . $msg);
    exit();
}



//ajout a la BDD        
                 
$sql = "INSERT INTO t_user (pseudo_adm, motdepasse) 
        VALUES (:login, :password)";
$stmt = $pdo_conn->prepare($sql);
$stmt->bindParam(':login', $login);
$stmt->bindParam(':password', $pwd_unhashed);
$stmt->execute();






//renvoie a la page
$msg = $login;

header("Location: register.php?pseudo=" . $login . "&login=" . $msg);
exit();

