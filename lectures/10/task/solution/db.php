<?php

class DB {
    public $data;

    public function __construct() {
        $this->loadDb();
    }

    public function userExists($userName) {
        foreach ($this->data["users"] as $user) {
            if ($user["username"] === $userName) {
                return true;
            }
        }
        return false;
    }

    public function addUser($userName, $password) {
        if ($this->userExists($this->data, $userName)) return;

        array_push($this->data["users"], [
            "username" => $userName,
            "password" => password_hash($password, PASSWORD_DEFAULT)
        ]);
        $this->saveDb();
    }

    private function loadDb() {
        $savedData = file_get_contents("db.txt");
        if (!$savedData) {
            $this->data = [
                "users" => []
            ];
        } else {
            $this->data = unserialize($savedData);
        }
    }

    private function saveDb() {
        file_put_contents("db.txt", serialize($this->data));
    }
}

$db = new DB();
