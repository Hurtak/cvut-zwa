<?php

class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
}
