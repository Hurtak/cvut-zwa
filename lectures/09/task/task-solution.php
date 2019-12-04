<?php

// Writes HTML escaped value into the page
function escape($value) {
    echo htmlspecialchars($value, ENT_QUOTES);
}

$formSend = !empty($_POST);
$nameValid = false;
$passValid = false;
$passSame = false;
if ($formSend) {
    // Validate form data
    $nameValid = isset($_POST["name"]) && strlen($_POST["name"]) >= 2;
    $passValid = isset($_POST["password"]) && strlen($_POST["password"]) >= 5;
    $passSame = isset($_POST["password"]) && isset($_POST["passwordAgain"]) && $_POST["password"] === $_POST["passwordAgain"];

    $formValid = $nameValid && $passValid && $passSame;

    if ($formValid) {
        die("Form is valid.");
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Task solution</title>
        <style>
            .form-error {
                display: inline-block;
                padding: 0 0.5em;
                border: 1px solid rgba(255, 0, 0, 0.5);
                background-color: rgba(255, 0, 0, 0.2);
                border-radius: 4px;
            }
        </style>
    </head>
    <body>
        <h1>Register</h1>

        <form
            action=""
            method="POST"
        >
            <div>
                <label>
                    Name:
                    <input
                        type="text"
                        name="name"
                        value="<?php if (isset($_POST["name"])) escape($_POST["name"]) ?>"
                    >
                </label>

                <?php if ($formSend && !$nameValid) { ?>
                    <div class="form-error">Name needs to be at least 2 characters long</div>
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

                <?php if ($formSend && !$passValid) { ?>
                    <div class="form-error">Password need to be at least 5 characters long.</div>
                <?php } else if ($formSend && !$passSame) { ?>
                    <div class="form-error">Passwords do not match.</div>
                <?php } ?>
            </div>

            <br>

            <button type="submit">
                Register
            </button>
        </form>

        <h3>Debug data</h3>
        <pre><?php var_dump($_POST); ?></pre>
    </body>
</html>
