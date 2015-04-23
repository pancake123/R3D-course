<?php

require_once ("../core/Core.php");

# Update privilege's information by it's identification value
Connection::getInstance()->prepare("UPDATE `user` SET `login` = :login, `surname` = :surname, `name` = :name, `patronymic` = :patronymic, `role_id` = :role_id WHERE `id` = :id")->execute([
    ":login" => $_POST["login"],
    ":surname" => $_POST["surname"],
    ":name" => $_POST["name"],
    ":patronymic" => $_POST["patronymic"],
    "role_id" => $_POST["role_id"],
    ":id" => $_POST["id"]
]);

if (isset($_POST["password"]) && !empty($_POST["password"])) {
    Connection::getInstance()->prepare("UPDATE `user` SET `password` = :password WHERE `id` = :id")->execute([
        ":password" => md5($_POST["password"]),
        ":id" => $_POST["id"]
    ]);
}

Url::getInstance()->redirect();