<?php

require_once "../core/Core.php";

$stmt = Connection::getInstance()->prepare("SELECT * FROM role WHERE id = :id");
$stmt->execute([
    ":id" => $_GET["id"]
]);
$role = $stmt->fetchObject();

$stmt = Connection::getInstance()->prepare("SELECT privilege_id FROM privilege_to_role WHERE role_id = :id");
$stmt->execute([
    ":id" => $_GET["id"]
]);
$privileges = [];
foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $p) {
    $privileges[] = $p["privilege_id"];
}

print json_encode([
    "role" => $role,
    "privileges" => $privileges
]);