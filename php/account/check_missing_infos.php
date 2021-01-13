<?php
function profile_is_complete($query) {
    $ret = false;
    
    $_SESSION["missing_profile_infos"] = array();

    if ($query["age"] == -1) {
        array_push($_SESSION["missing_profile_infos"], "Age");
    }
    if ($query["gender"] === null) {
        array_push($_SESSION["missing_profile_infos"], "Sexe");
    }
    if ($query["bio"] === null) {
        array_push($_SESSION["missing_profile_infos"], "Bio");
    }
    if ($query["interests"] === null) {
        array_push($_SESSION["missing_profile_infos"], "Intérêts");
    }
    if ($query["sexual_orientation"] === null) {
        array_push($_SESSION["missing_profile_infos"], "Orientation Sexuelle");
    }
    if ($query["latitude"] === null ||
        $query["longitude"] === null) {
        array_push($_SESSION["missing_profile_infos"], "Géolocalisation");
    }
    $missing_images = 0;
    if ($query["image1"] === null) {
        $missing_images++;
    }
    if ($query["image2"] === null) {
        $missing_images++;
    }
    if ($query["image3"] === null) {
        $missing_images++;
    }
    if ($query["image4"] === null) {
        $missing_images++;
    }
    if ($query["image5"] === null) {
        $missing_images++;
    }
    if ($missing_images > 0) {
        array_push($_SESSION["missing_profile_infos"], $missing_images." Images");
    }
    if (count($_SESSION["missing_profile_infos"]) > 0) {
        $ret = false;
    } else {
        $ret = true;
    }
    return ($ret);
}
?>