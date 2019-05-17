<?php 
require_once __DIR__ . "/../php/database.php";

use TeamTNT\TNTSearch\TNTSearch;

$tnt = new TNTSearch;

$tnt->loadConfig($searchConfig);

$indexer = $tnt->createIndex("default.index");
$indexer->setPrimaryKey("ID");
$indexer->query('SELECT * FROM products');
$indexer->run();