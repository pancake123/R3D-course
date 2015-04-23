<?php

require_once ("../core/Core.php");

Connection::getInstance()->prepare("INSERT INTO role (id, name) VALUES (:id, :name)")->execute([
    ":id" => $_POST["id"],
    ":name" => $_POST["name"],
]);

$stmt = Connection::getInstance()->prepare("INSERT INTO privilege_to_role (role_id, privilege_id) VALUES (:role_id, :privilege_id)");

if (isset($_POST["privileges"])) {
    $privileges = $_POST["privileges"];
} else {
    $privileges = [];
}

foreach ($privileges as $privilege) {
    $stmt->execute([
        ":role_id" => $_POST["id"],
        ":privilege_id" => $privilege
    ]);
}

Url::getInstance()->redirect();