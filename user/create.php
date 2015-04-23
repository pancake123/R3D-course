<?php
require_once ("../core/Core.php");

Connection::getInstance()->prepare("INSERT INTO `user` (login, password, surname, name, patronymic, role_id) VALUES (
  :login, :password, :surname, :name, :patronymic, :role_id
)")->execute([
    ":login" => $_POST["login"],
    ":password" => md5($_POST["password"]),
    ":surname" => $_POST["surname"],
    ":name" => $_POST["name"],
    ":patronymic" => $_POST["patronymic"],
    ":role_id" => $_POST["role_id"]
]);

Url::getInstance()->redirect();