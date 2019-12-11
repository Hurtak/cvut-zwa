<?php

// Cookies
$skinFormSent = isset($_POST["skin"]);
$skinCookieSet = isset($_COOKIE["dark-skin"]);

$darkSkin = false;
if ($skinFormSent) {
    $formDarkSkin = isset($_POST["dark-skin"]);
    if ($formDarkSkin) {
        $minute = 60;
        setcookie("dark-skin", "1", time() + $minute);
    } else {
        if ($skinCookieSet) {
            setcookie("dark-skin", null, time() - 1);
        }
    }
    $darkSkin = $formDarkSkin;

    header("Location: index.php");
    exit();
} else if ($skinCookieSet) {
    $darkSkin = true;
}

// Sessions
session_start();
if (isset($_POST["clear-session"])) {
    session_unset();
    header("Location: index.php");
    exit();
}

if (!isset($_SESSION["counter"])) {
    $_SESSION["counter"] = 0;
}
$_SESSION["counter"] += 1;

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Cookies & Sessions</title>
        <style>
            body.dark-skin {
                background-color: black;
                color: white;
            }
            body.dark-skin button {
                color: black;
                background: lightblue;
            }
        </style>
    </head>
    <body class="<?php if ($darkSkin) echo "dark-skin" ?>">
        <h2>Cookies</h2>
        <form
            action=""
            method="POST"
        >
            <h3>Skin settings</h3>

            <label>
                <input
                    type="checkbox"
                    name="dark-skin"
                    value="1"
                    <?php if ($darkSkin) echo "checked" ?>
                >
                Dark skin
            </label>

            <br>
            <br>

            <button type="submit" name="skin">
                Set
            </button>
        </form>

        <h2>Session</h2>
        <p>
            Number of visits:
            <?php echo $_SESSION["counter"] ?>
        </p>

        <form
            action=""
            method="POST"
        >
            <button type="submit" name="clear-session">
                Clear session
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
