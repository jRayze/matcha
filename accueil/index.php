<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header('Location: /login/login.php');
} else if (isset($_SESSION["missing_profile_infos"]) && count($_SESSION["missing_profile_infos"])) {
    header('Location: /profile/');
}
    include ('../template/start.php');
    include ('../template/header.php');
    include ('accueil.php');
    include ('../template/end.php');
?>