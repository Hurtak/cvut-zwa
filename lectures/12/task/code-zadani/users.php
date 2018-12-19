<?php

require "src/app.php";

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>12. cvičení</title>
    </head>
    <body>
        <h1>Zaregistrovaní uživatelé</h1>

        <header>
            <?php if (false) { ?>
                <p>
                    Jste prihlasen jako: xxx
                </p>
                <form action="" method="POST">
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
