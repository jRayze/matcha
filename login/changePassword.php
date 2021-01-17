<?php
include "../template/start.php";
session_start();
?>
<body class="bodyLogin">
    <form class="form-signin" action="/php/account/recover_password.php" method="post">
        <label class="error-text">
            <?php
                if (isset($_SESSION["recover_password_error"])) {
                    echo $_SESSION["recover_password_error"];
                    unset($_SESSION["recover_password_error"]);
                }
            ?>
        </label>
        <label class="success-text">
            <?php
                if (isset($_SESSION["recover_password_success"])) {
                    echo $_SESSION["recover_password_success"];
                    unset($_SESSION["recover_password_success"]);
                }
            ?>
        </label>
        <h1 class="h3 mb-3 font-weight-normal">Changez votre mot de passe.</h1>
        <h5 class="h5 mb-3 font-weight-normal">Veuilez saisir votre ancien mot de passe.</h5>
        <label for="inputPassword" class="sr-only">Mot de passe</label>
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Mot de passe" required autofocus>
        <br >
        <h5 class="h5 mb-3 font-weight-normal">Veuilez saisir votre nouveau mot de passe.</h5>
        <label for="inputNewPassword" class="sr-only">Nouveau mot de passe</label>
        <input name="newPassword" type="password" id="inputNewPassword" class="form-control" placeholder="Nouveau mot de passe" required autofocus>
        <br >
        <h5 class="h5 mb-3 font-weight-normal">Confirmez votre nouveau mot de passe.</h5>
        <label for="inputNewPasswordConfirm" class="sr-only">Confirmation nouveau mot de passe</label>
        <input name="newPasswordConfirm" type="password" id="inputNewPasswordConfirm" class="form-control" placeholder="Confirmation nouveau mot de passe" required autofocus>
        <br >
        <button class="btn btn-m btn-primary btn-block" id="marge-bot" type="submit">Envoyer</button>
        <a href="/login/login.php">Retour à la page d'accueil</a>
        <p class="mt-5 mb-3 text-muted">© 2020</p>
    </form>
</body>
<?php
include "../template/end.php";
?>