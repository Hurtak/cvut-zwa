<?php

require "src/app.php";

?>
<!DOCTYPE html>
<html>
    <head>
        <?php require SRC_DIR . "/views/metadata.php" ?>
        <title>Login/Register</title>
    </head>
    <body>
        <?php require SRC_DIR . "/views/header.php" ?>

        <h1>Register/Login</h1>

        <h2>Registrační formulář</h2>

        <form method="POST">
            <?php $form->writeCsrfToken() ?>

            <div>
                Jmeno:
                <input
                    type="text"
                    name="username"
                    class="js-username"
                    value="<?php if ($form->isSubmitted("register")) $form->writeEscapedValue("username") ?>"
                >

                <?php if ($form->isSubmitted("register")) { ?>
                    <?php if ($form->isError("usernameEmpty")) { ?>
                        <div class="formerror">Prosím vyplňte uživatelské jméno</div>
                    <?php } else if ($form->isError("usernameTooShort")) { ?>
                        <div class="formerror">Uživatelské jméno musí mít alespoň 3 znaky</div>
                    <?php } ?>
                <?php } ?>
                <div
                    class="formerror js-username-error"
                    <?php if (!($form->isSubmitted("register") && $form->isError("usernameTaken"))) echo "hidden" ?>
                >
                    Uživatelské jméno již existuje
                </div>

            </div>

            <div>
                Heslo:
                <input type="password" name="password">
                <input type="password" name="passwordAgain">

                <?php if ($form->isSubmitted("register")) { ?>
                    <?php if ($form->isError("passwordEmpty")) { ?>
                        <div class="formerror">Prosím vyplňte heslo</div>
                    <?php } else if ($form->isError("passwordTooShort")) { ?>
                        <div class="formerror">Heslo musí mít alespoň 5 znaků.</div>
                    <?php } else if ($form->isError("passwordsDoNotMatch")) { ?>
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
            <?php $form->writeCsrfToken() ?>

            <div>
                Jmeno:
                <input
                    type="text"
                    name="username"
                    value="<?php if ($form->isSubmitted("login")) $form->writeEscapedValue("username") ?>"
                >

                <?php if ($form->isSubmitted("login")) { ?>
                    <?php if ($form->isError("usernameEmpty")) { ?>
                        <div class="formerror">Prosím vyplňte uživatelské jméno</div>
                    <?php } else if ($form->isError("userDoesNotExist")) { ?>
                        <div class="formerror">Uživatelské jméno neexistuje</div>
                    <?php } ?>
                <?php } ?>
            </div>

            <div>
                Heslo:
                <input type="password" name="password">

                <?php if ($form->isSubmitted("login")) { ?>
                    <?php if ($form->isError("passwordEmpty")) { ?>
                        <div class="formerror">Prosím vyplňte heslo</div>
                    <?php } else if ($form->isError("passwordInvalid")) { ?>
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

        <?php require SRC_DIR . "/views/footer.php" ?>
        <script src="<?php echo STATIC_DIR ?>/username-available.js"></script>
    </body>
</html>
