<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header('Location: /login/login.php');
}
    include ('../template/start.php');
    include ('../template/header.php');
    include ('profile.php');
    include ('../template/end.php');
?>