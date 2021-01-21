<?php
include "../database/sql.php";
session_start();
$result;
$result["valid"] = true;

if (isset($_POST["lastname"]) && strlen($_POST["lastname"])) {
    if (!preg_match('/^[\p{Latin}\s]+$/u', $_POST["lastname"])) {
        $result["valid"] = false;
    }
} else {
    $result["valid"] = false;
}

if (isset($_POST["firstname"]) && strlen($_POST["firstname"])) {
    if (!preg_match('/^[\p{Latin}\s]+$/u', $_POST["firstname"])) {
        $result["valid"] = false;
    }
} else {
    $result["valid"] = false;
}

if (isset($_POST["username"]) && strlen($_POST["username"])) {
    if (!ctype_alnum($_POST["username"])) {
        $result["valid"] = false;
    } else if (strlen($_POST["username"]) < 4) {
        $result["valid"] = false;
    } else {
        $bdd = get_connection();
        $stmt = $bdd->prepare("SELECT * FROM users WHERE username='$_POST[username]';");
        $stmt->execute();
        if (($query = $stmt->fetch())) {
            $result["valid"] = false;
        }
    }
} else {
    $result["valid"] = false;
}

if (isset($_POST["email"]) && strlen($_POST["email"])) {
    $illegal = "#$%^&*()+=-[]';,/{}|:<>?~";
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) || strpbrk($_GET["email"], $illegal)) {
        $result["valid"] = false;
    } else {
        $bdd = get_connection();
        $stmt = $bdd->prepare("SELECT * FROM users WHERE email='$_POST[email]';");
        $stmt->execute();
        if (($query = $stmt->fetch())) {
            $result["valid"] = false;
        }
    }
} else {
    $result["valid"] = false;
}

if (isset($_POST["password"]) && strlen($_POST["password"])) {
    if (strlen($_POST["password"]) < 8 || strlen($_POST["password"]) > 20) {
        $result["valid"] = false;
    } else if (!preg_match('/[a-zA-Z]/', $_POST["password"])) {
        $result["valid"] = false;
    } else if (!preg_match('/\d/', $_POST["password"])) {
        $result["valid"] = false;
    } else if (!preg_match('/[^a-zA-Z\d]/', $_POST["password"])) {
        $result["valid"] = false;
    }
} else {
    $result["valid"] = false;
}

if ($result["valid"]) {
    $bdd = get_connection();
    $hashed_pass = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $mail_url = password_hash($_POST["email"], PASSWORD_DEFAULT);
    $stmt = $bdd->prepare("INSERT INTO users (first_name, last_name, username, email, password, verified, mail_url) VALUES ('$_POST[firstname]', '$_POST[lastname]', '$_POST[username]', '$_POST[email]', '$hashed_pass', 0, '$mail_url');");
    $stmt->execute();

    $message = '
    <html>
    <head>
    <title>Matcha email verification</title>
    </head>
    <body>
    <p>Matcha email verification</p>
    <a href="http://localhost/php/account/verify_mail.php?key='.$mail_url.'&username='.$_POST["username"].'">Click this link to verify your mail</a>
    </body>
    </html>';

    $headers = "From: matcha@localhost.com \r\n";
 	$headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
     
    mail($_POST["email"], 'Matcha email verification', $message, $headers);
    $_SESSION["account_created"] = true;
    $_SESSION["account_email"] = $_POST["email"];
    header('Location: /login/login.php');
}
?>