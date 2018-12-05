<?php

require "db.php";

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>10. cvičení</title>
    </head>
    <body>
        <h1>Zaregistrovaní uživatelé</h1>

        <ul>
            <?php foreach ($db->data["users"] as $user) { ?>
                <li>
                    <?php echo $user["username"]; ?>
                </li>
            <?php } ?>
        </ul>

    </body>
</html>
