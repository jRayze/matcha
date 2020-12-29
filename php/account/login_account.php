<?php
session_start();
include "../database/sql.php";

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
                $_SESSION["latitude"] = $query["latitude"];
                $_SESSION["longitude"] = $query["longitude"];
                $_SESSION["filter_tags"] = array();
                $_SESSION["popularity_filter"] = 0;
                $_SESSION["db_infos"] = $query;

                $_SESSION["missing_profile_infos"] = array();

                if ($query["age"] == -1) {
                    array_push($_SESSION["missing_profile_infos"], "Age");
                }
                if ($query["gender"] === null) {
                    array_push($_SESSION["missing_profile_infos"], "Sexe");
                }
                if ($query["bio"] === null) {
                    array_push($_SESSION["missing_profile_infos"], "Bio");
                }
                if ($query["interests"] === null) {
                    array_push($_SESSION["missing_profile_infos"], "Intérêts");
                }
                if ($query["sexual_orientation"] === null) {
                    array_push($_SESSION["missing_profile_infos"], "Orientation Sexuelle");
                }
                if ($query["latitude"] === null ||
                    $query["longitude"] === null) {
                    array_push($_SESSION["missing_profile_infos"], "Géolocalisation");
                }
                if ($query["image1"] === null ||
                    $query["image2"] === null ||
                    $query["image3"] === null ||
                    $query["image4"] === null ||
                    $query["image5"] === null) {
                        array_push($_SESSION["missing_profile_infos"], "5 Images");
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