<?php

require "src/app.php";

// Pagination
$users = $db->getUsers();

$itemsPerPage = 5;
$pageMin = 1;
$pageMax = (int)max(ceil((count($users) / $itemsPerPage)), 1);

$pageSelected = isset($_GET["page"]) ? (int)$_GET["page"] : $pageMin;
if ($pageSelected < $pageMin) {
    $pageSelected = $pageMin;
} else if ($pageSelected > $pageMax) {
    $pageSelected = $pageMax;
}

$usersSliced = array_slice($users, ($pageSelected - 1) * $itemsPerPage, $itemsPerPage);

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Uživatelé</title>
    </head>
    <body>
        <?php require SRC_DIR . "/views/header.php" ?>

        <h1>Zaregistrovaní uživatelé</h1>

        <ul>
            <?php foreach ($usersSliced as $user) { ?>
                <li>
                    <?php writeEscapedValue($user["username"]) ?>
                </li>
            <?php } ?>
        </ul>

        <?php if ($pageMax > 1) { ?>
            <?php for ($pageCurrent = $pageMin; $pageCurrent <= $pageMax; $pageCurrent++) { ?>
                <?php if ($pageSelected === $pageCurrent) { ?>
                    <span><?php echo $pageCurrent ?></span>
                <?php } else { ?>
                    <a href="?page=<?php echo $pageCurrent ?>"><?php echo $pageCurrent ?></a>
                <?php } ?>
            <?php } ?>
        <?php } ?>

        <?php require SRC_DIR . "/views/footer.php" ?>
    </body>
</html>
