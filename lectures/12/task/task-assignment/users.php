<?php

require "src/app.php";

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Users</title>
    </head>
    <body>
        <h1>Registered users</h1>

        <header>
            <?php if (false) { ?>
                <p>
                    Logged in as:
                    xxx
                </p>
                <form action="" method="POST">
                    <button type="submit" name="logout">Logout</button>
                </form>
            <?php } else { ?>
                <p>Not logged in</p>
            <?php } ?>
        <header>

        <ul>
            <?php foreach ($db->getUsers() as $user) { ?>
                <li><?php echo $user["username"] ?></li>
            <?php } ?>
        </ul>

    </body>
</html>
