<?php
class Product {
 
    private $name;
    private $price;
    private $image;

    function __construct($name, $price, $image){
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