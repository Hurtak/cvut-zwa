<?php

define("ROOT_DOMAIN", "wa.toad.cz");
define("ROOT_URL", "/~hurtapet/example-app");
define("STATIC_DIR", ROOT_URL . "/static");
define("SRC_DIR", __DIR__);

require "utils.php";
require "model/db.php";
require "user.php";
require "form.php";

session_start();

$db = new DB();
$user = new User([
    "deps" => [
        "db" => $db
    ]
]);
$form = new Form([
    "deps" => [
        "db" => $db,
        "user" => $user
    ],
    "request" => $_POST
]);
