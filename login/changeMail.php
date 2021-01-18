<?php
include "../template/start.php";
session_start();
?>
<body class="bodyLogin">
    <form class="form-signin" action="/php/account/change_email.php" method="post">
        <label class="error-text">
            <?php
                if (isset($_SESSION["change_email_error"])) {
                    echo $_SESSION["change_email_error"];
                    unset($_SESSION["change_email_error"]);
                }
            ?>
        </label>
        <h1 class="h3 mb-3 font-weight-normal">Changez votre adresse mail.</h1>
        <h5 class="h5 mb-3 font-weight-normal">Veuilez saisir votre mot de passe.</h5>
        <label for="inputPassword" class="sr-only">Mot de passe</label>
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Mot de passe" required autofocus>
        <br >
        <h5 class="h5 mb-3 font-weight-normal">Veuilez saisir votre nouvelle adresse mail.</h5>
        <label for="inputNewEmail" class="sr-only">Adresse E-mail</label>
        <input name="email" type="email" id="inputNewEmail" class="form-control" placeholder="Nouvelle adresse mail" required autofocus>
        <br >
        <button class="btn btn-m btn-primary btn-block" id="marge-bot" type="submit">Envoyer</button>
        <a href="/login/login.php">Retour à la page d'accueil</a>
        <p class="mt-5 mb-3 text-muted">© 2020</p>
    </form>
</body>
<?php
include "../template/end.php";
?>