<?php

require_once "../core/Core.php";

Connection::getInstance()->prepare("DELETE FROM privilege WHERE id = :id")->execute([
    ":id" => $_GET["id"]
]);

Url::getInstance()->redirect();