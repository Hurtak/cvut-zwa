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
        $user->logIn($_POST["username"]);
        header("Location: users.php");
        exit();
    }
}

$loginFormSent = isset($_POST["login"]);
$userExists = false;
$passwordValid = false;
if ($loginFormSent) {
    $username = $_POST["username"];

    $formUser = $db->getUser($username);
    if ($formUser) {
        $userExists = true;
        $passwordValid = password_verify($_POST["password"], $formUser["password"]);

        if ($userExists && $passwordValid) {
            $user->logIn($username);
            header("Location: users.php");
            exit();
        }
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

            [hidden] {
                display: none;
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
                    class="js-username-input"
                    value="<?php if ($registerFormSent && isset($_POST["username"])) write($_POST["username"]) ?>"
                >
                </label>

                <?php if ($registerFormSent && !$nameValid) { ?>
                    <div class="form-error">Name needs to be at least 2 characters long</div>
                <?php } ?>

                <div
                    class="form-error js-username-error"
                    <?php if (!$registerFormSent || $nameAvailable) echo "hidden" ?>
                >
                    Username already exists
                </div>
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
                        value="<?php if ($loginFormSent && isset($_POST["username"])) write($_POST["username"]) ?>"
                >
                </label>

                <?php if ($loginFormSent && !$userExists) { ?>
                    <div class="form-error">Username does not exist</div>
                <?php } ?>
            </div>

            <div>
                <label>
                    Password:
                <input type="password" name="password">
                </label>

                <?php if ($loginFormSent && $userExists && !$passwordValid) { ?>
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

        <script src="./static/username-available.js"></script>
    </body>
</html>
