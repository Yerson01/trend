<?php
require_once './models/Category.php';
require_once './models/Product.php';
require_once  './models/Cart.php';

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

    public static function isntLogin() {
        if (!isset($_SESSION['user']) && !isset($_SESSION['admin'])) {
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

    public static function showProductByOffer() {
        $product = new Product();
        return $product->getOneByOffer()->fetch_object();
    }

    public static function showLimitProducts($limit) {
        $product = new Product();
        $products = $product->getLimit($limit);
        return $products;
    }

    public static function showCart() {
        $cart = new Cart();
        return $cart->getAll();
    }

    public static function showCartByUser($id) {
        $cart = new Cart();
        $cart->setUserId($id);
        return $cart->getByUserId();
    }

    public static function showCartByUserLimit($id, $limit) {
        $cart = new Cart();
        $cart->setUserId($id);
        return $cart->getByUserLimit($limit);
    }

    public static function showCartByProduct($id) {
        $cart = new Cart();
        $cart->setProductId($id);
        return $cart->getByProductId();
    }

    public static function showCartByUserAndProduct($userId, $productId) {
        $cart = new Cart();
        $cart->setUserId($userId);
        $cart->setProductId($productId);
        return $cart->getByUserAndProduct();
    }

    public static function showTotalCart($id) {
        $cart = new Cart();
        $cart->setId($id);
        return $cart->getTotalCart();
    }

    public static function userOrAdmin() {
        $user = '';
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
        } else if (isset($_SESSION['admin'])) {
            $user = $_SESSION['admin'];
        } else {
            $user = false;
        }
        return $user;

    }

}
