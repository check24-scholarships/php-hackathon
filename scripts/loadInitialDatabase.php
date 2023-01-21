<?php
    include "src/databaseFunctions.php";

    $content = file_get_contents("./data/dump.json");
    $objects = json_decode($content);
    $repo = new DBFuncs("db.sqlite3");
    $repo->setupTables();
    foreach($objects as $obj) {
        $product = new Product($obj->{'name'}, $obj->{'price'}, $obj->{'image'});
        $repo->insertProductIntoDatabase($product);
    }
?>