<?php

session_start();
require "db.php";

function write($value) {
    echo htmlspecialchars($value, ENT_QUOTES);
}

$db = new DB();

