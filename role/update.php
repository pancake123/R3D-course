<?php

require_once ("../core/Core.php");

# Fetch list with privileges, which we set in modal window
if (isset($_POST["privileges"])) {
    $privileges = $_POST["privileges"];
} else {
    $privileges = [];
}

# update role's information by it's identification value
Connection::getInstance()->prepare("UPDATE `role` SET `name` = :role_name WHERE `id` = :role_id")->execute([
    ":role_name" => $_POST["name"],
    ":role_id" => $_POST["id"]
]);

# Fetch list with privileges that appended to this role
$stmt = Connection::getInstance()->prepare("SELECT * FROM `privilege_to_role` WHERE `role_id` = :role_id");
$stmt->execute([
    ":role_id" => $_POST["id"]
]);
$array = $stmt->fetchAll(PDO::FETCH_ASSOC);
$previous = [];
foreach ($array as $row) {
    $previous[] = $row["privilege_id"];
}

# Compute arrays with references to remove and insert
$remove = [];
$insert = [];
foreach ($previous as $privilege) {
    if (!in_array($privilege, $privileges)) {
        $remove[] = $privilege;
    }
}
foreach ($privileges as $privilege) {
    $insert[] = $privilege;
}

# Remove redundant references from unset privileges and current role
$sql = Connection::getInstance()->prepare("DELETE FROM `privilege_to_role` WHERE `role_id` = :role_id AND `privilege_id` = :privilege_id");
foreach ($remove as $privilege) {
    $sql->execute([
        ":role_id" => $_POST["id"],
        ":privilege_id" => $privilege
    ]);
}

# Save other references in database
$sql = Connection::getInstance()->prepare("INSERT INTO `privilege_to_role` (`role_id`, `privilege_id`) VALUES (:role_id, :privilege_id)");
foreach ($insert as $privilege) {
    $sql->execute([
        ":role_id" => $_POST["id"],
        ":privilege_id" => $privilege
    ]);
}

Url::getInstance()->redirect();