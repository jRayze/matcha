<?php
include "../database/sql.php";
session_start();

$data["blocked"] = false;

if (isset($_SESSION["user_id"])) {
    if (isset($_POST["user_id"]) && $_POST["user_id"] != $_SESSION["user_id"]) {
        $user_id_secure = intval($_POST["user_id"]);
        $bdd = get_connection();

        $stmt_check_blocked = $bdd->prepare("SELECT * FROM blocked_relations WHERE blocking_user=$_SESSION[user_id] AND blocked_user=$user_id_secure;");
        $stmt_check_blocked->execute();

        if (!($query = $stmt_check_blocked->fetch())) {
            $stmt_add_blocked = $bdd->prepare("INSERT INTO blocked_relations (blocking_user, blocked_user) VALUES ($_SESSION[user_id], $user_id_secure);");
            $stmt_add_blocked->execute();
        }
        $data["blocked"] = true;

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