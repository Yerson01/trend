<?php
require_once './models/Category.php';
require_once './models/Product.php';

class Utils {

    public static function sanitizeField($field) {
        $sanitizedField = trim($field);
        $sanitizedField = stripcslashes($sanitizedField);
        $sanitizedField = filter_var($sanitizedField, FILTER_SANITIZE_STRING);
        return $sanitizedField;
    }

    public static function hashPassword($password) {
        return password_hash($password, PASSWORD_BCRYPT, ['COST' => 4]);
    }

    public static function deleteSession($name) {
        if (isset($_SESSION[$name])) {
            $_SESSION[$name] = null;
        }
    }

    public static function redirectTo($location = '') {
        return header('Location:'.BASE_URL.$location);
    }

    public static function isAdmin() {
        if (!isset($_SESSION['admin'])) {
           return header('Location:'.BASE_URL);
        }
    }

    public static function isLogged() {
        if (isset($_SESSION['user']) || isset($_SESSION['admin'])) {
            return header('Location:'.BASE_URL);
        }
    }

    public static function saveImg($name, $location, $saveAt) {
        if (!is_dir("./src/img/$saveAt")) {
            mkdir("./src/img/$saveAt", 0777);
        }
        move_uploaded_file($location, "./src/img/$saveAt/$name");
    }

    public static function showCategories() {
        $category = new Category();
        $categories = $category->getAll();
        return $categories;
    }

    public static function showProducts() {
        $product = new Product();
        $products = $product->getAll();
        return $products;
    }

    public static function showProduct($id) {
        $product = new Product();
        $product->setId($id);
        $prod = $product->getOne();
        return $prod;
    }

    public static function showLimitProducts($limit) {
        $product = new Product();
        $products = $product->getLimit($limit);
        return $products;
    }

}
