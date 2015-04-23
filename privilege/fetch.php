<?php

require_once "../core/Core.php";

$stmt = Connection::getInstance()->prepare("SELECT * FROM privilege WHERE id = :id");
$stmt->execute([
    ":id" => $_GET["id"]
]);
$privilege = $stmt->fetchObject();

print json_encode([
    "privilege" => $privilege
]);