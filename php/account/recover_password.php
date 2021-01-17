<?php
include "../database/sql.php";

session_start();

if (isset($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $bdd = get_connection();
    $stmt = $bdd->prepare("SELECT * FROM users WHERE email='$_POST[email]';");
    $stmt->execute();
    if (($query = $stmt->fetch())) {
        $recovery_url = password_hash($query["email"], PASSWORD_DEFAULT);
        $stmt = $bdd->prepare("UPDATE users SET password_recovery_url='$recovery_url' WHERE id=$query[id];");
        $stmt->execute();

        $message = '
        <html>
        <head>
        <title>Matcha password reset</title>
        </head>
        <body>
        <p>Matcha password reset</p>
        <a href="http://localhost/login/resetPassword.php?key='.$recovery_url.'&username='.$query["username"].'">Click this link to reset your password</a>
        </body>
        </html>';

        $headers = "From: matcha@localhost.com \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        
        mail($_POST["email"], 'Matcha password reset', $message, $headers);

        $_SESSION["recover_password_success"] = "Check your emails to change your password";
    } else {
        $_SESSION["recover_password_error"] = "Email not found";
    }
} else {
    
}
header('Location: /login/recoverPassword.php');
?>