<?php
include "../database/sql.php";
session_start();

$data;

$data["reload_chat"] = false;

if (isset($_SESSION["user_id"]) && isset($_POST["conv_id"])) {
    $conv_id = intval($_POST["conv_id"]);
    $bdd = get_connection();
    $stmt_conv_id = $bdd->prepare("SELECT * FROM chat_conversation_relations WHERE conv_id=$conv_id AND user_id=$_SESSION[user_id];");
    $stmt_conv_id->execute();
    if (($query = $stmt_conv_id->fetch())) {
        $data["reload_chat"] = true;
        $_SESSION["focus_chat_id"] = $conv_id;
    }
}
echo json_encode($data);
?>