<?php
session_start();
include "../database/sql.php";

$redirect_url = "Location: /";

if (isset($_SESSION["user_id"])) {
    if (isset($_GET["notif_id"]) && is_numeric($_GET["notif_id"])) {
        $secure_id = intval($_GET["notif_id"]);

        $bdd = get_connection();
        $stmt_notif = $bdd->prepare("SELECT * FROM notif_profile_views WHERE id=$secure_id AND to_user=$_SESSION[user_id];");
        $stmt_notif->execute();

        if (($query = $stmt_notif->fetch())) {
            $redirect_url = "Location: /usersProfiles/index.php?user_id=".$query["from_user"];

            $stmt_seen = $bdd->prepare("UPDATE notif_profile_views SET seen=1 WHERE id=$secure_id;");
            $stmt_seen->execute();
        }
    }
} else {
    $redirect_url = "Location: /login/login.php";
}
//echo $redirect_url;
header($redirect_url);
?>