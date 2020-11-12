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
            if (isset($_SESSION["account_created"]) && $_SESSION["account_created"] === true) {
                echo "Account created! Check your emails";
                unset($_SESSION["account_created"]);
            }
            ?>
        </label>
        <h5 class="h5 mb-3 font-weight-normal">Veuilez saisir votre nouveau mot de passe.</h5>
        <label for="inputEmail" class="sr-only">Mot de passe</label>
        <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Adresse E-mail" required autofocus>

        <br >
        <h5 class="h5 mb-3 font-weight-normal">Confirmation nouveau mot de passe.</h5>
        <label for="inputEmail" class="sr-only">Mot de passe</label>
        <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Adresse E-mail" required autofocus">
        <button class="btn btn-m btn-primary btn-block" id="marge-bot" type="submit">Envoyer</button>
        <p class="mt-5 mb-3 text-muted">© 2020</p>
    </form>
</body>
<?php
include "../template/end.php";
?>