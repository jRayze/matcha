<?php
include "../database/sql.php";
include "../utils/interests.php";
include "../popularity/popularity_metric.php";
include "../chat/create_conversation.php";

session_start();
if (isset($_SESSION["user_id"])) {
    $bdd = get_connection();
    $stmt = $bdd->prepare("SELECT * FROM users WHERE id='$_SESSION[user_id]' AND admin=1;");
    $stmt->execute();
    if (($query = $stmt->fetch())) {
        $old_session_id = $_SESSION["user_id"];

        $stmt = $bdd->prepare("SELECT id FROM users;");
        $stmt->execute();
        
        $ids = array();
        while (($query = $stmt->fetch())) {
            array_push($ids, $query[0]);
        }

        $total_views = 0;
        $total_likes = 0;
        $total_matches = 0;
        $total_messages = 0;
        
        for ($x = 0; $x < count($ids) * 10; $x++) {
            $user_1 = rand(0, count($ids) - 1);
            $user_2 = rand(0, count($ids) - 1);
            if ($user_1 != $user_2) {
                if (rand(0, 2)) {
                    $total_views++;
                    $stmt_check_profile_view = $bdd->prepare("SELECT * FROM notif_profile_views WHERE from_user=$ids[$user_1] AND to_user=$ids[$user_2];");
                    $stmt_check_profile_view->execute();
                    if (!($query = $stmt_check_profile_view->fetch())) {
                        $stmt_add_profile_view = $bdd->prepare("INSERT INTO notif_profile_views (from_user, to_user, seen) VALUES ($ids[$user_1], $ids[$user_2], 0);");
                        $stmt_add_profile_view->execute();
                        if (rand(0, 2)) {
                            $stmt_check_like = $bdd->prepare("SELECT * FROM notif_likes WHERE from_user=$ids[$user_1] AND to_user=$ids[$user_2];");
                            $stmt_check_like->execute();
                            if (!($query = $stmt_check_like->fetch())) {
                                $total_likes++;
                                $stmt_add_like = $bdd->prepare("INSERT INTO notif_likes (from_user, to_user) VALUES ($ids[$user_1], $ids[$user_2]);");
                                $stmt_add_like->execute();
                                
                                $stmt_check_mutual_like = $bdd->prepare("SELECT * FROM notif_likes WHERE from_user=$ids[$user_2] AND to_user=$ids[$user_1];");
                                $stmt_check_mutual_like->execute();
                                if (($query = $stmt_check_mutual_like->fetch())) {
                                    $total_matches++;
                                    $stmt_match1 = $bdd->prepare("INSERT INTO notif_matches (from_user, to_user) VALUES ($ids[$user_1], $ids[$user_2]);");
                                    $stmt_match1->execute();
                        
                                    $stmt_match2 = $bdd->prepare("INSERT INTO notif_matches (from_user, to_user) VALUES ($ids[$user_2], $ids[$user_1]);");
                                    $stmt_match2->execute();
                        
                                    create_conversation($ids[$user_1], $ids[$user_2]);
                                }
                            }
                        }
                    }
                }
            }
        }
        calculate_popularity();
    }
}
?>