<?php
session_start();
include "../database/sql.php";

$redirect_url = "Location: /chat/";

if (isset($_SESSION["user_id"])) {
    if (isset($_GET["conv_id"]) && is_numeric($_GET["conv_id"])) {
        $conv_id = intval($_GET["conv_id"]);

        $bdd = get_connection();
        $stmt_conv_id = $bdd->prepare("SELECT * FROM chat_conversation_relations WHERE conv_id=$conv_id AND user_id=$_SESSION[user_id];");
        $stmt_conv_id->execute();
        if (($query = $stmt_conv_id->fetch())) {
            $_SESSION["focus_chat_id"] = $conv_id;
        }
    }
} else {
    $redirect_url = "Location: /login/login.php";
}
//echo $redirect_url;
header($redirect_url);
?>