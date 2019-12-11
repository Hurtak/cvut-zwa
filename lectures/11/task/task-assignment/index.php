<?php

/*
Cookies
    http://php.net/manual/en/features.cookies.php

    Implement persisting of "dark skin activated" state with cookies
        1. If "dark skin" form is sent then
            - If "dark skin" is checked, set cookie to remember the state.
            - If "dark skin" is unchecked, remove cookie.
        2. If "dark skin" form is not sent, look into cookie for previously saved state.
        3. Determine based on cookie or form what skin to set.
        4. Add CSS to change the page skin.

Session:
    http://php.net/manual/en/session.examples.basic.php

    Implement page views counter with sessions
        1. Start session.
        2. If it is first page view create page views counter in session data.
        3. If it is not first page view increment counter.
        4. Display page views on page.
        5. Add form that resets the counter.

Prevent double submit of form:
    P-R-G (POST - Redirect - GET)
*/

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
    <body>
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
            Number of visits: 0
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
