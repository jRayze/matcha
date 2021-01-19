<?php
include "../database/sql.php";
include "../utils/report_list.php";
session_start();

if (isset($_SESSION["user_id"])) {
    if (isset($_POST["user_id"]) && is_numeric($_POST["user_id"])) {
        $user_id_secure = intval($_POST["user_id"]);
        if (isset($_POST["reason"]) && in_array($_POST["reason"], $report_list)) {
            $bdd = get_connection();
            $stmt = $bdd->prepare("SELECT * FROM reports WHERE from_user=$_SESSION[user_id] AND to_user=$user_id_secure;");
            $stmt->execute();
            if (!($query = $stmt->fetch())) {
                $stmt_add_report = $bdd->prepare("INSERT INTO reports (from_user, to_user) VALUES ($_SESSION[user_id], $user_id_secure);");
                $stmt_add_report->execute();
            }
            $stmt_profile_views_total = $bdd->prepare("SELECT COUNT(*) FROM notif_profile_views WHERE to_user='$_SESSION[user_id]' AND seen=0;");

            $stmt_count_reports = $bdd->prepare("SELECT COUNT(*) FROM reports WHERE to_user=$user_id_secure;");
            $stmt_count_reports->execute();
            if (($query = $stmt_count_reports->fetch())) {
                if ($query[0] > 4) {
                    $stmt = $bdd->prepare("UPDATE users SET under_investigation=1 WHERE id=$user_id_secure;");
                    $stmt->execute();
                }
            }
        }
    }
}

?>