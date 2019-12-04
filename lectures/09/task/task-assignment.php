<?php

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Task assignment</title>
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
                        value=""
                    >
                </label>

                <div class="form-error">Name needs to be at least 2 characters long</div>
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

                <div class="form-error">Password need to be at least 5 characters long.</div>
                <div class="form-error">Passwords do not match.</div>
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
