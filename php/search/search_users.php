<?php
include "../database/sql.php";
include "../utils/distances.php";
include "../utils/interests.php";

session_start();

$data;

$data["results"] = array();
$data["tags"] = $interest_list;
$data["user_filter_tags"] = array();
$data["user_filter_popularity"] = 0;

if (isset($_SESSION["filter_tags"]) && count($_SESSION["filter_tags"]) > 0) {
    $data["user_filter_tags"] = $_SESSION["filter_tags"];
}

if (isset($_SESSION["popularity_filter"])) {
    $data["user_filter_popularity"] = $_SESSION["popularity_filter"];
}

if (isset($_SESSION["user_id"])) {
    if (!isset($_SESSION["distances"])) {
        $_SESSION["distances"] = array();
    }
    $bdd = get_connection();

    $stmt_user_search_settings = $bdd->prepare("SELECT gender, sexual_orientation_filter, interests, filter_age_min, filter_age_max, filter_distance_km FROM users WHERE id=$_SESSION[user_id];");
    $stmt_user_search_settings->execute();
    $user_search_settings = $stmt_user_search_settings->fetch();
    $data["filters"] = $user_search_settings;
    
    $q = "SELECT id, first_name, last_name, gender, sexual_orientation, bio, interests, popularity, image1, age, latitude, longitude FROM users
        WHERE age >= $user_search_settings[filter_age_min] AND
        age <= $user_search_settings[filter_age_max] AND
        sexual_orientation='$user_search_settings[sexual_orientation_filter]' AND
        id != $_SESSION[user_id] AND
        profile_complete=1";

    if (isset($_SESSION["filter_tags"]) && count($_SESSION["filter_tags"]) > 0) {
        foreach ($_SESSION["filter_tags"] as $tag) {
            $q.=" AND INSTR(`interests`, '$tag') > 0 ";
        }
    }
    if (isset($_SESSION["popularity_filter"]) && $_SESSION["popularity_filter"] > 0) {
        $q.=" AND popularity >= $_SESSION[popularity_filter] ";
    }

    $data["query"] = $q;
    
    $stmt_user_list = $bdd->prepare($q);
    $stmt_user_list->execute();
    while (($query = $stmt_user_list->fetch())) {
        if ($query["latitude"] != null && $query["latitude"] !== 0 && $query["longitude"] != null && $query["longitude"] !== 0) {
            if (!isset($_SESSION["distances"][$query["id"]])) {
                $_SESSION["distances"][$query["id"]] = get_distance($_SESSION["latitude"], $_SESSION["longitude"], $query["latitude"], $query["longitude"]);
            }
            if ($_SESSION["distances"][$query["id"]] <= $user_search_settings["filter_distance_km"]) {
                $result;
                $result["distance"] = $_SESSION["distances"][$query["id"]];
                $result["age"] = $query["age"];
                $result["id"] = $query["id"];
                $result["fullname"] = $query["first_name"].' '.$query["last_name"];
                $result["bio"] = $query["bio"];
                $result["popularity"] = $query["popularity"];
                $result["interests"] = explode(",", $query["interests"]);
                $result["sexualOrientation"] = "Hétérosexuel";
                if ($query["sexual_orientation"] == "bisexual") {
                    $result["sexualOrientation"] = "Bisexuel";
                }
                if ($query["sexual_orientation"] == "homosexual") {
                    $result["sexualOrientation"] = "Homosexuel";
                }

                $result["image"] = $query["image1"];
                array_push($data["results"], $result);
                if (count($data["results"]) > 8) {
                    break;
                }
            }
        }
    }
}
echo json_encode($data);
?>