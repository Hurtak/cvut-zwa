<?php

require "src/app.php";

$registerFormSent = isset($_POST["register"]);
$nameValid = false;
$nameAvaliable = false;
$passValid = false;
$passSame = false;
if ($registerFormSent) {
    $nameValid = isset($_POST["username"]) && strlen($_POST["username"]) >= 2;
	$nameAvaliable = isset($_POST["username"])
		&& !$db->userExists($_POST["username"]);

    $passValid = isset($_POST["password"]) && strlen($_POST["password"]) >= 5;
    $passSame = isset($_POST["password"]) &&
        isset($_POST["passwordAgain"]) &&
        $_POST["password"] === $_POST["passwordAgain"];

    $formValid = $nameValid && $nameAvaliable && $passValid && $passSame;

    if ($formValid) {
        $db->addUser($_POST["username"], $_POST["password"]);
        $user->logIn($_POST["username"]);
        header("Location: users.php");
        exit();
    }
}

$loginFormSend = isset($_POST["login"]);
$usernameExists = false;
$passwordValid = false;
if ($loginFormSend) {
    $username = $_POST["username"];

    $formUser = $db->getUser($username);
    if ($formUser) {
        $usernameExists = true;
        $passwordValid = password_verify($_POST["password"], $formUser["password"]);

        if ($usernameExists && $passwordValid) {
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
        <title>13. cvičení</title>
        <style>
            .formerror {
                display: inline-block;
                padding: 0em 0.5em;
                border: 1px solid rgba(255, 0, 0, 0.5);
                margin: -1px;
                background-color: rgba(255, 0, 0, 0.2);
                border-radius: 4px;
            }
            .formerror[hidden] {
                display: none;
            }
        </style>
    </head>
    <body>
        <h1>Register/Login</h1>

        <h2>Registrační formulář</h2>

        <form
            action="index.php"
            method="POST"
        >
            <div>
                Jmeno:
                <input
                    type="text"
                    name="username"
                    class="js-username"
                    value="<?php if (isset($_POST["username"])) write($_POST["username"]) ?>"
                >

                <?php if ($registerFormSent && !$nameValid) { ?>
                    <div class="formerror">Jméno musí mít alespon 2 znaky</div>
                <?php } ?>
                <div
                    class="formerror js-username-error"
                    <?php if (!($registerFormSent && !$nameAvaliable)) echo "hidden" ?>
                >
                    Uživatelské jméno již existuje
                </div>

            </div>

            <div>
                Heslo:
                <input type="password" name="password">
                <input type="password" name="passwordAgain">

                <?php if ($registerFormSent && !$passValid) { ?>
                    <div class="formerror">Heslo musí mít alespoň 5 znaků.</div>
                <?php } else if ($registerFormSent && !$passSame) { ?>
                    <div class="formerror">Hesla se neshodují.</div>
                <?php } ?>
            </div>

            <br>

            <button type="submit" name="register">
                Registrovat
            </button>
        </form>

        <h2>Login formulář</h2>

        <form
            action="index.php"
            method="POST"
        >
            <div>
                Jmeno:
                <input
                    type="text"
                    name="username"
                    value="<?php if ($loginFormSend && isset($_POST["username"])) write($_POST["username"]) ?>"
                >

                <?php if ($loginFormSend && !$usernameExists) { ?>
                    <div class="formerror">Uživatelské jméno neexistuje</div>
                <?php } ?>
            </div>

            <div>
                Heslo:
                <input type="password" name="password">

                <?php if ($loginFormSend && $usernameExists && !$passwordValid) { ?>
                    <div class="formerror">Heslo je špatně zadané</div>
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
