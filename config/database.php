<?php

class Database {
    public static function Connect() {
        $conn = new mysqli('localhost', 'root', '', 'trendstyle');
        $conn->query('SET NAMES utf8');
        return $conn;
    }
}