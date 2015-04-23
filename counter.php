<?php

session_start();

$_SESSION["visits"];
if (!isset($_SESSION["visits"])) {
    $_SESSION["visits"] = 1;
} else {
    $_SESSION["visits"]++;
}

print("<pre>");
print_r($_SESSION);
print("</pre>");