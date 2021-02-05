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

    if (isset($_POST["expand_list"])) {
        if ($_POST["expand_list"] == "true") {
            $_SESSION["max_results"] += 12;
        } else if ($_POST["expand_list"] == "false") {
            $_SESSION["max_results"] = 12;
        }
    }

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

    $_SESSION["popularity_filter"] = 0;
    if (isset($_POST["popularity"]) && is_numeric($_POST["popularity"])) {
        $popularity = intval($_POST["popularity"]);
        if ($popularity > -1 && $popularity < 6) {
            $_SESSION["popularity_filter"] = $popularity;
        }
    }

    $bdd = get_connection();

    $stmt_update_user_search_settings = $bdd->prepare("UPDATE users SET filter_age_min=$age_min, filter_age_max=$age_max, filter_distance_km=$distance_max, sexual_orientation_filter='$sexual_orientation' WHERE id=$_SESSION[user_id];");
    $stmt_update_user_search_settings->execute();
    echo json_encode($debug);
}
?>