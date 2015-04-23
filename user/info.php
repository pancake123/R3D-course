<?php

require("../core/Core.php");

Url::getInstance()->redirectIfGuest();

if (!isset($_GET["id"]) || empty($_GET["id"])) {
    $id = $_SESSION["user"]["id"];
} else {
    $id = $_GET["id"];
}

$stmt = Connection::getInstance()->prepare("SELECT u.*, r.name as role_name FROM `user` AS u INNER JOIN `role` AS r ON r.id = u.role_id WHERE u.id = :id");

$stmt->execute([
    ":id" => $id
]);

if (($user = $stmt->fetchObject()) == null) {
    die("Can't resolve user with identification number \"{$id}\"");
}

$stmt = Connection::getInstance()->prepare("SELECT * FROM `role`");
$stmt->execute();
$roles = $stmt->fetchAll();

$stmt = Connection::getInstance()->prepare("SELECT * FROM `privilege`");
$stmt->execute();
$privileges = $stmt->fetchAll();

$stmt = Connection::getInstance()->prepare("SELECT * FROM `user`");
$stmt->execute();
$users = $stmt->fetchAll();

Layout::getInstance()->render("index", "user/cabinet.php", [
    "user" => $user,
    "privileges" => $privileges,
    "roles" => $roles,
    "users" => $users,
]);
