<?php
include "../template/start.php";
session_start();
?>
<body class="bodyLogin">
    <form class="form-signin" action="/php/account/recover_password.php" method="post">
        <label class="error-text">
            <?php
            
            ?>
        </label>
        <label class="success-text">
            <?php
            
            ?>
        </label>
        <h1 class="h3 mb-3 font-weight-normal">Récupérez votre mot de passe.</h1>
        <h5 class="h5 mb-3 font-weight-normal">Veuilez saisir votre adresse mail.</h5>
        <label for="inputEmail" class="sr-only">Adresse E-mail</label>
        <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Adresse E-mail" required autofocus>
        <button class="btn btn-m btn-primary btn-block" id="marge-bot" type="submit">Envoyer</button>
        <a href="/login/login.php">Se connecter</a>
        <p class="mt-5 mb-3 text-muted">© 2020</p>
    </form>
</body>
<?php
include "../template/end.php";
?>