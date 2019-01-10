<?php

function getDataForPageUsers($deps) {
    $users = $deps["db"]->getUsers();

    $itemsPerPage = 5;
    $pageMin = 1;
    $pageMax = (int)max(ceil(count($users) / $itemsPerPage), 1);

    $pageSelected = isset($_GET["page"]) ? (int)$_GET["page"] : $pageMin;
    if ($pageSelected < $pageMin) {
        $pageSelected = $pageMin;
    } else if ($pageSelected > $pageMax) {
        $pageSelected = $pageMax;
    }

    $usersSliced = array_slice($users, ($pageSelected - 1) * $itemsPerPage, $itemsPerPage);

    return [
        "itemsPerPage" => $itemsPerPage,
        "pageMin" => $pageMin,
        "pageMax" => $pageMax,
        "pageSelected" => $pageSelected,
        "usersSliced" => $usersSliced
    ];
}
