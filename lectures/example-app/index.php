<?php

require "src/app.php";

?>
<!DOCTYPE html>
<html>
    <head>
        <?php require SRC_DIR . "/view/metadata.php" ?>
        <title>Login/Register</title>
    </head>
    <body>
        <?php require SRC_DIR . "/view/header.php" ?>

        <h1>Register/Login</h1>

        <h2>Registrační formulář</h2>

        <form method="POST">
            <?php $app->form->writeCsrfToken() ?>

            <div>
                Jmeno:
                <input
                    type="text"
                    name="username"
                    class="js-username"
                    value="<?php if ($app->form->isSubmitted("register")) $app->form->writeEscapedValue("username") ?>"
                >

                <?php if ($app->form->isSubmitted("register")) { ?>
                    <?php if ($app->form->isError("usernameEmpty")) { ?>
                        <div class="formerror">Prosím vyplňte uživatelské jméno</div>
                    <?php } else if ($app->form->isError("usernameTooShort")) { ?>
                        <div class="formerror">Uživatelské jméno musí mít alespoň 3 znaky</div>
                    <?php } ?>
                <?php } ?>
                <div
                    class="formerror js-username-error"
                    <?php if (!($app->form->isSubmitted("register") && $app->form->isError("usernameTaken"))) echo "hidden" ?>
                >
                    Uživatelské jméno již existuje
                </div>

            </div>

            <div>
                Heslo:
                <input type="password" name="password">
                <input type="password" name="passwordAgain">

                <?php if ($app->form->isSubmitted("register")) { ?>
                    <?php if ($app->form->isError("passwordEmpty")) { ?>
                        <div class="formerror">Prosím vyplňte heslo</div>
                    <?php } else if ($app->form->isError("passwordTooShort")) { ?>
                        <div class="formerror">Heslo musí mít alespoň 5 znaků.</div>
                    <?php } else if ($app->form->isError("passwordsDoNotMatch")) { ?>
                        <div class="formerror">Hesla se neshodují.</div>
                    <?php } ?>
                <?php } ?>
            </div>

            <br>

            <input type="hidden" name="form-name" value="register">

            <button type="submit">
                Registrovat
            </button>
        </form>

        <h2>Login formulář</h2>

        <form method="POST">
            <?php $app->form->writeCsrfToken() ?>

            <div>
                Jmeno:
                <input
                    type="text"
                    name="username"
                    value="<?php if ($app->form->isSubmitted("login")) $app->form->writeEscapedValue("username") ?>"
                >

                <?php if ($app->form->isSubmitted("login")) { ?>
                    <?php if ($app->form->isError("usernameEmpty")) { ?>
                        <div class="formerror">Prosím vyplňte uživatelské jméno</div>
                    <?php } else if ($app->form->isError("userDoesNotExist")) { ?>
                        <div class="formerror">Uživatelské jméno neexistuje</div>
                    <?php } ?>
                <?php } ?>
            </div>

            <div>
                Heslo:
                <input type="password" name="password">

                <?php if ($app->form->isSubmitted("login")) { ?>
                    <?php if ($app->form->isError("passwordEmpty")) { ?>
                        <div class="formerror">Prosím vyplňte heslo</div>
                    <?php } else if ($app->form->isError("passwordInvalid")) { ?>
                        <div class="formerror">Heslo je špatně zadané</div>
                    <?php } ?>
                <?php } ?>
            </div>

            <br>

            <input type="hidden" name="form-name" value="login">

            <button type="submit">
                Login
            </button>
        </form>

        <?php require SRC_DIR . "/view/footer.php" ?>
        <script src="<?php echo STATIC_DIR ?>/username-available.js"></script>
    </body>
</html>
