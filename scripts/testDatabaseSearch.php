<?php
include "src/databaseFunctions.php";

$db = new DBFuncs("db.sqlite3");
$products = $db->searchProductByName($argv[1]);
print_r($products);
echo sizeof($products);