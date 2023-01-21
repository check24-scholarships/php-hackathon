<?php
class Product {
 
    private string $name;
    private int $price;
    private string $image;

    function __construct(string $name, int $price, string $image){
        $this->name = $name;
        $this->price = $price;
        $this->image = $image;
    } 
    
    function getName(){
        return $this->name;
    }

    function getPrice(){
        return $this->price;
    }

    function getImage(){
        return $this->image;
    }
}