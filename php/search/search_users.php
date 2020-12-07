<?php
include "../database/sql.php";
include "../utils/distances.php";

session_start();

if (isset($_SESSION["user_id"])) {
    if (!isset($_SESSION["distances"])) {
        $_SESSION["distances"] = array();
    }
    $bdd = get_connection();
    $q = "SELECT id, first_name, last_name, gender, sexual_orientation, image1, age, latitude, longitude FROM users;";
    $stmt_user_list = $bdd->prepare($q);
    $stmt_user_list->execute();
    while (($query = $stmt_user_list->fetch())) {
        if ($query["latitude"] != null && $query["latitude"] !== 0) {
            if (!isset($_SESSION["distances"][$query["id"]])) {
                $_SESSION["distances"][$query["id"]] = get_distance($_SESSION["latitude"], $_SESSION["longitude"], $query["latitude"], $query["longitude"]);
            }
            echo "<br>".$_SESSION["distances"][$query["id"]];
        }
    }
}
?>