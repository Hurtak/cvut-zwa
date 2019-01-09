<?php

class ControllerUtils {
    public static function redirectAndExit($path) {
        header("Location: " . ROOT_URL . $path);
        exit();
    }
}