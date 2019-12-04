<?php

require "db.php";

function write($value) {
    echo htmlspecialchars($value, ENT_QUOTES);
}

$formSent = !empty($_POST);

$nameValid = false;
$nameAvailable = false;
$passValid = false;
$passSame = false;

if ($formSent) {
    $nameValid = isset($_POST["name"]) && strlen($_POST["name"]) >= 2;
    $nameAvailable = isset($_POST["name"]) && !$db->userExists($_POST["name"]);
    $passValid = isset($_POST["password"]) && strlen($_POST["password"]) >= 5;
    $passSame = isset($_POST["password"]) &&
        isset($_POST["passwordAgain"]) &&
        $_POST["password"] === $_POST["passwordAgain"];

    $formValid = $nameValid && $nameAvailable && $passValid && $passSame;

    if ($formValid) {
        $db->addUser($_POST["name"], $_POST["password"]);
        header("Location: users.php");
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Task solution</title>
        <style>
            .form-error {
                display: inline-block;
                padding: 0em 0.5em;
                border: 1px solid rgba(255, 0, 0, 0.5);
                background-color: rgba(255, 0, 0, 0.2);
                border-radius: 4px;
            }
        </style>
    </head>
    <body>
        <h1>Register</h1>

        <form
            action=""
            method="POST"
        >
            <div>
                <label>
                    Name:
                    <input
                        type="text"
                        name="name"
                        value="<?php if (isset($_POST["name"])) escape($_POST["name"]) ?>"
                    >
                </label>

                <?php if ($formSent && !$nameValid) { ?>
                    <div class="form-error">Name needs to be at least 2 characters long</div>
                <?php } else if ($formSent && !$nameAvailable) { ?>
                    <div class="form-error">Username already exists</div>
                <?php } ?>
            </div>
            <div>
                <label>
                    Password:
                    <input type="password" name="password">
                </label>
                <label>
                    Password again:
                    <input type="password" name="passwordAgain">
                </label>

                <?php if ($formSent && !$passValid) { ?>
                    <div class="form-error">Password need to be at least 5 characters long.</div>
                <?php } else if ($formSent && !$passSame) { ?>
                    <div class="form-error">Passwords do not match.</div>
                <?php } ?>
            </div>

            <br>

            <button type="submit">
                Register
            </button>
        </form>

        <h3>Debug data</h3>
        <pre><?php var_dump($_POST); ?></pre>

        <h3>Debug DB data</h3>
        <pre><?php var_dump($db->data); ?></pre>
    </body>
</html>
