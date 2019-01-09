<header>
    <nav>
        <a href="<?php echo ROOT_URL ?>/">Login</a>
        <a href="<?php echo ROOT_URL ?>/users.php">Users</a>
    </nav>
    <?php if ($app["user"]->isLoggedIn()) { ?>
        <p>
            Jste prihlasen jako
            <?php $app->filters::writeEscapedValue($app["user"]->loggedUser["username"]) ?>
        </p>

        <form method="POST">
            <?php $app["form"]->writeCsrfToken() ?>
            <input type="hidden" name="form-name" value="logout">
            <button type="submit" name="logout">Logout</button>
        </form>
    <?php } else { ?>
        <p>Nejse prihlasen</p>
    <?php } ?>
</header>
