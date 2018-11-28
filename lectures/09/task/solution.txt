<?php

// Vypise escapovanou hodnotu do stranky
function escape($value) {
    echo htmlspecialchars($value, ENT_QUOTES);
}

$formSend = !empty($_POST);
$nameValid = false;
$passValid = false;
$passSame = false;
if ($formSend) {
    // Kontrola hodnot
    $nameValid = isset($_POST["name"]) && strlen($_POST["name"]) >= 2;
    $passValid = isset($_POST["password"]) && strlen($_POST["password"]) >= 5;
    $passSame = isset($_POST["password"]) && isset($_POST["passwordAgain"]) && $_POST["password"] === $_POST["passwordAgain"];

    $formValid = $nameValid && $passValid && $passSame;

    if ($formValid) {
        die("Formulář je validní.");
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>9. cvičení</title>
        <style>
            .formerror {
                display: inline-block;
                padding: 0 0.5em;
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
                <label>
                    Jmeno:
                    <input
                        type="text"
                        name="name"
                        value="<?php if (isset($_POST["name"])) escape($_POST["name"]) ?>"
                    >
                </label>

                <?php if ($formSend && !$nameValid) { ?>
                    <div class="formerror">Jméno musí mít alespon 2 znaky</div>
                <?php } ?>
            </div>
            <div>
                <label>
                    Heslo:
                    <input type="password" name="password">
                </label>
                <label>
                    Heslo znovu:
                    <input type="password" name="passwordAgain">
                </label>

                <?php if ($formSend && !$passValid) { ?>
                    <div class="formerror">Heslo musí mít alespoň 5 znaků.</div>
                <?php } else if ($formSend && !$passSame) { ?>
                    <div class="formerror">Hesla se neshodují.</div>
                <?php } ?>
            </div>

            <br>

            <button type="submit">
                Registrovat
            </button>
        </form>

        <h3>Debug data</h3>
        <pre><?php var_dump($_POST); ?></pre>
    </body>
</html>
