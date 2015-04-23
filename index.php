<?php

require_once "core/Connection.php";
require_once "core/Layout.php";
require_once "core/Session.php";
require_once "core/Url.php";

if (Session::getInstance()->isGuest()) {
    Layout::getInstance()->render("index", "user/view.php");
} else {
    Url::getInstance()->redirect("user/info.php");
}