<?php

function controllerFormRegister($deps) {
    $username = $deps["form"]->getValue("username");
    if (!$username) {
        $deps["form"]->addError("usernameEmpty");
    } else if (strlen($username) < 3) {
        $deps["form"]->addError("usernameTooShort");
    } else {
        $usernameTaken = $deps["db"]->userExists($username);
        if ($usernameTaken) {
            $deps["form"]->addError("usernameTaken");
        }
    }

    $password = $deps["form"]->getValue("password");
    $passwordAgain = $deps["form"]->getValue("passwordAgain");
    if (!$password) {
        $deps["form"]->addError("passwordEmpty");
    } else if (strlen($password) < 5) {
        $deps["form"]->addError("passwordTooShort");
    } else if ($password !== $passwordAgain) {
        $deps["form"]->addError("passwordsDoNotMatch");
    }

    if (!$deps["form"]->isValid()) {
        return;
    }

    $deps["db"]->addUser($username, $password);
    $deps["user"]->logIn($username);
    ControllerUtils::redirectAndExit("/users.php");
}
