<?php

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

    public static function saveImg($name, $location) {
        if (!is_dir('./src/img/categories')) {
            mkdir('./src/img/categories', 0777);
        }
        move_uploaded_file($location, "./src/img/categories/$name");
    }
}
