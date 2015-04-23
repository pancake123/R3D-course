<?php

require_once "../core/Session.php";

Session::getInstance()->logout();

header("location: /nastya/", true, 301);