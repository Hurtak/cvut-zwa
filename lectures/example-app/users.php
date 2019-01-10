<?php

require "src/app.php";

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Uživatelé</title>
    </head>
    <body>
        <?php require SRC_DIR . "/view/header.php" ?>

        <h1>Zaregistrovaní uživatelé</h1>

        <ul>
            <?php foreach ($app->page["usersSliced"] as $user) { ?>
                <li>
                    <?php $app->filters::escape($user["username"]) ?>
                </li>
            <?php } ?>
        </ul>

        <?php if ($app->page["pageMax"] > 1) { ?>
            <?php for ($page = $app->page["pageMin"]; $page <= $app->page["pageMax"]; $page++) { ?>
                <?php if ($app->page["pageSelected"] === $page) { ?>
                    <span><?php echo $page ?></span>
                <?php } else { ?>
                    <a href="?page=<?php echo $page ?>"><?php echo $page ?></a>
                <?php } ?>
            <?php } ?>
        <?php } ?>

        <?php require SRC_DIR . "/view/footer.php" ?>
    </body>
</html>
