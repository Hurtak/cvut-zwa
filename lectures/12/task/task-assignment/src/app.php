<?php

require "db.php";
require "user.php";

function write($value) {
    echo htmlspecialchars($value, ENT_QUOTES);
}

$db = new DB();
$user = new User($db);
