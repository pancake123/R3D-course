<?php

require_once ("../core/Core.php");

# Update privilege's information by it's identification value
Connection::getInstance()->prepare("UPDATE `privilege` SET `name` = :role_name WHERE `id` = :role_id")->execute([
    ":role_name" => $_POST["name"],
    ":role_id" => $_POST["id"]
]);

Url::getInstance()->redirect();