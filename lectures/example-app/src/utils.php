<?php

function writeEscapedValue($value) {
    echo htmlspecialchars($value, ENT_QUOTES);
}

function redirectAndExit($path) {
    header("Location: " . ROOT_URL . $path);
    exit();
}
