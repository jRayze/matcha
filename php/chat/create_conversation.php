<?php
include "../database/sql.php";
session_start();
if (isset($_SESSION["user_id"])) {
    $bdd = get_connection();
    $stmt = $bdd->prepare("SELECT * FROM users WHERE id='$_SESSION[user_id]' AND admin=1;");
    $stmt->execute();
    if (($query = $stmt->fetch())) {
        
        if (isset($_GET["user_id"]) && is_numeric($_GET["user_id"])) {
            create_conversation($_SESSION["user_id"], $_GET["user_id"]);
        } else {
            echo "example: http://localhost/php/chat/create_conversation.php?user_id=452";
        }
    }
}
function create_conversation($user_id_1, $user_id_2) {
    //echo "user_id_1: ".$user_id_1." user_id_1: ".$user_id_2."<br>";
    $bdd = get_connection();
    $stmt = $bdd->prepare("SELECT COUNT(*) FROM users WHERE id='$user_id_1' OR id='$user_id_2';");
    $stmt->execute();
    if (($query = $stmt->fetch())) {
        if ($query[0] == 2) {
            $stmt = $bdd->prepare("SELECT * FROM chat_conversation_relations WHERE user_id='$user_id_2';");
            $stmt->execute();
            if (($query = $stmt->fetch())) {
                //echo "chat_conversation_relations found 1 row";
            } else {
                $tmp_last_chat_id = $user_id_2 * -1;
                $stmt_create_conversation = $bdd->prepare("INSERT INTO chat_conversations (last_chat_id) VALUES ($tmp_last_chat_id);");
                $stmt_create_conversation->execute();

                $stmt_get_conversation_id = $bdd->prepare("SELECT * FROM chat_conversations WHERE last_chat_id=$tmp_last_chat_id;");
                $stmt_get_conversation_id->execute();
                $query = $stmt_get_conversation_id->fetch();
                $conversation_id = $query["id"];

                //echo "Created new conversation with id ".$conversation_id;

                $stmt_create_conversation_relation = $bdd->prepare("INSERT INTO chat_conversation_relations (user_id, conv_id) VALUES ($user_id_1, $conversation_id);");
                $stmt_create_conversation_relation->execute();

                $stmt_create_conversation_relation = $bdd->prepare("INSERT INTO chat_conversation_relations (user_id, conv_id) VALUES ($user_id_2, $conversation_id);");
                $stmt_create_conversation_relation->execute();

                $stmt_send_msg = $bdd->prepare("INSERT INTO chat_messages (from_user, message, conv_id) VALUES ($user_id_1, 'Bonjour, nous avons match!', $conversation_id);");
                $stmt_send_msg->execute();

                $stmt_last_msg_id = $bdd->prepare("SELECT id FROM chat_messages WHERE conv_id=$conversation_id ORDER BY dateadded DESC LIMIT 1;");
                $stmt_last_msg_id->execute();
                if (($query = $stmt_last_msg_id->fetch())) {
                    $stmt_update_last_msg = $bdd->prepare("UPDATE chat_conversations SET last_chat_id=$query[id] WHERE id=$conversation_id;");
                    $stmt_update_last_msg->execute();
                }
            }
        }
    }
}
?>