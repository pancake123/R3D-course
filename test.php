<?php
if (is_numeric($_POST["value1"]) && is_numeric($_POST["value2"]) && is_numeric($_POST["value3"])) {
    print($_POST["value1"] + $_POST["value2"] + $_POST["value3"]);
} else {
    print("Baran!");
}


