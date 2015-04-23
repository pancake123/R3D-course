<?php

require_once("../core/Connection.php");
require_once("../core/Session.php");

/**
 * That function loads a list of alerts for current session
 * and adds a new message with it's text and type
 * @param string $message - Message to display
 * @param string $type - Bootstrap alert type (default danger)
 */
function setMessage($message, $type = "danger") {
    $alerts = Session::getInstance()->get("alerts", []);
    $alerts[] = [
        "message" => $message,
        "type" => $type
    ];
    Session::getInstance()->set("alerts", $alerts);
}

/**
 * That function loads an array of alerts and if its count is above 0,
 * it redirects user to main page and terminates script execution
 * @param bool $redirect - Shall function redirects user to main page
 */
function showMessages($redirect = true) {
    $alerts = Session::getInstance()->get("alerts", []);
    if (!count($alerts)) {
        return ;
    }
    if ($redirect) {
        header("Location: /nastya", true, 301);
    }
    die();
}

// Reset list of alerts
Session::getInstance()->set("alerts", []);

/*
----------------------
- CHECK EMPTY FIELDS -
----------------------
*/

if (empty($_POST["login"])) {
    setMessage("Введите логин");
}
if (empty($_POST["password"]) || empty($_POST["repeat-password"])) {
    setMessage("Введите пароль");
}
if (empty($_POST["surname"])) {
    setMessage("Введите фамилию");
}
if (empty($_POST["name"])) {
    setMessage("Введите имя");
}
if (empty($_POST["patronymic"])) {
    setMessage("Введите отчество");
}

showMessages();

/*
------------------------------
- CHECK PASSWORDS CONFORMITY -
------------------------------
*/

if ($_POST["password"] != $_POST["repeat-password"]) {
    setMessage("Пароли не совпадают");
}

$hash = md5($_POST["password"]);

showMessages();

/*
-----------------------
- REGISTER USER IN DB -
-----------------------
*/

$db = Connection::getInstance();

$r = $db->prepare("SELECT * FROM user WHERE lower(login) = :login");

$r->execute([
    ":login" => strtolower($_POST['login'])
]);

if ($r->fetchObject() != null) {
    setMessage("Пользователь с таким логином уже существует \"{$_POST["login"]}\"");
}

showMessages();

$r = $db->prepare("INSERT INTO user (login, password, surname, name, patronymic, role_id) VALUES (
  :login, :password, :surname, :name, :patronymic, 'user'
)");

$r->execute([
    ":login" => $_POST["login"],
    ":password" => $hash,
    ":surname" => $_POST["surname"],
    ":name" => $_POST["name"],
    ":patronymic" => $_POST["patronymic"],
]);

setMessage("Пользователь успешно зарегистрирован", "success");
showMessages();