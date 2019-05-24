<?php

require_once __DIR__ . "/../php/authentication.php";

if(!authenticated())
    die("This is no place for a skid.");

if(!isset($_POST['items'])){
    die("No Items Submitted");
}

$query = $conn->prepare("INSERT INTO sales (products, soldby, customer)
                         VALUES (:product, :soldby, :customer)");

$query->execute([
    "product" => $_POST['items'],
    "soldby" => $_SESSION['ID'],
    "customer" => $_POST['customer']
]);

die("success");