<?php
include "../database/sql.php";
session_start();

$data["blocked"] = false;

if (isset($_SESSION["user_id"])) {
    if (isset($_POST["user_id"]) && $_POST["user_id"] != $_SESSION["user_id"]) {
        $user_id_secure = intval($_POST["user_id"]);
        $bdd = get_connection();

        $stmt_remove_blocked = $bdd->prepare("DELETE FROM blocked_relations WHERE blocking_user=$_SESSION[user_id] AND blocked_user=$user_id_secure;");
        $stmt_remove_blocked->execute();

        $stmt_get_blocked = $bdd->prepare("SELECT * FROM blocked_relations WHERE blocking_user=$_SESSION[user_id];");
        $stmt_get_blocked->execute();

        $_SESSION["blocked_users"] = array();
        while (($query = $stmt_get_blocked->fetch())) {
            array_push($_SESSION["blocked_users"], $query["blocked_user"]);
        }
        $data["blocked_users"] = $_SESSION["blocked_users"];
    }
}
echo json_encode($data);
?>