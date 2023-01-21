<?php
include "src/databaseFunctions.php";

$db = new DBFuncs("db.sqlite3");
$products = $db->searchProductByName("Barum");
print_r($products);
echo sizeof($products);