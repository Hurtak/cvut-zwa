<?php

class User {
	public $loggedUser;
	private $db;

	public function __construct($db) {
		$this->db = $db;

		$loggedUserFromSession = isset($_SESSION["loggedUser"]);
		if ($loggedUserFromSession) {
			$this->logIn($_SESSION["loggedUser"]);
		}
	}

	public function isLoggedIn() {
		return (boolean)$this->loggedUser;
	}

	public function logIn($username) {
		$userExists = $this->db->userExists($username);
		if (!$userExists) {
			throw new Exception("User does not exist");
		}

		$_SESSION["loggedUser"] = $username;
		$userData = $this->db->getUser($username);
		$this->loggedUser = $userData;
	}

	public function logOut() {
		unset($_SESSION["loggedUser"]);
		$this->loggedUser = null;
	}
}
