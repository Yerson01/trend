<?php

class Cart {
    private $id;
    private $productId;
    private $userId;
    private $quantity;
    private $total;
    private $image;
    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    //getters
    public function getId() {
        return $this->id;
    }

    public function getProductId() {
        return $this->productId;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function getTotal() {
        return $this->total;
    }

    public function getImage() {
        return $this->image;
    }

    //setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function setProductId($productId) {
        $this->productId = $productId;
    }

    public function setTotal($total) {
        $this->total = $total;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function insertDB() {
        $productId = $this->getProductId();
        $userId = $this->getUserId();
        $quantity = $this->getQuantity();
        $total = $this->getTotal();
        $image = $this->getImage();

       $stmt = $this->conn->prepare("INSERT INTO cart(_product_id, _user_id, _quantity, _total, _image) VALUES (?,?,?,?,?)");
       $stmt->bind_param('iiids', $productId, $userId, $quantity, $total, $image);
       $stmt->execute();

       return $stmt;
    }

    public function getAll() {
        $query = "SELECT * FROM cart";
        $all = $this->conn->query($query);
        return $all;
    }

    public function getOne() {
        $id = $this->getId();
        $query = "SELECT * FROM cart WHERE _id = $id";
        return $this->conn->query($query);
    }

    public function getByUserId() {
        $id = $this->getUserId();
        $query = "SELECT * FROM cart WHERE _user_id = $id";
        return $this->conn->query($query);
    }

    public function getByUserLimit($limit) {
        $id = $this->getUserId();
        $query = "SELECT * FROM cart WHERE _user_id = $id ORDER BY _id DESC LIMIT $limit";
        return $this->conn->query($query);
    }

    public function getByProductId() {
        $id = $this->getProductId();
        $query = "SELECT * FROM cart WHERE _product_id = $id";
        return $this->conn->query($query);
    }

    public function getByUserAndProduct() {
        $productId = $this->getProductId();
        $userId = $this->getUserId();
        $query = "SELECT * FROM cart WHERE _user_id = $userId AND _product_id = $productId";
        $result = $this->conn->query($query);
        return $result;
    }

    public function getTotalCart() {
        $id = $this->getId();
        $query = "SELECT sum(_total) as 'totalSum' from cart WHERE _user_id = $id";
        $sum = $this->conn->query($query);
        return $sum;
    }

    public function deleteFromDB() {
        $id = $this->getId();
        $stmt = $this->conn->prepare("DELETE FROM cart WHERE _id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();

        return $stmt;
    }

    public function updateQuantity() {

    }

}