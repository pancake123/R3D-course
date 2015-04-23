<?php

require_once "../core/Session.php";

Session::getInstance()->logout();

header("location: /r3d/", true, 301);