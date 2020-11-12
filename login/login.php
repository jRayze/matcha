<?php
include "../template/start.php";
session_start();
?>
<body class="bodyLogin">
    <form class="form-signin" action="/php/account/login_account.php" method="post">
        <label class="error-text">
            <?php
            if (isset($_SESSION["login_error"])) {
                echo $_SESSION["login_error"];
                unset($_SESSION["login_error"]);
            }
            ?>
        </label>
        <label class="success-text">
            <?php
            if (isset($_SESSION["password_updated"])) {
                echo $_SESSION["password_updated"];
                unset($_SESSION["password_updated"]);
            }
            if (isset($_SESSION["account_created"]) && $_SESSION["account_created"] === true) {
                echo "Account created! Check your emails";
                unset($_SESSION["account_created"]);
            }
            ?>
        </label>
        <h1 class="h3 mb-3 font-weight-normal">Connexion</h1>
        <label for="inputEmail" class="sr-only">Adresse E-mail</label>
        <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Adresse E-mail" required autofocus value="<?php
            if (isset($_SESSION["account_email"])) {
                echo $_SESSION["account_email"];
                unset($_SESSION["account_email"]);
            }
        ?>">
        <label for="inputPassword" class="sr-only">Mot de Passe</label>
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Mot de passe" required>
        <button class="btn btn-m btn-primary btn-block" id="marge-bot" type="submit">Se connecter</button>
        <a href="/login/recoverPassword.php">Mot de passe oublié ?</a>
        <br >
        <a href="/register/register.php">S'inscrire</a>
        <p class="mt-5 mb-3 text-muted">© 2020</p>
    </form>
</body>
<?php
include "../template/end.php";
?>