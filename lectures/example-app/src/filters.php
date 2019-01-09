<?php

class Filters {
    public static function writeEscapedValue($value) {
        echo htmlspecialchars($value, ENT_QUOTES);
    }
}

