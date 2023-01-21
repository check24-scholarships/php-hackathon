<?php
include "src/databaseFunctions.php";

$db = new DBFuncs("db.sqlite3");

$db->insertProductIntoDatabase(new Product("Martin Kellner", 69420, "https://avatars.githubusercontent.com/u/13597998?v=4"));