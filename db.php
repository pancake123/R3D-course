<?php

require "core/Connection.php";

$connection = Connection::getInstance();

$r = $connection->query("SELECT * FROM test");

while (($row = $r->fetch_object()) != null) {
    print $row->id . " - " . $row->name . "<br>";
}