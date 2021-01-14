<?php
session_start();
include "../database/sql.php";
include "./check_missing_infos.php";

if (isset($_POST["email"]) && strlen($_POST["email"]) && isset($_POST["password"]) && strlen($_POST["password"])) {
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $_SESSION["login_error"] = "Invalid email / password";
    } else {
        $bdd = get_connection();
        $stmt = $bdd->prepare("SELECT * FROM users WHERE email='$_POST[email]';");
        $stmt->execute();
        if (($query = $stmt->fetch())) {
            if (password_verify($_POST["password"], $query["password"])) {
                $_SESSION["user"] = $query["username"];
                $_SESSION["user_id"] = $query["id"];
                $_SESSION["user_mail"] = $query["email"];
                $_SESSION["body_page"] = "accueil/accueil.php";
                $_SESSION["filter_tags"] = array();
                $_SESSION["popularity_filter"] = 0;
                $_SESSION["db_infos"] = $query;

                if (profile_is_complete($query)) {
                    $stmt = $bdd->prepare("UPDATE users SET profile_complete=1 WHERE id=$query[id];");
                    $stmt->execute();
                } else {
                    $stmt = $bdd->prepare("UPDATE users SET profile_complete=0 WHERE id=$query[id];");
                    $stmt->execute();
                }
            } else {
                $_SESSION["login_error"] = "Invalid email / password";
            }
        } else {
            $_SESSION["login_error"] = "Invalid email / password";
        }
    }
} else {
    $_SESSION["login_error"] = "Invalid email / password";
    
}
if (isset($_SESSION["login_error"])) {
    header('Location: /login/login.php');
} else {
    header('Location: /');
}
?>