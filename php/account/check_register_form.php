<?php
include "../database/sql.php";

$result;
$result["valid"] = true;
$result["registration_error"] = array();

if (isset($_GET["lastname"]) && strlen($_GET["lastname"])) {
    if (!preg_match('/^[\p{Latin}\s]+$/u', $_GET["lastname"])) {
        array_push($result["registration_error"], "Invalid last name");
        $result["valid"] = false;
    }
} else {
    $result["valid"] = false;
}

if (isset($_GET["firstname"]) && strlen($_GET["firstname"])) {
    if (!preg_match('/^[\p{Latin}\s]+$/u', $_GET["firstname"])) {
        array_push($result["registration_error"], "Invalid first name");
        $result["valid"] = false;
    }
} else {
    $result["valid"] = false;
}

if (isset($_GET["username"]) && strlen($_GET["username"])) {
    if (!ctype_alnum($_GET["username"])) {
        array_push($result["registration_error"], "Invalid username");
        $result["valid"] = false;
    } else if (strlen($_GET["username"]) < 4) {
        array_push($result["registration_error"], "Username too short");
        $result["valid"] = false;
    } else {
        $bdd = get_connection();
        $stmt = $bdd->prepare("SELECT * FROM users WHERE username='$_GET[username]';");
        $stmt->execute();
        if (($query = $stmt->fetch())) {
            $result["valid"] = false;
            array_push($result["registration_error"], "Username already in use");
        }
    }
} else {
    $result["valid"] = false;
}

if (isset($_GET["email"]) && strlen($_GET["email"])) {
    if (!filter_var($_GET["email"], FILTER_VALIDATE_EMAIL)) {
        array_push($result["registration_error"], "Invalid email");
        $result["valid"] = false;
    } else {
        $bdd = get_connection();
        $stmt = $bdd->prepare("SELECT * FROM users WHERE email='$_GET[email]';");
        $stmt->execute();
        if (($query = $stmt->fetch())) {
            $result["valid"] = false;
            array_push($result["registration_error"], "Email already in use");
        }
    }
} else {
    $result["valid"] = false;
}

if (isset($_GET["password"]) && strlen($_GET["password"])) {
    if (strlen($_GET["password"]) < 8 || strlen($_GET["password"]) > 20) {
        array_push($result["registration_error"], "Invalid password length");
        $result["valid"] = false;
    } else if (!preg_match('/[a-zA-Z]/', $_GET["password"])) {
        array_push($result["registration_error"], "Password must contain at least 1 letter");
        $result["valid"] = false;
    } else if (!preg_match('/\d/', $_GET["password"])) {
        array_push($result["registration_error"], "Password must contain at least 1 digit");
        $result["valid"] = false;
    } else if (!preg_match('/[^a-zA-Z\d]/', $_GET["password"])) {
        array_push($result["registration_error"], "Password must contain at least 1 special character");
        $result["valid"] = false;
    }
} else {
    $result["valid"] = false;
}

echo json_encode($result);
?>