<header>
    <nav>
        <a href="<?php echo ROOT_URL ?>/">Login</a>
        <a href="<?php echo ROOT_URL ?>/users.php">Users</a>
    </nav>
    <?php if ($user->isLoggedIn()) { ?>
        <p>
            Jste prihlasen jako
            <?php writeEscapedValue($user->loggedUser["username"]) ?>
        </p>

        <form method="POST">
            <?php $form->writeCsrfToken() ?>
            <input type="hidden" name="form-name" value="logout">
            <button type="submit" name="logout">Logout</button>
        </form>
    <?php } else { ?>
        <p>Nejse prihlasen</p>
    <?php } ?>
</header>
