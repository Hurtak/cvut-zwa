<?php

require "db.php";

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Task solution</title>
    </head>
    <body>
        <h1>Registered users</h1>

        <ul>
            <?php foreach ($db->data["users"] as $user) { ?>
                <li>
                    <?php echo $user["username"]; ?>
                </li>
            <?php } ?>
        </ul>

    </body>
</html>
