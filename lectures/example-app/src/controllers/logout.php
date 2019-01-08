<?php

function controllerLogout($form) {
    if (!$form->deps["user"]->isLoggedIn()) {
        return;
    }

    $form->deps["user"]->logOut();
    redirectAndExit("/index.php");
}
