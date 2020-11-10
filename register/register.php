<?php
include "../template/start.php";
?>
<!-- Formulaire demande : Nom, prénom, e-mail, psoeudo, mot de passe sécurisé -->
<body class="bodyRegister">
    <form class="form-register">
        <h1>Enregistrez vous !</h1>
        <h5>Discutez avec plusieurs milliers d'utilisateur et faites leurs rencontres !</h5>
        <br >
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">Nom</label>
                <input type="email" class="form-control" id="inputEmail4">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Prénom</label>
                <input type="password" class="form-control" id="inputPassword4">
            </div>
        </div>
        <div class="form-group">
                <label for="inputPassword4">Identifiant</label>
                <input type="password" class="form-control" id="inputPassword4">
            </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Adresse E-mail</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
        </div>
        <div class="form-group">
            <label for="inputPassword5">Mot de passe</label>
            <input type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock">
            <small id="passwordHelpBlock" class="form-text text-muted">
            Votre mot de passe doit contenir entre 8 et 20 caractères, contenir des lettres ainsi que des nombres et au minimum un caractère spécial.
            </small>
        </div>
        <div class="form-group">
        </div>
        <div class="form-group row">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary">S'inscrire</button>
            </div>
        </div>
    </form>
</body>
<?php
include "../template/end.php";
?>