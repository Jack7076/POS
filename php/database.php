<?php

require __DIR__ . "/../vendor/autoload.php";
$conn = new PDO("mysql:host=127.0.0.1;dbname=pos", "root", "");

$searchConfig = [
    'driver' => 'mysql',
    'host' => '127.0.0.1',
    'database' => 'pos',
    'username' => 'root',
    'password' => '',
    'storage' => __DIR__ . "/indexes/",
    'stemmer' => \TeamTNT\TNTSearch\Stemmer\PorterStemmer::class
];

function getUserData($id, $property){
    global $conn;

    $query = $conn->prepare("SELECT * FROM users WHERE ID = :id");

    $query->execute([
        "id"       => $id
    ]);

    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result[$property];
}