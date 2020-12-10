<?php
include "../database/sql.php";
include "../utils/interests.php";

session_start();

$sexual_orientation_list = array("heterosexual", "homosexual", "bisexual");

$filter_age_min_limit = 18;
$filter_age_max_limit = 100;

$filter_distance_min_limit = 1;
$filter_distance_max_limit = 350;

if (isset($_SESSION["user_id"]) &&
    isset($_POST["filter_age_min"]) &&
    isset($_POST["filter_age_max"]) &&
    isset($_POST["filter_distance_max"]) &&
    isset($_POST["sexual_orientation"]) && in_array($_POST["sexual_orientation"], $sexual_orientation_list)) {
    //print_r($_POST);

    $debug = array();

    $age_min = intval($_POST["filter_age_min"]);
    if ($age_min < $filter_age_min_limit || $age_min >= $filter_age_max_limit) {
        $age_min = $filter_age_min_limit;
    }

    $age_max = intval($_POST["filter_age_max"]);
    if ($age_max > $filter_age_max_limit || $age_max <= $filter_age_min_limit) {
        $age_max = $filter_age_max_limit;
    }

    $distance_max = intval($_POST["filter_distance_max"]);
    if ($distance_max > $filter_distance_max_limit || $distance_max < $filter_distance_min_limit) {
        $distance_max = $filter_distance_min_limit;
    }

    $sexual_orientation = $_POST["sexual_orientation"];

    $debug["age_min"] = $age_min;
    $debug["age_max"] = $age_max;
    $debug["distance_max"] = $distance_max;
    $debug["sexual_orientation"] = $sexual_orientation;

    $_SESSION["filter_tags"] = array();
    if (isset($_POST["tags"])) {
        $filter_tags = explode(",", $_POST["tags"]);
        foreach ($filter_tags as $tag) {
            if (in_array($tag, $interest_list)) {
                array_push($_SESSION["filter_tags"], $tag);
            }
        }
        $debug["filter_tags"] = $filter_tags;
    }

    $bdd = get_connection();

    $stmt_update_user_search_settings = $bdd->prepare("UPDATE users SET filter_age_min=$age_min, filter_age_max=$age_max, filter_distance_km=$distance_max, sexual_orientation_filter='$sexual_orientation' WHERE id=$_SESSION[user_id];");
    $stmt_update_user_search_settings->execute();
    echo json_encode($debug);
}
?>