<?php

function controllerFormLogout($form) {
    if (!$form->deps["user"]->isLoggedIn()) {
        return;
    }

    $form->deps["user"]->logOut();
    ControllerUtils::redirectAndExit("/index.php");
}
