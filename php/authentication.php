<?php
require_once __DIR__ . "/database.php";
require_once __DIR__ . "/session.php";

function authenticate($pin){
    global $conn;
    if(!isProzelHash($pin)){
        $pin = computeHash($pin);
    }
    $query = $conn->prepare("SELECT * FROM users WHERE pin = :pin LIMIT 1");
    
    $query->execute([
        "pin" => $pin
    ]);

    while($user = $query->fetch(PDO::FETCH_ASSOC)){
        if($user !== false){
            $_SESSION['fname'] = $user['fname'];
            $_SESSION['lname'] = $user['lname'];
            $_SESSION['pin'] = $user['pin'];
            $_SESSION['ID']   = $user['ID'];
            return true;
        }
    }
    return false;
}

function computeHash($string){
    global $conn;
    $salt = hash("sha256", "PROZEL_SALT_SECURE");
    $salt2 = hash("sha256", "SECONDLAYERHASH");

    $compute = $salt . $salt2 . $string . $salt . $salt2;

    $response = hash("sha512", $compute);

    $response = hash("sha512", $response);
    
    $response = "pzlhash" . $response;

    return $response;
}

function isProzelHash($hash){
    global $conn;
    if(substr( $hash, 0, 7) === "pzlhash")
        return true;
    return false;
}

function authenticated(){
    global $conn;
    if(!isset($_SESSION['pin']))
        return false;
    
    $query = $conn->prepare("SELECT pin FROM users WHERE ID = :id");

    $query->execute([
        "id" => $_SESSION['ID']
    ]);

    $res = $query->fetch(PDO::FETCH_ASSOC);

    if($res['pin'] === $_SESSION['pin'])
        return true;
    logout();
    return false;
}

function hasAccess($level){
    global $conn;
    if(!authenticated())
        return false;
    $query = $conn->prepare("SELECT users.access, access.name, access.level
    FROM users INNER JOIN access ON users.access=access.name 
    WHERE users.ID = :id");
    $query->execute([
        "id" => $_SESSION['ID']
    ]);

    $res = $query->fetch(PDO::FETCH_ASSOC);
    if($res['level'] >= $level){
        return true;
    }
    return false;
}

function logout(){
    session_destroy();
}