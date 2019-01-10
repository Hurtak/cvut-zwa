<?php

class User {
	private $deps;
	private $loggedUser;

	public function __construct($options) {
		$this->deps = $options["deps"];

		$loggedUserFromSession = isset($_SESSION["loggedUser"]);
		if ($loggedUserFromSession) {
			$username = $_SESSION["loggedUser"];
			if ($this->deps["db"]->userExists($username)) {
				$this->logIn($username);
			} else {
				$this->logOut();
			}
		}
	}

	public function isLoggedIn() {
		return (boolean)$this->loggedUser;
	}

	public function getLoggedUser() {
		return $this->loggedUser;
	}

	public function logIn($username) {
		$userExists = $this->deps["db"]->userExists($username);
		if (!$userExists) {
			throw new Exception("User does not exist");
		}

		$_SESSION["loggedUser"] = $username;
		$userData = $this->deps["db"]->getUser($username);
		$this->loggedUser = $userData;
	}

	public function logOut() {
		unset($_SESSION["loggedUser"]);
		$this->loggedUser = null;
	}
}
