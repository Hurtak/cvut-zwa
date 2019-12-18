<?php

require "src/app.php";

$registerFormSent = isset($_POST["register"]);
$nameValid = false;
$nameAvailable = false;
$passValid = false;
$passSame = false;
if ($registerFormSent) {
    $nameValid = isset($_POST["username"]) && strlen($_POST["username"]) >= 2;
    $nameAvailable = isset($_POST["username"])
        && !$db->userExists($_POST["username"]);

    $passValid = isset($_POST["password"]) && strlen($_POST["password"]) >= 5;
    $passSame = isset($_POST["password"]) &&
        isset($_POST["passwordAgain"]) &&
        $_POST["password"] === $_POST["passwordAgain"];

    $formValid = $nameValid && $nameAvailable && $passValid && $passSame;

    if ($formValid) {
        $db->addUser($_POST["username"], $_POST["password"]);
        header("Location: users.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Register/Login</title>
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
        <h1>Register/Login</h1>

        <h2>Register</h2>

        <form
            action=""
            method="POST"
        >
            <div>
                <label>
                    Username:
                    <input
                        type="text"
                        name="username"
                        value="<?php if ($registerFormSent && isset($_POST["username"])) write($_POST["username"]) ?>"
                    >
                </label>

                <?php if ($registerFormSent && !$nameValid) { ?>
                    <div class="form-error">Name needs to be at least 2 characters long</div>
                <?php } else if ($registerFormSent && !$nameAvailable) { ?>
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


                <?php if ($registerFormSent && !$passValid) { ?>
                    <div class="form-error">Password need to be at least 5 characters long.</div>
                <?php } else if ($registerFormSent && !$passSame) { ?>
                    <div class="form-error">Passwords do not match.</div>
                <?php } ?>
            </div>

            <br>

            <button type="submit" name="register">
                Register
            </button>
        </form>

        <h2>Login</h2>

        <form
            action=""
            method="POST"
        >
            <div>
                <label>
                    Username:
                    <input
                        type="text"
                        name="username"
                        value=""
                    >
                </label>

                <?php if (false) { ?>
                    <div class="form-error">Username does not exist</div>
                <?php } ?>
            </div>

            <div>
                <label>
                    Password:
                    <input type="password" name="password">
                </label>

                <?php if (false) { ?>
                    <div class="form-error">Invalid password</div>
                <?php } ?>
            </div>

            <br>

            <button type="submit" name="login">
                Login
            </button>
        </form>

        <h3>Debug Form data</h3>
        <pre><?php var_dump($_POST); ?></pre>

        <h3>Debug DB data</h3>
        <pre><?php var_dump($db->getDebugData()); ?></pre>
    </body>
</html>
