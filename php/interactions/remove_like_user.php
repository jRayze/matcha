<?php
include "../database/sql.php";
include "../popularity/popularity_metric.php";
session_start();

if (isset($_SESSION["user_id"]) && isset($_POST["user_id"]) && is_numeric($_POST["user_id"]) &&
    !isset($_SESSION["missing_profile_infos"]) || count($_SESSION["missing_profile_infos"]) === 0) {
    $user_id_secure = intval($_POST["user_id"]);

    if ($user_id_secure != $_SESSION["user_id"]) {
        $bdd = get_connection();

        $stmt_check_user_online = $bdd->prepare("SELECT last_activity FROM users WHERE id=$user_id_secure;");
        $stmt_check_user_online->execute();

        if (($query = $stmt_check_user_online->fetch())) {
            $online = false;
            $current_date = new DateTime(date('m/d/Y h:i:s a', time()));
            $target_date = new DateTime($query["last_activity"], new DateTimeZone('Europe/Paris'));

            $diff = $current_date->diff($target_date);

            if ($diff->y == 0 &&
                $diff->m == 0 &&
                $diff->d == 0 &&
                $diff->h == 0 &&
                $diff->i == 0) {
                    $online = true;
                }
            if ($online) {
                $stmt_remove_like = $bdd->prepare("DELETE FROM notif_likes WHERE from_user=$_SESSION[user_id] AND to_user=$user_id_secure;");
                $stmt_remove_like->execute();
                $stmt_remove_like = $bdd->prepare("INSERT INTO notif_likes (from_user, to_user, active) VALUES ($_SESSION[user_id], $user_id_secure, 0);");
                $stmt_remove_like->execute();
            } else {
                $stmt_remove_like = $bdd->prepare("DELETE FROM notif_likes WHERE from_user=$_SESSION[user_id] AND to_user=$user_id_secure;");
                $stmt_remove_like->execute();
            }
            $stmt_clear_matches = $bdd->prepare("DELETE FROM notif_matches WHERE from_user=$_SESSION[user_id] AND to_user=$user_id_secure OR from_user=$user_id_secure AND to_user=$_SESSION[user_id];");
            $stmt_clear_matches->execute();
            calculate_popularity();
        }
    }
}
?>