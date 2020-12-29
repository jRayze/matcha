<?php
include "../database/sql.php";
include "../chat/create_conversation.php";
include "../popularity/popularity_metric.php";
session_start();

$data;
$data["liked"] = false;
if (isset($_SESSION["user_id"]) && isset($_POST["user_id"]) && is_numeric($_POST["user_id"]) &&
    !isset($_SESSION["missing_profile_infos"]) || count($_SESSION["missing_profile_infos"]) === 0) {
    $user_id_secure = intval($_POST["user_id"]);

    if ($user_id_secure != $_SESSION["user_id"]) {
        $bdd = get_connection();
        $stmt_check_like = $bdd->prepare("SELECT * FROM notif_likes WHERE from_user=$_SESSION[user_id] AND to_user=$user_id_secure;");
        $stmt_check_like->execute();
        if (($query = $stmt_check_like->fetch())) {
            $user_infos["liked"] = true;
            $data["liked"] = true;
        } else {
            $stmt_add_like = $bdd->prepare("INSERT INTO notif_likes (from_user, to_user) VALUES ($_SESSION[user_id], $user_id_secure);");
            $stmt_add_like->execute();
            $data["liked"] = true;
    
            calculate_popularity();
            
            $stmt_check_mutual_like = $bdd->prepare("SELECT * FROM notif_likes WHERE from_user=$user_id_secure AND to_user=$_SESSION[user_id];");
            $stmt_check_mutual_like->execute();
            if (($query = $stmt_check_mutual_like->fetch())) {
                $stmt_match1 = $bdd->prepare("INSERT INTO notif_matches (from_user, to_user) VALUES ($_SESSION[user_id], $user_id_secure);");
                $stmt_match1->execute();
    
                $stmt_match2 = $bdd->prepare("INSERT INTO notif_matches (from_user, to_user) VALUES ($user_id_secure, $_SESSION[user_id]);");
                $stmt_match2->execute();
    
                create_conversation($_SESSION["user_id"], $user_id_secure);
            }
        }
    }
}
echo json_encode($data);
?>