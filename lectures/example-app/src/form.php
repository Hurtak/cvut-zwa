<?php

require SRC_DIR . "/controllers/login.php";
require SRC_DIR . "/controllers/logout.php";
require SRC_DIR . "/controllers/register.php";

class Form {
    public $deps = [];
    public $request = [];
    public $errors = [];

	public function __construct($options) {
        $this->deps = $options["deps"];
        $this->request = $options["request"];

        $this->csrfProtection();

        if ($this->isSubmitted("login")) {
            controllerLogin($this);
        } else if ($this->isSubmitted("logout")) {
            controllerLogout($this);
        } else if ($this->isSubmitted("register")) {
            controllerRegister($this);
        } else if (!empty($this->request)) {
            throw new Exception("Unknown form submitted");
        }
    }

    public function isSubmitted($formName) {
        return isset($this->request["form-name"]) &&
            $this->request["form-name"] === $formName;
    }

    public function getRawValue($key) {
        return isset($this->request[$key]) ? $this->request[$key] : null;
    }

    public function writeEscapedValue($key) {
        $rawValue = $this->getRawValue($key);
        if (!$rawValue) {
            return "";
        }
        writeEscapedValue($rawValue);
    }

    public function isError($errorName) {
        return in_array($errorName, $this->errors);
    }

    public function isValid() {
        return empty($this->errors);
    }

    private function csrfProtection() {
        // Set CSRF token if there is not any
        if (!isset($_SESSION["csrf"])) {
            $_SESSION["csrf"] = bin2hex(openssl_random_pseudo_bytes(16));
        }

        // Only check state changing requests
        if ($_SERVER['REQUEST_METHOD'] !== "POST") {
            return;
        }

        // Rererer check
        $requestHeaders = getallheaders();
        if (isset($requestHeaders["Referer"])) {
            $referrerOk = parse_url($requestHeaders["Referer"])["host"] === ROOT_DOMAIN;
            if (!$referrerOk) {
                die("request referrer is from different domain");
            }
        }

        // Csrf token check
        if (!isset($_POST["csrf"])) {
            die("csrf token missing");
        }

        if ($_SESSION["csrf"] !== $_REQUEST["csrf"]) {
            die("csrf tokens do not match");
        }
    }

    public static function writeCsrfToken() {
        echo '<input type="hidden" name="csrf" value="' . $_SESSION["csrf"] . '">';
    }
}
