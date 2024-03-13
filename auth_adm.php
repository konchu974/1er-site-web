<?php
session_start();

//------------------------------------
//  _____ _               _    
// /  __ \ |             | |   
// | /  \/ |__   ___  ___| | __
// | |   | '_ \ / _ \/ __| |/ /
// | \__/\ | | |  __/ (__|   < 
//  \____/_| |_|\___|\___|_|\_\
//------------------------------------  
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    $msg = "Méthode POSt attendue. Reçu :" . $_SERVER["REQUEST_METHOD"];
    header("Location: error.php?msg=" . $msg);
    exit();
}

$login = isset($_POST['pseudo_adm']) ? $_POST['pseudo_adm'] : "";
$pwd_unhashed = isset($_POST['password']) ? $_POST['password'] : "";





//------------------------------------  
//  _____ _               _      _____                    
// /  __ \ |             | |    |  ___|                   
// | /  \/ |__   ___  ___| | __ | |__ _ __ _ __ ___  _ __ 
// | |   | '_ \ / _ \/ __| |/ / |  __| '__| '__/ _ \| '__|
// | \__/\ | | |  __/ (__|   <  | |__| |  | | | (_) | |   
//  \____/_| |_|\___|\___|_|\_\ \____/_|  |_|  \___/|_|   
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
//  _____      _ _    ____________ 
// |_   _|    (_) |   |  _  \ ___ \
//   | | _ __  _| |_  | | | | |_/ /
//   | || '_ \| | __| | | | | ___ \
//  _| || | | | | |_  | |/ /| |_/ /
//  \___/_| |_|_|\__| |___/ \____/ 
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
// ____________   _____ _               _    
// |  _  \ ___ \ /  __ \ |             | |   
// | | | | |_/ / | /  \/ |__   ___  ___| | __
// | | | | ___ \ | |   | '_ \ / _ \/ __| |/ /
// | |/ /| |_/ / | \__/\ | | |  __/ (__|   < 
// |___/ \____/   \____/_| |_|\___|\___|_|\_\
//------------------------------------
$msg = "";

$sql = "SELECT *
            FROM t_admin
            WHERE pseudo = :login";
$stmt = $pdo_conn->prepare($sql);
$stmt->bindParam(':login', $login);
$stmt->execute();

if ($stmt->rowCount() == 1) {
    $row = $stmt->fetch();
    // $imgpro = $row['photo'];
    $pwd_hashed = $row["mot_de_passe"];

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
        //------------------------------------
    } else {
        $msg = $msg . "Password incorrect.";
    }
} else {
    $msg = "Login doesn't exists or is duplicate.";
}




//------------------------------------
// ______         _ _               _   
// | ___ \       | (_)             | |  
// | |_/ /___  __| |_ _ __ ___  ___| |_ 
// |    // _ \/ _` | | '__/ _ \/ __| __|
// | |\ \  __/ (_| | | | |  __/ (__| |_ 
// \_| \_\___|\__,_|_|_|  \___|\___|\__|
//------------------------------------             
if ($msg != "") {
    header("Location: error.php?msg=" . $msg);
    exit();
} else {
    header("Location: admin_dashboard.php");
}
//------------------------------------
