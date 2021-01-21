<?php
session_start();
include "../database/sql.php";

if (isset($_SESSION["user_id"])) {
    if (isset($_POST["email"]) && strlen($_POST["email"]) > 0 &&
        isset($_POST["password"]) && strlen($_POST["password"]) > 0) {
            $illegal = "#$%^&*()+=-[]';,/{}|:<>?~";
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) || strpbrk($_POST["email"], $illegal)) {
            $_SESSION["change_email_error"] = "Invalid email syntax";
        } else {
            $bdd = get_connection();
            $stmt = $bdd->prepare("SELECT * FROM users WHERE email='$_POST[email]';");
            $stmt->execute();
            if (($query = $stmt->fetch())) {
                $_SESSION["change_email_error"] = "Email already in use";
            } else {
                if (password_verify($_POST["password"], $_SESSION["db_infos"]["password"])) {
                    $stmt = $bdd->prepare("UPDATE users SET email='$_POST[email]' WHERE id=$_SESSION[user_id];");
                    $stmt->execute();
                    $_SESSION["email_changed"] = "Your email has been updated";
                    unset($_SESSION["user"]);
                    unset($_SESSION["user_id"]);
                    unset($_SESSION["user_mail"]);
                    unset($_SESSION["body_page"]);
                    $_SESSION["account_email"] = $_POST["email"];
                } else {
                    $_SESSION["change_email_error"] = "Invalid password";
                }
            }
        }
    } else {
        $_SESSION["change_email_error"] = "You must enter password & new email";
    }
}
if (isset($_SESSION["change_email_error"])) {
    header('Location: /login/changeMail.php');
} else {
    header('Location: /login/login.php');
}
?>