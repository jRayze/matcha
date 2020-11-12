<?php
include "../template/start.php";
session_start();

if (!isset($_GET["key"]) || !isset($_GET["username"])) {
    $_SESSION["reset_password_url_error"] = "Invalid URL";
}

?>
<body class="bodyLogin">
    <form class="form-signin" action="/php/account/change_password.php" method="post">
        <label class="error-text">
            <?php
                if (isset($_SESSION["reset_password_url_error"])) {
                    echo $_SESSION["reset_password_url_error"];
                } else if (isset($_SESSION["reset_password_error"])) {
                    echo $_SESSION["reset_password_error"];
                    unset($_SESSION["reset_password_error"]);
                }
            ?>
        </label>
        <label class="success-text">
            <?php
            ?>
        </label>
        <input name="username" type="hidden" value="<?php
        if (!isset($_SESSION["reset_password_url_error"])) {
            echo $_GET["username"];
        }
        ?>">
        <input name="key" type="hidden" value="<?php
        if (!isset($_SESSION["reset_password_url_error"])) {
            echo $_GET["key"];
        }
        ?>">
        <h5 class="h5 mb-3 font-weight-normal">Veuilez saisir votre nouveau mot de passe.</h5>
        <label for="inputEmail" class="sr-only">Mot de passe</label>
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Mot de passe" required autofocus
        <?php
            if (isset($_SESSION["reset_password_url_error"])) {
                echo "disabled";
            }
        ?>
        >

        <br>
        <h5 class="h5 mb-3 font-weight-normal">Confirmation nouveau mot de passe.</h5>
        <label for="inputEmail" class="sr-only">Mot de passe</label>
        <input name="confirmPassword" type="password" id="inputConfirmPassword" class="form-control" placeholder="Mot de passe" required autofocus
        <?php
            if (isset($_SESSION["reset_password_url_error"])) {
                echo "disabled";
            }
        ?>>
        <br>
        <button class="btn btn-m btn-primary btn-block" id="marge-bot" type="submit"
        <?php
            if (isset($_SESSION["reset_password_url_error"])) {
                echo "disabled";
                unset($_SESSION["reset_password_url_error"]);
            }
        ?>
        >Envoyer</button>
        <a href="/login/login.php">Se connecter</a>
        <p class="mt-5 mb-3 text-muted">© 2020</p>
    </form>
</body>
<?php
include "../template/end.php";
?>