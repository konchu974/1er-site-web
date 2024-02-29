<?php

//------------------------------------
//  _____ _               _    
// /  __ \ |             | |   
// | /  \/ |__   ___  ___| | __
// | |   | '_ \ / _ \/ __| |/ /
// | \__/\ | | |  __/ (__|   < 
//  \____/_| |_|\___|\___|_|\_\
//------------------------------------  
    if ($_SERVER["REQUEST_METHOD"] != "POST")
    {
        $msg = "Méthode POSt attendue. Reçu :".$_SERVER["REQUEST_METHOD"];
        header("Location: error.php?msg=".$msg); 
        exit();
    }


    $login = (isset($_POST['pseudo'])) ? $_POST['pseudo'] : "";
    
    $pwd_unhashed = (isset($_POST['password'])) ? $_POST['password'] : "";
    $pwd_unhashed_check = (isset($_POST['password_check'])) ? $_POST['password_check'] : "";



    if($pwd_unhashed != $pwd_unhashed_check)
    {
        $msg = "Les deux mots de passes ne correspondent pas.";
        header("Location: error.php?msg=".$msg); 
        exit();
    }



//------------------------------------  
//  _____ _               _      _____                    
// /  __ \ |             | |    |  ___|                   
// | /  \/ |__   ___  ___| | __ | |__ _ __ _ __ ___  _ __ 
// | |   | '_ \ / _ \/ __| |/ / |  __| '__| '__/ _ \| '__|
// | \__/\ | | |  __/ (__|   <  | |__| |  | | | (_) | |   
//  \____/_| |_|\___|\___|_|\_\ \____/_|  |_|  \___/|_|   
//------------------------------------                                                  
    if($login == "" || $pwd_unhashed == "" 
    )
    {
        $msg = "Une des valeurs est vide :"."<br>";
        $msg = $msg . " - Pseudo -> " . $login . "<br>";
        $msg = $msg . " - Password -> " . $pwd_unhashed . "<br>";
        header("Location: error.php?msg=".$msg); 
        exit();
    }




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
    header("Location: error.php?msg=".$msg); 
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

$sql = "SELECT COUNT(*) AS cnt
        FROM T_administrateur_ad
        WHERE pseudo_adm = :login";
$stmt = $pdo_conn->prepare($sql);
$stmt->bindParam(':login',$login);
$stmt->execute();

if($row = $stmt->fetch())
{
    if((int)$row["cnt"] != 0)
    {
        $msg = "Login already exists in DB.";
    }
}
else
{
    $msg = "Erreur SQL ?";
}
if($msg != "")
{
    header("Location: error.php?msg=".$msg); 
    exit();
}



//------------------------------------
// ____________   _____                    _   
// |  _  \ ___ \ |_   _|                  | |  
// | | | | |_/ /   | | _ __  ___  ___ _ __| |_ 
// | | | | ___ \   | || '_ \/ __|/ _ \ '__| __|
// | |/ /| |_/ /  _| || | | \__ \  __/ |  | |_ 
// |___/ \____/   \___/_| |_|___/\___|_|   \__|                                    
//------------------------------------          
// $pwd_hashed = password_hash($pwd_unhashed, PASSWORD_DEFAULT);                  
$sql = "INSERT INTO T_administrateur_ad (pseudo_adm, motdepasse) 
        VALUES (:login, :password)";
$stmt = $pdo_conn->prepare($sql);
$stmt->bindParam(':login',$login);
$stmt->bindParam(':password', $pwd_hashed);
$stmt->execute();
//------------------------------------





//------------------------------------
//  _____                             
// /  ___|                            
// \ `--. _   _  ___ ___ ___  ___ ___ 
//  `--. \ | | |/ __/ __/ _ \/ __/ __|
// /\__/ / |_| | (_| (_|  __/\__ \__ \
// \____/ \__,_|\___\___\___||___/___/
//------------------------------------
$msg = "<br>login -> ".$login;
$msg = $msg."<br>password -> ". $pwd;
$msg = $msg."<br>email -> ".$email;
header("Location: success.php?pseudo=".$login . "&msg=".$msg); 
exit();
//------------------------------------

?>