<?php
session_start();
include "../database/sql.php";
include "../utils/relative_time.php";

$limit_max = 5;

$data;

$data["profile_views"] = array();
$data["profile_views"]["list"] = array();
$data["profile_views"]["total_display"] = 0;
$data["profile_views"]["total"] = 0;

$data["likes"] = array();
$data["likes"]["list"] = array();
$data["likes"]["total_display"] = 0;
$data["likes"]["total"] = 0;

$data["matches"] = array();
$data["matches"]["list"] = array();
$data["matches"]["total_display"] = 0;
$data["matches"]["total"] = 0;

if (isset($_SESSION["user_id"])) {
    $bdd = get_connection();

    $stmt_profile_views_total = $bdd->prepare("SELECT COUNT(*) FROM notif_profile_views WHERE to_user='$_SESSION[user_id]' AND seen=0;");
    $stmt_profile_views_total->execute();
    if (($query = $stmt_profile_views_total->fetch())) {
        $data["profile_views"]["total"] = $query[0];
    }
    $stmt_profile_views = $bdd->prepare("SELECT users.first_name, users.image1, notif_profile_views.id, notif_profile_views.dateadded, notif_profile_views.from_user, notif_profile_views.to_user, notif_profile_views.seen FROM notif_profile_views
        LEFT JOIN users ON notif_profile_views.from_user=users.id WHERE notif_profile_views.to_user='$_SESSION[user_id]' AND notif_profile_views.seen='0' ORDER BY notif_profile_views.dateadded DESC LIMIT $limit_max;");
    $stmt_profile_views->execute();
    while (($query = $stmt_profile_views->fetch())) {
        $profile_view;
        $profile_view["relative_date"] = get_relative_time($query["dateadded"]);
        $profile_view["from"] = $query["first_name"];
        $profile_view["img"] = $query["image1"];
        $profile_view["id"] = $query["id"];
        array_push($data["profile_views"]["list"], $profile_view);
        $data["profile_views"]["total_display"]++;
    }

    $stmt_likes_total = $bdd->prepare("SELECT COUNT(*) FROM notif_likes WHERE to_user='$_SESSION[user_id]' AND seen=0;");
    $stmt_likes_total->execute();
    if (($query = $stmt_likes_total->fetch())) {
        $data["likes"]["total"] = $query[0];
    }
    $stmt_likes = $bdd->prepare("SELECT users.first_name, users.image1, notif_likes.id, notif_likes.dateadded, notif_likes.from_user, notif_likes.to_user, notif_likes.seen FROM notif_likes
        LEFT JOIN users ON notif_likes.from_user=users.id WHERE notif_likes.to_user='$_SESSION[user_id]' AND notif_likes.seen='0' ORDER BY notif_likes.dateadded DESC LIMIT $limit_max;");
    $stmt_likes->execute();
    while (($query = $stmt_likes->fetch())) {
        $like;
        $like["relative_date"] = get_relative_time($query["dateadded"]);
        $like["from"] = $query["first_name"];
        $like["img"] = $query["image1"];
        $like["id"] = $query["id"];
        array_push($data["likes"]["list"], $like);
        $data["likes"]["total_display"]++;
    }

    $stmt_matches_total = $bdd->prepare("SELECT COUNT(*) FROM notif_matches WHERE to_user='$_SESSION[user_id]' AND seen=0;");
    $stmt_matches_total->execute();
    if (($query = $stmt_matches_total->fetch())) {
        $data["matches"]["total"] = $query[0];
    }
    $stmt_matches = $bdd->prepare("SELECT users.first_name, users.image1, notif_matches.id, notif_matches.dateadded, notif_matches.from_user, notif_matches.to_user, notif_matches.seen FROM notif_matches
        LEFT JOIN users ON notif_matches.from_user=users.id WHERE notif_matches.to_user='$_SESSION[user_id]' AND notif_matches.seen='0' ORDER BY notif_matches.dateadded DESC LIMIT $limit_max;");
    $stmt_matches->execute();
    while (($query = $stmt_matches->fetch())) {
        $match;
        $match["relative_date"] = get_relative_time($query["dateadded"]);
        $match["from"] = $query["first_name"];
        $match["img"] = $query["image1"];
        $match["id"] = $query["id"];
        array_push($data["matches"]["list"], $match);
        $data["matches"]["total_display"]++;
    }
}

echo json_encode($data);
?>