<?php
session_start();
include "../database/sql.php";
include "./check_missing_infos.php";
include "../utils/interests.php";

$sexual_orientation_list = array("heterosexual", "homosexual", "bisexual");

if (isset($_SESSION["user_id"])) {
    $valid = true;
    if (isset($_POST["first_name"]) && strlen($_POST["first_name"])) {
        if (!preg_match('/^[\p{Latin}\s]+$/u', $_POST["first_name"])) {
            $valid = false;
            $_SESSION["update_profile_error"] = "Illegal character(s) in first / last name";
        }
    } else {
        $valid = false;
        $_SESSION["update_profile_error"] = "First name is empty";
    }
    if (isset($_POST["last_name"]) && strlen($_POST["last_name"])) {
        if (!preg_match('/^[\p{Latin}\s]+$/u', $_POST["last_name"])) {
            $valid = false;
            $_SESSION["update_profile_error"] = "Illegal character(s) in first name";
        }
    } else {
        $valid = false;
        $_SESSION["update_profile_error"] = "Last name is empty";
    }
    $sexual_orientation = "bisexual";
    if (isset($_POST["radio-stacked"])) {
        if (!in_array($_POST["radio-stacked"], $sexual_orientation_list)) {
            $valid = false;
            $_SESSION["update_profile_error"] = "Unknown sexual orientation";
        } else {
            $sexual_orientation = $_POST["radio-stacked"];
        }
    } else {
        $valid = false;
        $_SESSION["update_profile_error"] = "Sexual orientation is empty";
    }
    $age_secure = -1;
    if (isset($_POST["age"]) && is_numeric($_POST["age"])) {
        $age_secure = intval($_POST["age"]);
        if ($age_secure < 18 || $age_secure > 100) {
            $_SESSION["update_profile_error"] = "Age must be between 18 and 100";
            $valid = false;
        }
    } else {
        $valid = false;
        $_SESSION["update_profile_error"] = "Age is empty";
    }
    $gender = null;
    if (isset($_POST["gender"]) && is_numeric($_POST["gender"])) {
        $gender_secure = intval($_POST["gender"]);
        if ($gender_secure == 1) {
            $gender = "male";
        } else if ($gender_secure == 2) {
            $gender = "female";
        } else {
            $valid = false;
            $_SESSION["update_profile_error"] = "Unknown gender";
        }
    } else {
        $valid = false;
        $_SESSION["update_profile_error"] = "Gender is empty";
    }
    $bio = null;
    if (isset($_POST["biography"]) && strlen($_POST["biography"]) > 0) {
        $bio = addslashes(htmlspecialchars($_POST["biography"]));
    } else {
        $valid = false;
        $_SESSION["update_profile_error"] = "Bio is empty";
    }
    $tags_secure = array();
    if (isset($_POST["tags"])) {
        $filter_tags = explode(",", $_POST["tags"]);
        foreach ($filter_tags as $tag) {
            if (in_array($tag, $interest_list)) {
                array_push($tags_secure, $tag);
            } else if (strlen($tag) > 0) {
                $valid = false;
                $_SESSION["update_profile_error"] = "Unknown tag: ".$tag;
                break;
            }
        }
    } else {
        $valid = false;
        $_SESSION["update_profile_error"] = "Tags are empty";
    }

    $bdd = get_connection();

    if ($valid) {
        $stmt_update_profile = $bdd->prepare("UPDATE users SET first_name='$_POST[first_name]', last_name='$_POST[last_name]', sexual_orientation='$sexual_orientation', age=$age_secure, gender='$gender', bio='$bio', interests='$_POST[tags]' WHERE id=$_SESSION[user_id];");
        $stmt_update_profile->execute();
    }

    $stmt_profile_changed = $bdd->prepare("SELECT * from users WHERE id=$_SESSION[user_id];");
    $stmt_profile_changed->execute();
    if (($query = $stmt_profile_changed->fetch())) {
        $_SESSION["db_infos"] = $query;
        if (profile_is_complete($query)) {
            $stmt = $bdd->prepare("UPDATE users SET profile_complete=1 WHERE id=$query[id];");
            $stmt->execute();
        } else {
            $stmt = $bdd->prepare("UPDATE users SET profile_complete=0 WHERE id=$query[id];");
            $stmt->execute();
        }
    }
}
header('Location: /profile');
?>