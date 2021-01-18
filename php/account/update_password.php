<?php
session_start();
include "../database/sql.php";

if (isset($_SESSION["user_id"])) {
    if (isset($_POST["password"]) && strlen($_POST["password"]) > 0 &&
        isset($_POST["newPassword"]) && strlen($_POST["newPassword"]) > 0 &&
        isset($_POST["newPasswordConfirm"]) && strlen($_POST["newPasswordConfirm"]) > 0) {
            if (password_verify($_POST["password"], $_SESSION["db_infos"]["password"]))
            {
                if ($_POST["newPassword"] === $_POST["newPasswordConfirm"]) {
                    if ($_POST["newPassword"] !== $_POST["password"]) {
                        if (strlen($_POST["newPassword"]) < 8 || strlen($_POST["newPassword"]) > 20) {
                            $_SESSION["update_password_error"] = "Password must have length between 8 and 20";
                        } else if (!preg_match('/[a-zA-Z]/', $_POST["newPassword"])) {
                            $_SESSION["update_password_error"] = "Password must contain at least one low & upper character";
                        } else if (!preg_match('/\d/', $_POST["newPassword"])) {
                            $_SESSION["update_password_error"] = "Password must contain at least one number";
                        } else if (!preg_match('/[^a-zA-Z\d]/', $_POST["newPassword"])) {
                            $_SESSION["update_password_error"] = "Password must contain at least one special character";
                        } else {
                            $hashed_pass = password_hash($_POST["newPassword"], PASSWORD_DEFAULT);
                            $bdd = get_connection();
                            $stmt = $bdd->prepare("UPDATE users SET password='$hashed_pass' WHERE id=$_SESSION[user_id];");
                            $stmt->execute();
                            $_SESSION["password_updated"] = "Your password has been updated";
                            unset($_SESSION["user"]);
                            unset($_SESSION["user_id"]);
                            unset($_SESSION["user_mail"]);
                            unset($_SESSION["body_page"]);
                        }
                    } else {
                        $_SESSION["update_password_error"] = "New password must be different from old password";
                    }
                    
                } else {
                    $_SESSION["update_password_error"] = "Passwords do not match";
                }
            } else {
                $_SESSION["update_password_error"] = "Invalid password";
            }
    } else {
        $_SESSION["update_password_error"] = "Incomplete form";
    }
}
if (isset($_SESSION["update_password_error"])) {
    header('Location: /login/changePassword.php');
} else {
    header('Location: /login/login.php');
}
?>