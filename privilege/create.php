<?php
require_once ("../core/Core.php");

Connection::getInstance()->prepare("INSERT INTO privilege (id, name) VALUES (:id, :name)")->execute([
    ":id" => $_POST["id"],
    ":name" => $_POST["name"],
]);

Url::getInstance()->redirect();