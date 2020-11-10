<?php
include "../template/start.php";
?>
<body class="bodyLogin">
    <form class="form-signin">
        <h1 class="h3 mb-3 font-weight-normal">Connexion</h1>
        <label for="inputEmail" class="sr-only">Adresse E-mail</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Adresse E-mail" required autofocus>
        <label for="inputPassword" class="sr-only">Mot de Passe</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Mot de passe" required>
        <button class="btn btn-m btn-primary btn-block" type="submit">Se connecter</button>
        <a href="#">Mot de passe oublié ?</a>
        <br >
        <a href="/register/register.php">S'inscrire</a>
        <p class="mt-5 mb-3 text-muted">© 2020</p>
    </form>
</body>
<?php
include "../template/end.php";
?>