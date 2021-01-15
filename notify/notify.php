<?php
include "../php/database/sql.php";
include "../php/utils/relative_time.php";

$bdd = get_connection();

$profile_views = array();
$likes = array();
$matches = array();

$stmt_profile_views = $bdd->prepare("SELECT users.first_name, users.image1, notif_profile_views.id, notif_profile_views.dateadded, notif_profile_views.from_user, notif_profile_views.to_user, notif_profile_views.seen FROM notif_profile_views
        LEFT JOIN users ON notif_profile_views.from_user=users.id WHERE notif_profile_views.to_user='$_SESSION[user_id]'ORDER BY notif_profile_views.dateadded DESC;");
$stmt_profile_views->execute();
while (($query = $stmt_profile_views->fetch())) {
    $profile_view;
    $profile_view["relative_date"] = get_relative_time($query["dateadded"]);
    $profile_view["from"] = $query["first_name"];
    $profile_view["from_id"] = $query["from_user"];
    $profile_view["img"] = $query["image1"];
    $profile_view["id"] = $query["id"];
    array_push($profile_views, $profile_view);
}

$stmt_likes = $bdd->prepare("SELECT users.first_name, users.image1, notif_likes.id, notif_likes.dateadded, notif_likes.from_user, notif_likes.to_user, notif_likes.seen, notif_likes.active FROM notif_likes
        LEFT JOIN users ON notif_likes.from_user=users.id WHERE notif_likes.to_user='$_SESSION[user_id]' ORDER BY notif_likes.dateadded DESC;");
$stmt_likes->execute();
while (($query = $stmt_likes->fetch())) {
    $like;
    $like["relative_date"] = get_relative_time($query["dateadded"]);
    $like["from"] = $query["first_name"];
    $like["from_id"] = $query["from_user"];
    $like["img"] = $query["image1"];
    $like["id"] = $query["id"];
    $like["active"] = $query["active"];
    array_push($likes, $like);
}

$stmt_matches = $bdd->prepare("SELECT users.first_name, users.image1, notif_matches.id, notif_matches.dateadded, notif_matches.from_user, notif_matches.to_user, notif_matches.seen FROM notif_matches
        LEFT JOIN users ON notif_matches.from_user=users.id WHERE notif_matches.to_user='$_SESSION[user_id]' ORDER BY notif_matches.dateadded DESC;");
    $stmt_matches->execute();
    while (($query = $stmt_matches->fetch())) {
        $match;
        $match["relative_date"] = get_relative_time($query["dateadded"]);
        $match["from"] = $query["first_name"];
        $match["from_id"] = $query["from_user"];
        $match["img"] = $query["image1"];
        $match["id"] = $query["id"];
        array_push($matches, $match);
    }

$focus = "profile_views";

if (isset($_SESSION["notify_focus"])) {
    $focus = $_SESSION["notify_focus"];
}
?>
<body class="bodyProfile">
    <div class="container-fluid" style="margin-top: 56px;">
        <div class="title" id="notifyTitle">Vos notifs <div class="nameUser"><?=$_SESSION["user"]?></div></div>
        <div class="row">
            <div class="notify row">
                <div class="col-md-3 col-xs-12" id="borderNotify">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="margin-bottom: 5px;">
                    <a onclick="viewsClick();" class="nav-link <?php echo ($focus == 'profile_views' ? "active" : ""); ?>" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="<?php echo ($focus == 'profile_views' ? "true" : "false"); ?>">Vues</a>
                    <a onclick="likesClick();" class="nav-link <?php echo ($focus == 'likes' ? "active" : ""); ?>" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="<?php echo ($focus == 'likes' ? "true" : "false"); ?>">Likes</a>
                    <a onclick="matchesClick();" class="nav-link <?php echo ($focus == 'matches' ? "active" : ""); ?>" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="<?php echo ($focus == 'matches' ? "true" : "false"); ?>">Matchs</a>
                   <!-- <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Chats</a>-->
                    </div>
                </div>
                <div class="col-md-9 col-xs-12">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade <?php echo ($focus == 'profile_views' ? "show active" : ""); ?>" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <?php
                            foreach ($profile_views as &$value) {
                                echo '<div id="vue1" style="border-bottom: 1px solid lightgrey;">
                                        <a class="dropdown-item wsInitial" href="/usersProfiles/index.php?user_id='.$value["from_id"].'">
                                            <img class="image-circle" alt="100x100" src="'.$value["img"].'" data-holder-rendered="true">
                                            <div class="nameNotif text-break">'.$value["from"].' a visité votre profile</div>
                                            <div class="showTimeFrom">'.$value["relative_date"].'</div>
                                        </a>
                                    </div>';
                            }
                            ?>
                        </div>
                        <div class="tab-pane fade <?php echo ($focus == 'likes' ? "show active" : ""); ?>" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <?php
                            foreach ($likes as &$value) {
                                $like_type = "a liké";
                                if ($value["active"] == 0) {
                                    $like_type = "ne like plus";
                                }
                                echo '<div id="vue1" style="border-bottom: 1px solid lightgrey;">
                                        <a class="dropdown-item wsInitial" href="/usersProfiles/index.php?user_id='.$value["from_id"].'">
                                            <img class="image-circle" alt="100x100" src="'.$value["img"].'" data-holder-rendered="true">
                                            <div class="nameNotif text-break">'.$value["from"].' '.$like_type.' votre profile</div>
                                            <div class="showTimeFrom">'.$value["relative_date"].'</div>
                                        </a>
                                    </div>';
                            }
                            ?>
                        </div>
                        <div class="tab-pane fade <?php echo ($focus == 'matches' ? "show active" : ""); ?>" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                            <?php
                            foreach ($matches as &$value) {
                                echo '<div id="vue1" style="border-bottom: 1px solid lightgrey;">
                                        <a class="dropdown-item wsInitial" href="/usersProfiles/index.php?user_id='.$value["from_id"].'">
                                            <img class="image-circle" alt="100x100" src="'.$value["img"].'" data-holder-rendered="true">
                                            <div class="nameNotif text-break">Vous avez matché avec '.$value["from"].'</div>
                                            <div class="showTimeFrom">'.$value["relative_date"].'</div>
                                        </a>
                                    </div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function viewsClick() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'http://localhost/php/notifications/views_seen.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send();
        }

        function likesClick() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'http://localhost/php/notifications/likes_seen.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send();
        }

        function matchesClick() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'http://localhost/php/notifications/matches_seen.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send();
        }
    </script>
</body>