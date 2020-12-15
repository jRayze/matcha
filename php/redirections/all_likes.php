<?php
session_start();
include "../database/sql.php";

$redirect_url = "Location: /";

if (isset($_SESSION["user_id"])) {
    $redirect_url = "Location: /notify";

    $bdd = get_connection();
    $stmt_seen = $bdd->prepare("UPDATE notif_likes SET seen=1 WHERE to_user=$_SESSION[user_id];");
    $stmt_seen->execute();

    $_SESSION["notify_focus"] = "likes";
} else {
    $redirect_url = "Location: /login/login.php";
}
header($redirect_url);
?>