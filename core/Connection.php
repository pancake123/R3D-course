<?php

class Connection extends PDO {

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Connection("mysql:host=localhost;port=8889;dbname=owl", "root", "root");
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$instance;
    }

    private static $instance = null;
}