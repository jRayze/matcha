<?php
session_start();

if (isset($_SESSION["user"])) {
    include "template/start.php";
    include "template/header.php";
    include "template/empty.php";
    include "template/end.php";
} else {
    header('Location: /login/login.php');
}
?>