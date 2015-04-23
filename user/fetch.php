<?php

require_once "../core/Core.php";

$stmt = Connection::getInstance()->prepare("SELECT * FROM user WHERE id = :id");
$stmt->execute([
    ":id" => $_GET["id"]
]);
$user = $stmt->fetchObject();
$user->password = null;

print json_encode([
    "user" => $user
]);