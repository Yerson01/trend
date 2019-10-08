<?php

class User {
    private $name;
    private $lastname;
    private $email;
    private $password;
    private $rol;
    private $image;
    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
        $this->rol = 'user';
        $this->image = 'default';
    }

    //getters
    public function getName() {
        return $this->name;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRol() {
        return $this->rol;
    }

    public function getImage() {
        return $this->image;
    }

    //setters
    public function setName($name) {
        $this->name = $name;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setRol($rol) {
        $this->rol = $rol;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function insertDB() {
        $name = mysqli_real_escape_string($this->conn, $this->getName());
        $lastname = mysqli_real_escape_string($this->conn, $this->getLastname());
        $email = mysqli_real_escape_string($this->conn, $this->getEmail());
        $password = $this->getPassword();
        $rol = $this->getRol();
        $image = $this->getImage();

        //Prepare statement
        $stmt = $this->conn->prepare('INSERT INTO users (_username, _lastname, _email, _password, _rol, _image) VALUES (?,?,?,?,?,?)');
        $stmt->bind_param('ssssss', $name, $lastname, $email, $password, $rol, $image);
        $stmt->execute();

        if ($stmt->affected_rows !== 0) {
            return true;
        } else {
            return false;
        }
    }

    public function login() {
        $email = $this->getEmail();
        $password = $this->getPassword();
        $login = $this->conn->query("SELECT * FROM users WHERE _email = '$email'");

        if ($login && $login->num_rows !== 0) {
            $dbUser = $login->fetch_assoc();

            //verificar que la contraseña sea correcta
            $isPasswordSame = password_verify($password, $dbUser['_password']);
            $message = '';
            if ($isPasswordSame) {
                return $dbUser;
            } else {
                return $message = 'Email and password do not match';
            }
        } else {
            return $message = 'The email is not registered';
        }
    }
}