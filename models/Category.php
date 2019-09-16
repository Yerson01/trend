<?php

class Category {
    private $id;
    private $name;
    private $image;
    private $conn;

    //getters
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getImage() {
        return $this->image;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function __construct() {
        $this->conn = Database::connect();
    }

    public function getAll() {
        $categories = $this->conn->query("SELECT * FROM categories");
        return $categories;
    }

    public function getOne() {
        $id = $this->getId();
        $category = $this->conn->query("SELECT * FROM categories WHERE _id = $id");
        return $category->fetch_assoc();
    }

    public function insertDB() {
        $name = $this->conn->real_escape_string($this->getName());
        $image = $this->getImage();

        //prepare statement
        $stmt = $this->conn->prepare("INSERT INTO categories (_name, _image) VALUES (?, ?)");
        $stmt->bind_param('ss', $name, $image);
        $stmt->execute();
        if ($stmt->affected_rows !== 0 ) {
            return true;
        } else {
           return false;
        }
    }
}