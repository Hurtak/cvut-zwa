<?php

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
                        value=""
                    >
                </label>

                <div class="formerror">Jméno musí mít alespon 2 znaky</div>
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

                <div class="formerror">Heslo musí mít alespoň 5 znaků.</div>
                <div class="formerror">Hesla se neshodují.</div>
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
