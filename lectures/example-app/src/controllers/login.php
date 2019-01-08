<?php

function controllerLogin($form) {
    $username = $form->getRawValue("username");
    if (!$username) {
        $form->errors[] = "usernameEmpty";
    }

    $password = $form->getRawValue("password");
    if (!$password) {
        $form->errors[] = "passwordEmpty";
    }

    if (!$form->isValid()) {
        return;
    }

    $dbUser = $form->deps["db"]->getUser($username);
    if (!$dbUser) {
        $form->errors[] = "userDoesNotExist";
        return;
    }

    $passwordValid = password_verify($password, $dbUser["password"]);
    if (!$passwordValid) {
        $form->errors[] = "passwordInvalid";
        return;
    }

    $form->deps["user"]->logIn($username);
    redirectAndExit("/users.php");
}