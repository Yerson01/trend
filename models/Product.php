<?php

class Product {
    private $id;
    private $categoryId;
    private $name;
    private $price;
    private $stock;
    private $description;
    private $offer;
    private $image;
    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    //getters
    public function getId() {
        return $this->id;
    }

    public function getCategoryId() {
        return $this->categoryId;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getStock() {
        return $this->stock;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getOffer() {
        return $this->offer;
    }

    //setters
    public function getImage() {
        return $this->image;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setCategoryId($categoryId) {
        $this->categoryId = $categoryId;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setStock($stock) {
        $this->stock = $stock;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setOffer($offer) {
        $this->offer = $offer;

    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function getAll() {
        $products = $this->conn->query("SELECT * FROM products ORDER BY _id DESC");
        return $products;
    }

    public function getLimit($limit) {
        $products = $this->conn->query("SELECT * FROM products ORDER BY _id DESC LIMIT $limit ");
        return $products;
    }

    public function getOne() {
        $id = $this->getId();
        $product = $this->conn->query("SELECT * FROM products WHERE _id = $id");
        return $product->fetch_object();
    }

    public function insertDB() {
        $name = $this->getName();
        $description = $this->getDescription();
        $price = $this->getPrice();
        $stock = $this->getStock();
        $categoryId = $this->getCategoryId();
        $offer = $this->getOffer();
        $image = $this->getImage();
        $date = date('Y-m-d');

        //prepare statement
        $stmt = $this->conn->prepare("INSERT INTO products (_category_id, _name, _price, _stock, _description, _offer, _date, _image) VALUES (?,?,?,?,?,?,?,?)");
        $stmt->bind_param('isiissss', $categoryId, $name, $price, $stock, $description, $offer, $date, $image);
        $stmt->execute();

        if ($stmt->affected_rows !== 0 ) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteFromDB() {
        $id = $this->getId();
        $stmt = $this->conn->prepare("DELETE FROM products WHERE _id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        if ($stmt->affected_rows !== 0) {
            return true;
        } else {
            return false;
        }

    }

}