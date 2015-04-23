<?php

require_once("Session.php");

class Url {

    private function  __construct() {
        /*Locked*/
    }

    public static function getInstance() {
        if (self::$instance == null) {
            return self::$instance = new Url();
        } else {
            return self::$instance;
        }
    }

    public function redirect($path = "", $exit = true) {
        header("location: /nastya/".$path, true, 301);
        if ($exit) {
            die;
        }
    }

    public function redirectIfGuest() {
        if (Session::getInstance()->isGuest()) {
            $this->redirect("index.php");
        }
    }

    private static $instance = null;

}