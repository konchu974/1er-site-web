<?php
session_start();

//------------------------------------

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    $msg = "Méthode POSt attendue. Reçu :" . $_SERVER["REQUEST_METHOD"];
    header("Location: error.php?msg=" . $msg);
    exit();
}

$login = isset($_POST['pseudo']) ? $_POST['pseudo'] : "";
$pwd_unhashed = isset($_POST['password']) ? $_POST['password'] : "";
//------------------------------------  
                                               
if (
    $login == "" ||
    $pwd_unhashed == ""
) {
    $msg = "Une des valeurs est vide :" . "<br>";
    $msg = $msg . " - Login -> " . $login . "<br>";
    $msg = $msg . " - Password -> " . $pwd_unhashed . "<br>";
    header("Location: error.php?msg=" . $msg);
    exit();
}
//------------------------------------


//------------------------------------

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
//------------------------------------






//------------------------------------

$msg = "";

$sql = "SELECT *
            FROM t_user
            WHERE pseudo_adm = :login";
$stmt = $pdo_conn->prepare($sql);
$stmt->bindParam(':login', $login);
$stmt->execute();

if ($stmt->rowCount() == 1) {
    $row = $stmt->fetch();
    $imgpro = $row['photo_adm'];
    $pwd_hashed = $row["motdepasse"];
    $user_id = $row["id_ad"];

    if ($pwd_unhashed == $pwd_hashed) {

        //------------------------------------
        //  _____      _     _____ _____ _____ _____ _____ _____ _   _ 
        // /  ___|    | |   /  ___|  ___/  ___/  ___|_   _|  _  | \ | |
        // \ `--.  ___| |_  \ `--.| |__ \ `--.\ `--.  | | | | | |  \| |
        //  `--. \/ _ \ __|  `--. \  __| `--. \`--. \ | | | | | | . ` |
        // /\__/ /  __/ |_  /\__/ / |___/\__/ /\__/ /_| |_\ \_/ / |\  |
        // \____/ \___|\__| \____/\____/\____/\____/ \___/ \___/\_| \_/
        //------------------------------------
        $_SESSION['user_img'] = $imgpro;
        $_SESSION['user'] = $login;
        $_SESSION['loggedIn'] = true;
        $_SESSION['user_id'] = $user_id;
        //------------------------------------
    } else {
        $msg = $msg . "Password incorrect.";
    }
} else {
    $msg = "Login doesn't exists or is duplicate.";
}




//------------------------------------
            
if ($msg != "") {
    header("Location: error.php?msg=" . $msg);
    exit();
} else {
    header("Location: page3.php");
}
//------------------------------------
