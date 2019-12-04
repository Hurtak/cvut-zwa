<?php

/*
Tasks:
    - Create DB class
    - Add loadDb method, that reads from db.txt file
        - file_get_contents("db.txt")
        - It there is data, unserialize them
            unserialize($dataString);
        - It there is no data, return empty DB structure
            [
                "users" => []
            ];
    - Add saveDb method, that takes current database state and saves it to db.txt
        serialize($data)
        file_put_contents("db.txt", $dataString)
    - Add userExists method
    - Add addUser method
        - Save passwords hashed
            password_hash($password, PASSWORD_DEFAULT)
*/
