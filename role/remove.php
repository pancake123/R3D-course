<?php

require_once "../core/Core.php";

Connection::getInstance()->prepare("DELETE FROM role WHERE id = :id")->execute([
    ":id" => $_GET["id"]
]);

Url::getInstance()->redirect();