<?php
require_once './models/User.php';

class UserController {
    public function index() {

    }

    public function login() {
        Utils::isLogged();
        require_once './views/user/login.php';
    }

    public function register() {
        Utils::isLogged();
        require_once './views/user/register.php';
    }

    public function manage() {
        Utils::isAdmin();
        require_once './views/user/manage.php';
    }

    public function create() {
        if (isset($_POST)){
            $name = !empty($_POST['name']) ? Utils::sanitizeField($_POST['name']) : false;
            $lastname = !empty($_POST['lastname']) ? Utils::sanitizeField($_POST['lastname']) : false;
            $email = !empty($_POST['email']) ? Utils::sanitizeField($_POST['email']) : false;
            $password = !empty($_POST['password']) ? Utils::hashPassword($_POST['password']) : false;

            if ($name && $lastname && $email && $password) {
               $user = new User();
               $user->setName($name);
               $user->setLastname($lastname);
               $user->setEmail($email);
               $user->setPassword($password);
               $register = $user->insertDB();
               if ($register) {
                   $_SESSION['success'] = 'Successfully registered!';
                   Utils::redirectTo('user/login');
               } else {
                   $_SESSION['error'] = 'An unexpected error occurred';
                   Utils::redirectTo('user/register');
               }
            } else {
                $_SESSION['error'] = 'All fields are required!';
                Utils::redirectTo('user/register');
            }
        } else {
            Utils::redirectTo('user/register');
        }
    }

    public function authenticate() {
        if (isset($_POST)) {
            $email = !empty($_POST['email']) ? $_POST['email'] : false;
            $password = !empty($_POST['password']) ? $_POST['password'] : false;

            if ($email && $password) {
                $user = new User();
                $user->setEmail($email);
                $user->setPassword($password);
                $userLogged = $user->login();
                if (gettype($userLogged) == 'array') {
                    if ($userLogged['_rol'] == 'user') {
                        $_SESSION['user'] = $userLogged;
                    } else if ($userLogged['_rol'] == 'admin') {
                        $_SESSION['admin'] = $userLogged;
                    }
                    Utils::redirectTo();
                } else {
                   $_SESSION['error'] = $userLogged;
                    Utils::redirectTo('user/login');
                }
            } else {
                $_SESSION['error'] = 'You must complete both fields';
                Utils::redirectTo('user/login');
            }
        } else {
            Utils::redirectTo('user/login');
        }
    }

    public function logout() {
        if (isset($_SESSION['user']) || isset($_SESSION['admin'])) {
            $_SESSION['user'] = null;
            $_SESSION['admin'] = null;
            header('Location:'.BASE_URL.'user/login');
        }
    }
}