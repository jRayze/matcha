<?php
include "../template/start.php";
?>
<!-- Formulaire demande : Nom, prénom, e-mail, psoeudo, mot de passe sécurisé -->
<body class="bodyRegister">
    <form class="form-register" action="/php/account/create_account.php" method="post">
        <h1>Enregistrez vous !</h1>
        <h5>Discutez avec plusieurs milliers d'utilisateur et faites leurs rencontres !</h5>
        <br >
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputLastName">Nom</label>
                <input name="lastname" type="text" class="form-control" id="inputLastName">
            </div>
            <div class="form-group col-md-6">
                <label for="inputFirstName">Prénom</label>
                <input name="firstname" type="text" class="form-control" id="inputFirstName">
            </div>
        </div>
        <div class="form-group">
                <label for="inputUsername">Identifiant</label>
                <input name="username" type="text" class="form-control" id="inputUsername">
            </div>
        <div class="form-group">
            <label for="inputEmail">Adresse E-mail</label>
            <input name="email" type="email" class="form-control" id="inputEmail" placeholder="name@example.com">
        </div>
        <div class="form-group">
            <label for="inputPassword">Mot de passe</label>
            <input name="password" type="password" id="inputPassword" class="form-control" aria-describedby="passwordHelpBlock">
            <small id="passwordHelpBlock" class="form-text text-muted">
                Votre mot de passe doit contenir entre 8 et 20 caractères, contenir des lettres ainsi que des nombres et au minimum un caractère spécial.
            </small>
        </div>
        <div class="form-group">
        </div>
        <div class="form-group row">
            <div class="col-sm-12">
                <button id="submitButton" disabled type="submit" class="btn btn-primary">S'inscrire</button>
            </div>
        </div>
    </form>
    <script src="/js/register.js"></script>
</body>
<?php
include "../template/end.php";
?>