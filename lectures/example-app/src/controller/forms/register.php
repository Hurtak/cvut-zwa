<?php

function controllerFormRegister($form) {
    $username = $form->getRawValue("username");
    if (!$username) {
        $form->errors[] = "usernameEmpty";
    } else if (strlen($username) < 3) {
        $form->errors[] = "usernameTooShort";
    } else {
        $usernameTaken = $form->deps["db"]->userExists($username);
        if ($usernameTaken) {
            $form->errors[] = "usernameTaken";
        }
    }

    $password = $form->getRawValue("password");
    $passwordAgain = $form->getRawValue("passwordAgain");
    if (!$password) {
        $form->errors[] = "passwordEmpty";
    } else if (strlen($password) < 5) {
        $form->errors[] = "passwordTooShort";
    } else if ($password !== $passwordAgain) {
        $form->errors[] = "passwordsDoNotMatch";
    }

    if (!$form->isValid()) {
        return;
    }

    $form->deps["db"]->addUser($username, $password);
    $form->deps["user"]->logIn($username);
    ControllerUtils::redirectAndExit("/users.php");
}
