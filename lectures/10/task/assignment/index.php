<?php

function write($value) {
    echo htmlspecialchars($value, ENT_QUOTES);
}

$formSent = !empty($_POST);

$nameValid = false;
$passValid = false;
$passSame = false;

if ($formSent) {
    // Kontrola hodnot
    $nameValid = isset($_POST["name"]) && strlen($_POST["name"]) >= 2;
    $passValid = isset($_POST["password"]) && strlen($_POST["password"]) >= 5;
    $passSame = isset($_POST["password"]) &&
        isset($_POST["passwordAgain"]) &&
        $_POST["password"] === $_POST["passwordAgain"];

    $formValid = $nameValid && $nameAvaliable && $passValid && $passSame;

    if ($formValid) {
        die("form ok");
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>10. cvičení</title>
        <style>
            .formerror {
                display: inline-block;
                padding: 0em 0.5em;
                border: 1px solid rgba(255, 0, 0, 0.5);
                background-color: rgba(255, 0, 0, 0.2);
                border-radius: 4px;
            }
        </style>
    </head>
    <body>
        <h1>Registrační formulář</h1>

        <form
            action=""
            method="POST"
        >
            <div>
                Jmeno:
                <input
                    type="text"
                    name="name"
                    value="<?php if (isset($_POST["name"])) write($_POST["name"]) ?>"
                >

                <?php if ($formSent && !$nameValid) { ?>
                    <div class="formerror">Jméno musí mít alespon 2 znaky</div>
                <?php } else if ($formSent && false) { ?>
                    <div class="formerror">Uživatelské jméno již existuje</div>
                <?php } ?>
            </div>

            <div>
                Heslo:
                <input type="password" name="password">
                <input type="password" name="passwordAgain">

                <?php if ($formSent && !$passValid) { ?>
                    <div class="formerror">Heslo musí mít alespoň 5 znaků.</div>
                <?php } else if ($formSent && !$passSame) { ?>
                    <div class="formerror">Hesla se neshodují.</div>
                <?php } ?>
            </div>

            <br>

            <button type="submit">
                Registrovat
            </button>
        </form>

        <h3>Debug Form data</h3>
        <pre><?php var_dump($_POST); ?></pre>

        <h3>Debug DB data</h3>
        <pre><?php var_dump(null); ?></pre>
    </body>
</html>
