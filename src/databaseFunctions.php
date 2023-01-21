<?php
class DBFuncs {
    public SQLite3 $db;

    function __construct(string $filename)
    {
        $db = new SQLite3($filename);
    }

    function setupTables() {
        $this->db->exec("CREATE TABLE IF NOT EXISTS Product (name TEXT, price INT, image TEXT);");
    }

    function searchProductByName(string $from, string $name): array {
        $products = array();
        $productQuery = $this->db->query("SELECT * FROM {$from} WHERE name LIKE %{$name}%");
        while($row = $productQuery->fetchArray()) {
            $product = new Product($row['name'], $row['price'], $row['image']);
            array_push($products, $product);
        }
        return $products;
    }
}
