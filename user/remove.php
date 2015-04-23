<?php
require_once("../core/Core.php");

Connection::getInstance()->prepare("DELETE FROM `user` WHERE id = :id")->execute([
    ":id" => $_GET["id"]
]);

Url::getInstance()->redirect();