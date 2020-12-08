
<?php
if (!isset($_SESSION["user_id"])) {
    header('Location: /login/login.php');
}
    include ('../template/start.php');
    include ('../template/header.php');
    include ('chat2.php');
    include ('../template/end.php');
?>