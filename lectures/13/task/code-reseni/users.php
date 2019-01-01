<?php

require "src/app.php";

$logoutFormSend = isset($_POST["logout"]);
if ($logoutFormSend) {
    $user->logOut();
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>13. cvičení</title>
    </head>
    <body>
        <h1>Zaregistrovaní uživatelé</h1>

        <header>
            <?php if ($user->isLoggedIn()) { ?>
                <p>
                    Jste prihlasen jako
                    <?php write($user->loggedUser["username"]) ?>
                </p>
                <form action="users.php" method="POST">
                    <button type="submit" name="logout">Logout</button>
                </form>
            <?php } else { ?>
                <p>Nejse prihlasen</p>
            <?php } ?>
        <header>

        <ul>
            <?php foreach ($db->getUsers() as $user) { ?>
                <li><?php echo $user["username"] ?></li>
            <?php } ?>
        </ul>

    </body>
</html>
