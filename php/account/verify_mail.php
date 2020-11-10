<?php
include "../database/sql.php";

if (isset($_GET["username"]) && isset($_GET["key"])) {
    $bdd = get_connection();
    $stmt = $bdd->prepare("SELECT * FROM users WHERE username='$_GET[username]';");
    $stmt->execute();
    if (($query = $stmt->fetch())) {
        if ($query["verified"] === "1") {
            echo "Your account has already been verified";
        }
        else if ($query["mail_url"] === $_GET["key"]) {
            echo "Your account has been verified";
            $stmt2 = $bdd->prepare("UPDATE users SET verified=1,mail_url='' WHERE username='$_GET[username]';");
            $stmt2->execute();
        }
    }
}
?>