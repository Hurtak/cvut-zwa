<?php

class Filters {
    public static function escape($value) {
        echo htmlspecialchars($value, ENT_QUOTES);
    }
}
