<?php
include "src/product.php";

class DBFuncs {
    public SQLite3 $db;

    function __construct(string $filename)
    {
        $this->db = new SQLite3($filename);
    }

    function setupTables() {
        $this->db->exec("CREATE TABLE IF NOT EXISTS Product (name TEXT, price INT, image TEXT);");
    }

    function searchProductByName(string $searchParam, string $sort): array {
        $products = array();
        $productQuery = $this->db->query("SELECT * FROM Product WHERE name LIKE '%{$searchParam}%' ORDER BY price {$sort}");
        while($row = $productQuery->fetchArray()) {
            $product = new Product($row['name'], $row['price'], $row['image']);
            array_push($products, $product);
        }
        return $products;
    }

    function insertProductIntoDatabase(Product $newProduct) {
        $this->db->exec("INSERT INTO Product (name, price, image) VALUES ('{$newProduct->getName()}', '{$newProduct->getPrice()}', '{$newProduct->getImage()}');");
    }
}
