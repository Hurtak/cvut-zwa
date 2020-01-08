<?php

class DB {
	private $data;

	public function __construct() {
		$this->loadData();
	}

	public function addUser($username, $password) {
		if ($this->userExists($username)) {
			throw new Exception("User already exists");
		}

		array_push($this->data["users"], [
			"username" => $username,
			"password" => password_hash($password, PASSWORD_DEFAULT)
		]);
		$this->saveData();
	}

	public function userExists($username) {
		$user = $this->getUser($username);
		return (boolean)$user;
	}

	public function getDebugData() {
		return $this->data;
	}

	public function getUsers() {
		return $this->data["users"];
	}

	public function getUser($username) {
		foreach ($this->data["users"] as $user) {
			if ($user["username"] === $username) {
				return $user;
			}
		}

		return null;
	}

	private function loadData() {
		$fileContent = trim(file_get_contents("db.txt", true));
		if (!$fileContent) {
			$this->data = [
				"users" => []
			];
		} else {
			$this->data = json_decode($fileContent, true);
		}
	}

	private function saveData() {
		file_put_contents("db.txt", json_encode($this->data), FILE_USE_INCLUDE_PATH);
	}
}
