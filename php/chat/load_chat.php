<?php
include "../database/sql.php";
include "../utils/relative_time.php";
session_start();

$data;



$data["chat_history"] = array();

$data["focused_chat"] = array();
$data["focused_chat"]["conv_id"] = -1;
$data["focused_chat"]["circle_img"] = "";
$data["focused_chat"]["messages"] = array();


if (isset($_SESSION["user_id"])) {
    $focused_chat_circle_img = "";
    $bdd = get_connection();
    $q = "SELECT ccr.conv_id,
        (
            SELECT CONCAT(users.first_name, ' ', users.last_name) FROM chat_conversation_relations ccr
            INNER JOIN users ON users.id = ccr.user_id
            WHERE ccr.conv_id = cm.conv_id AND ccr.user_id != $_SESSION[user_id]
        ) as destinataire,
        (
            SELECT users.image1 FROM chat_conversation_relations ccr
            INNER JOIN users ON users.id = ccr.user_id
            WHERE ccr.conv_id = cm.conv_id AND ccr.user_id != $_SESSION[user_id]
        ) as destinataire_image,
        u.id,  cm.dateadded, cm.seen, cm.message FROM chat_conversations cc
        JOIN chat_messages cm ON cm.id = cc.last_chat_id
        JOIN chat_conversation_relations ccr ON ccr.conv_id = cm.conv_id
        JOIN users u ON u.id = cm.from_user
        WHERE ccr.user_id = $_SESSION[user_id];
    ";
    $data["query"] = $q;
    $stmt_chat_history = $bdd->prepare($q);
    $stmt_chat_history->execute();
    while (($query = $stmt_chat_history->fetch())) {
        if (!isset($_SESSION["focus_chat_id"])) {
            $_SESSION["focus_chat_id"] = $query["conv_id"];
        }
        if ($_SESSION["focus_chat_id"] == $query["conv_id"]) {
            $data["focused_chat"]["circle_img"] = $query["destinataire_image"];
        }
        $chat_history_item;
        $chat_history_item["conv_name"] = $query["destinataire"];
        $chat_history_item["conv_id"] = $query["conv_id"];
        $chat_history_item["relative_date"] = get_relative_time($query["dateadded"]);

        $stmt_unseen_count = $bdd->prepare("SELECT COUNT(*) FROM chat_messages WHERE seen=0 AND conv_id=$query[conv_id] AND from_user != $_SESSION[user_id]");
        $stmt_unseen_count->execute();

        $unseenQuery = $stmt_unseen_count->fetch();
        $chat_history_item["unseen_count"] = $unseenQuery[0];

        $chat_history_item["msg"] = "";
        if ($query["id"] == $_SESSION["user_id"]) {
            $chat_history_item["msg"].= "Moi: ";
        } else {
            $chat_history_item["msg"].= $query["destinataire"].": ";
        }
        $chat_history_item["msg"].= $query["message"];

        $chat_history_item["img"] = $query["destinataire_image"];
        array_push($data["chat_history"], $chat_history_item);
    }
    if (isset($_SESSION["focus_chat_id"])) {
        $stmt_set_as_read = $bdd->prepare("UPDATE chat_messages SET seen=1 WHERE conv_id=$_SESSION[focus_chat_id] AND from_user != $_SESSION[user_id];");
        $stmt_set_as_read->execute();

        $data["focused_chat"]["conv_id"] = $_SESSION["focus_chat_id"];
        $stmt_focused_chat = $bdd->prepare("SELECT * FROM chat_messages WHERE conv_id=$_SESSION[focus_chat_id] ORDER BY dateadded ASC");
        $stmt_focused_chat->execute();
        while (($query = $stmt_focused_chat->fetch())) {
            $message;
            $message["sent"] = false;
            if ($query["from_user"] == $_SESSION["user_id"]) {
                $message["sent"] = true;
            }
            $message["id"] = $query["id"];
            $message["seen"] = $query["seen"];
            $message["relative_time"] = get_relative_time($query["dateadded"]);
            $message["text"] = $query["message"];
            array_push($data["focused_chat"]["messages"], $message);
        }
    }
}
echo json_encode($data);
?>