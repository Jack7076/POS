<?php
require_once __DIR__ . "/database.php";
require_once __DIR__ . "/session.php";

function authenticate($user, $pass){
    if(!isProzelHash($pass)){
        $pass = computeHash($pass);
    }
    $query = $conn->prepare("SELECT * WHERE username = :username AND password = :password");
    
    $query->execute([
        "username" => $user,
        "password" => $pass
    ]);

    while($user = $query->fetch(PDO::FETCH_ASSOC)){
        if($user !== false){
            $_SESSION['user'] = $user['username'];
            $_SESSION['pass'] = $user['password'];
            $_SESSION['ID']   = $user['ID'];
        }
    }
}

function computeHash($string){
    $salt = hash("sha256", "PROZEL_SALT_SECURE");
    $salt2 = hash("sha256", "SECONDLAYERHASH");

    $compute = $salt . $salt2 . $string . $salt . $salt2;

    $response = hash("sha512", $compute);

    $response = hash("sha512", $response);
    
    $response = "pzlhash" . $response;

    return $response;
}

function isProzelHash($hash){
    if(substr( $string_n, 0, 7) === "pzlhash")
        return true;
    return false;
}