<?php
require_once __DIR__ . "/database.php";
require_once __DIR__ . "/session.php";
require_once __DIR__ . "/dataOperations.php";
function isLockedout(){
    global $conn;
    $query = $conn->prepare("SELECT ID, attempts, timeout FROM lockout WHERE ip = :IP");
    $query->execute([
        "IP" => $_SERVER['REMOTE_ADDR']
    ]);
    $res = $query->fetch(PDO::FETCH_ASSOC);
    if($res){
        $date = time();
        if(strtotime($res['timeout']) >= $date){
            $_SESSION['lockout'] = true;
            return true;
        }
        else {
            unset($_SESSION['lockout']);
        }
    }
    return false;
}

function clearAttempts(){
    global $conn;
    $query = $conn->prepare("SELECT ID, attempts, timeout FROM lockout WHERE ip = :IP");
    $query->execute([
        "IP" => $_SERVER['REMOTE_ADDR']
    ]);
    $res = $query->fetch(PDO::FETCH_ASSOC);
    if($res){
        $query = $conn->prepare("UPDATE lockout SET attempts = :att WHERE ID = :id");
        $query->execute([
            "att" => 0,
            "id"  => $res['ID']
        ]);
    }
}

function invalidAttempt(){
    global $conn;
    $query = $conn->prepare("SELECT ID, attempts, timeout FROM lockout WHERE ip = :IP");
    $query->execute([
        "IP" => $_SERVER['REMOTE_ADDR']
    ]);
    $res = $query->fetch(PDO::FETCH_ASSOC);
    if($res){
        $attempts = $res['attempts'];
        $attempts++;
        $query = $conn->prepare("UPDATE lockout SET attempts = :att WHERE ID = :id");
        $query->execute([
            "att" => $attempts,
            "id"  => $res['ID']
        ]);
    }
    else {
        $query = $conn->prepare("INSERT INTO lockout (attempts, ip) VALUES (:att, :ip)");
        $query->execute([
            "att" => 1,
            "ip"  => $_SERVER['REMOTE_ADDR']
        ]);
        $attempts = 1;
    }
    if($attempts > 4){
        $idq = $conn->prepare("SELECT ID FROM lockout WHERE ip = :IP");
        $idq->execute([
            "IP" => $_SERVER['REMOTE_ADDR']
        ]);

        $id = $idq->fetch(PDO::FETCH_ASSOC);
        $id = $id['ID'];

        $lockoutTime = date("Y-m-d H:i:s", strtotime("+5 hours"));
        $query = $conn->prepare("UPDATE lockout SET timeout = :time , attempts = 0 WHERE ID = :id");
        $query->execute([
            "time" => $lockoutTime,
            "id"   => $id
        ]);
    }
}

function authenticate($pin){
    global $conn;
    if(isLockedout()){
        return false;
    }
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
            clearAttempts();
            return true;
        }
    }
    invalidAttempt();
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

function filterToNumber($string){
    $res = preg_replace('/[^0-9.]/', "", $string);
    $res = floatval($res);
    return $res;
}

function countUsers(){
    global $conn;
    $query = $conn->prepare("SELECT ID FROM users");
    $query->execute();
    $resp = $query->fetchAll(PDO::FETCH_ASSOC);
    $count = 0;
    foreach ($resp as $user) {
        $count++;
    }
    return $count;
}