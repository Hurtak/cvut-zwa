<?php

function controllerFormLogout($deps) {
    if (!$deps["user"]->isLoggedIn()) {
        return;
    }

    $deps["user"]->logOut();
    ControllerUtils::redirectAndExit("/index.php");
}
