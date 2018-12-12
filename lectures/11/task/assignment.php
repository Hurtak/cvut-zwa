<?php

/*
    Cookies
        http://php.net/manual/en/features.cookies.php

        Implementace vybrání barevného skinu stránky pomocí cookies
            1. Když byl odeslán formulář s nastavením vzhledu
                - Jestli je nastaven tmavý vzhled, nastavit cookie
                - Jestli byl vypnutý tmavý vzhled, odstranit cookie
            2. Jinak se podívat jestli není nastavena cookie z dřívějška
            3. Dle formuláře nebo cookie se rozhodnout jaký vzhled má být vybrán
            4. Přídat CSS na přepínání vzhledu

    Session:
        http://php.net/manual/en/session.examples.basic.php

        Implementace počítání přístupů na stránku pomocí session
            1. Nastartovat session
            2. V případě že se jedná o první přistup, založit počítadlo v session datech
            3. V případě že se jedná o další přístup, inkrementovat počítadlo
            4. Vypsat počet přístupů na stránku
            5. Přidat formulář který vyresetuje počítadlo

    Zabraneni dvojimu odeslani formulare:
        P-R-G (POST - Redirect - GET)
*/

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>11. cvičení</title>
    </head>
    <body>
        <h1>11. cvičení</h1>

        <h2>Cookies</h2>
        <form
            action=""
            method="POST"
        >
            <h3>Nastavení vzhledu</h3>

            <label>
                <input
                    type="checkbox"
                    name="dark-skin"
                    value="1"
                >
                Tmavy vzhled
            </label>

            <br>
            <br>

            <button type="submit" name="skin">
                Nastavit
            </button>
        </form>

        <h2>Session</h2>
        <p>
            Počet přístupů na stránku:
        </p>

        <form
            action=""
            method="POST"
        >
            <button type="submit" name="clear-session">
                Vymazat session
            </button>
        </form>

        <hr>

        <h3>Debug Form data</h3>
        <pre><?php var_dump($_POST); ?></pre>

        <h3>Debug Cookies data</h3>
        <pre><?php var_dump($_COOKIE); ?></pre>

        <h3>Debug Session data</h3>
        <pre><?php if(isset($_SESSION)) var_dump($_SESSION); ?></pre>
    </body>
</html>
