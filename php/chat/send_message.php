<?php
include "../database/sql.php";
session_start();

if (isset($_SESSION["user_id"])) {
    if (isset($_SESSION["focus_chat_id"]) && isset($_POST["msg"]) && strlen($_POST["msg"]) > 0) {
        $msg_secure = htmlspecialchars($_POST["msg"]);
        echo $msg_secure;
        $bdd = get_connection();
        $stmt_send_msg = $bdd->prepare("INSERT INTO chat_messages (from_user, message, conv_id) VALUES ($_SESSION[user_id], '$msg_secure', $_SESSION[focus_chat_id]);");
        $stmt_send_msg->execute();

        $stmt_last_msg_id = $bdd->prepare("SELECT id FROM chat_messages WHERE conv_id=$_SESSION[focus_chat_id] ORDER BY dateadded DESC LIMIT 1;");
        $stmt_last_msg_id->execute();
        if (($query = $stmt_last_msg_id->fetch())) {
            $stmt_update_last_msg = $bdd->prepare("UPDATE chat_conversations SET last_chat_id=$query[id] WHERE id=$_SESSION[focus_chat_id];");
            $stmt_update_last_msg->execute();
        }
    }
}
/*



Match   => créer nouveau chat_conversation ID=>Z
        => créer 2 chat_conversation_relations conv_id=Z

Message envoyé => MAJ last_chat_id pour conv_id | OK

*/
?>