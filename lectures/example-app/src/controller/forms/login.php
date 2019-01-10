<?php

function controllerFormLogin($deps) {
    $username = $deps["form"]->getValue("username");
    if (!$username) {
        $deps["form"]->addError("usernameEmpty");
    }

    $password = $deps["form"]->getValue("password");
    if (!$password) {
        $deps["form"]->addError("passwordEmpty");
    }

    if (!$deps["form"]->isValid()) {
        return;
    }

    $dbUser = $deps["db"]->getUser($username);
    if (!$dbUser) {
        $deps["form"]->addError("userDoesNotExist");
        return;
    }

    $passwordValid = password_verify($password, $dbUser["password"]);
    if (!$passwordValid) {
        $deps["form"]->addError("passwordInvalid");
        return;
    }

    $deps["user"]->logIn($username);
    ControllerUtils::redirectAndExit("/users.php");
}