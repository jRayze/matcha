<?php
session_start();
include "../database/sql.php";

if (isset($_SESSION["user_id"])) {
    $bdd = get_connection();
    $stmt_seen = $bdd->prepare("UPDATE notif_likes SET seen=1 WHERE to_user=$_SESSION[user_id];");
    $stmt_seen->execute();

    $_SESSION["notify_focus"] = "likes";
}
?>