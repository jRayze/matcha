<?php
include "../database/sql.php";

session_start();

if (isset($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $bdd = get_connection();
    $stmt = $bdd->prepare("SELECT * FROM users WHERE email='$_POST[email]';");
    $stmt->execute();
    if (($query = $stmt->fetch())) {
        
    } else {
        $_SESSION["recover_password_error"] = "Email not found";
    }
} else {
    
}
header('Location: /login/recoverPassword.php');
?>