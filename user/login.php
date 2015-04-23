<?php

require_once("../core/Connection.php");
require_once("../core/Session.php");
require_once("../core/Url.php");

/*
----------------------
- CHECK EMPTY FIELDS -
----------------------
*/

if (empty($_POST["login"])) {
    die("enter login, baran");
}

if (empty($_POST["password"])) {
    die("enter password");
}

/*
---------------------
- SEARCH USER IN DB -
---------------------
*/

$db = Connection::getInstance();

$stmt = $db->prepare("SELECT * FROM user WHERE lower(login) = :login");

$stmt->execute([
    ":login" => strtolower($_POST['login'])
]);

$r = $stmt->fetchObject();

if (!$r || $r->password != md5($_POST["password"])) {
    die("Incorrect user login or password.");
}

/*
---------------
- LOG IN USER -
---------------
*/

Session::getInstance()->login($r->id, $r->login, $r->password);

Url::getInstance()->redirect("");

//$r = $db->query("SELECT * FROM user WHERE lower(login) = lower('{$_POST['login']}')");






