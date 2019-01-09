<?php

class Form {
    public $deps = [];
    public $request = [];
    public $errors = [];

	public function __construct($options) {
        $this->deps = $options["deps"];
        $this->request = $options["request"];

        $this->csrfProtection();
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
        Filters::writeEscapedValue($rawValue);
    }

    public function isError($errorName) {
        return in_array($errorName, $this->errors);
    }

    public function isValid() {
        return empty($this->errors);
    }

    private function csrfProtection() {
        // https://www.owasp.org/index.php/Cross-Site_Request_Forgery_(CSRF)_Prevention_Cheat_Sheet

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
