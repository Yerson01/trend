<?php

class UserController {
    public function index() {
        echo 'Index desde UserController';
    }

    public function login() {
        require_once './views/user/login.php';
    }

    public function register() {
        require_once './views/user/register.php';
    }
}