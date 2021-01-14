<?php
session_start();
include "../database/sql.php";
include "./check_missing_infos.php";

if (isset($_SESSION["user_id"])) {
    if (isset($_POST["latitude"]) && is_numeric($_POST["latitude"]) && isset($_POST["longitude"]) && is_numeric($_POST["longitude"])) {
        $_SESSION["distances"] = array();

        $bdd = get_connection();

        $stmt_update_profile = $bdd->prepare("UPDATE users SET latitude='$_POST[latitude]', longitude='$_POST[longitude]' WHERE id=$_SESSION[user_id];");
        $stmt_update_profile->execute();

        $stmt_profile_changed = $bdd->prepare("SELECT * from users WHERE id=$_SESSION[user_id];");
        $stmt_profile_changed->execute();
        if (($query = $stmt_profile_changed->fetch())) {
            $_SESSION["db_infos"] = $query;
            if (profile_is_complete($query)) {
                $stmt = $bdd->prepare("UPDATE users SET profile_complete=1 WHERE id=$query[id];");
                $stmt->execute();
            } else {
                $stmt = $bdd->prepare("UPDATE users SET profile_complete=0 WHERE id=$query[id];");
                $stmt->execute();
            }
        }
    }
}
header('Location: /profile');
?>