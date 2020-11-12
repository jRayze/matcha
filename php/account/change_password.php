<?php
session_start();
include "../database/sql.php";

if (!isset($_POST["username"]) || !isset($_POST["key"]) || !isset($_POST["password"]) || !isset($_POST["confirmPassword"])) {
    $_SESSION["reset_password_error"] = "Invalid input";
} else {
    if ($_POST["password"] !== $_POST["confirmPassword"]) {
        $_SESSION["reset_password_error"] = "Passwords don't match";
    } else {
        if (strlen($_POST["password"]) < 8 || strlen($_POST["password"]) > 20) {
            $_SESSION["reset_password_error"] = "Password length must be between 8 and 20";
        } else if (!preg_match('/[a-zA-Z]/', $_POST["password"])) {
            $_SESSION["reset_password_error"] = "Password must contain at least 1 letter";
        } else if (!preg_match('/\d/', $_POST["password"])) {
            $_SESSION["reset_password_error"] = "Password must contain at least 1 number";
        } else if (!preg_match('/[^a-zA-Z\d]/', $_POST["password"])) {
            $_SESSION["reset_password_error"] = "Password must contain at least 1 special character";
        } else {
            $bdd = get_connection();
            $stmt = $bdd->prepare("SELECT * FROM users WHERE username='$_POST[username]';");
            $stmt->execute();
            if (($query = $stmt->fetch())) {
                
                if ($query["password_recovery_url"] === $_POST["key"]) {
                    $hashed_pass = password_hash($_POST["password"], PASSWORD_DEFAULT);
                    $stmt = $bdd->prepare("UPDATE users SET password='$hashed_pass',password_recovery_url='' WHERE username='$_POST[username]';");
                    $stmt->execute();
                    $_SESSION["password_updated"] = "Your password has been changed";
                } else {
                    $_SESSION["reset_password_error"] = "Invalid key url";
                }
            } else {
                $_SESSION["reset_password_error"] = "Invalid username url";
            }
        }
    }
}
if (isset($_SESSION["reset_password_error"])) {
    header('Location: /login/resetPassword.php');
} else {
    header('Location: /login/login.php');
}
?>