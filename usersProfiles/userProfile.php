<?php
include "../php/database/sql.php";
include "../php/utils/relative_time.php";
include "../php/utils/report_list.php";
$user_infos = null;

$sexual_orientation_french = array(
    "homosexual" => "Homosexuel",
    "bisexual" => "Bisexuel",
    "heterosexual" => "Heterosexuel"
);

$gender_french = array(
    "male" => "Homme",
    "female" => "Femme"
);

if (isset($_GET["user_id"]) && is_numeric($_GET["user_id"])) {
    $user_id_secure = intval($_GET["user_id"]);

    $bdd = get_connection();
    $stmt_user = $bdd->prepare("SELECT * FROM users WHERE id=$user_id_secure AND profile_complete=1;");
    $stmt_user->execute();

    if (($query = $stmt_user->fetch())) {
        $user_infos = $query;

        if ($_SESSION["user_id"] != $user_id_secure) {
            $stmt_check_profile_view = $bdd->prepare("SELECT * FROM notif_profile_views WHERE from_user=$_SESSION[user_id] AND to_user=$user_id_secure;");
            $stmt_check_profile_view->execute();
            if (!($query = $stmt_check_profile_view->fetch())) {
                $stmt_add_profile_view = $bdd->prepare("INSERT INTO notif_profile_views (from_user, to_user, seen) VALUES ($_SESSION[user_id], $user_id_secure, 0);");
                $stmt_add_profile_view->execute();
            }

            $user_infos["liked"] = false;
            $stmt_check_like = $bdd->prepare("SELECT * FROM notif_likes WHERE from_user=$_SESSION[user_id] AND to_user=$user_id_secure AND active=1;");
            $stmt_check_like->execute();
            if (($query = $stmt_check_like->fetch())) {
                $user_infos["liked"] = true;
            }

            $user_infos["matched"] = false;
            $stmt_check_match = $bdd->prepare("SELECT * FROM notif_matches WHERE from_user=$_SESSION[user_id] AND to_user=$user_id_secure;");
            $stmt_check_match->execute();
            if (($query = $stmt_check_match->fetch())) {
                $user_infos["matched"] = true;
            }
        }
    }
}
if ($user_infos === null) {
    $bdd = get_connection();
    $stmt_user = $bdd->prepare("SELECT * FROM users WHERE id=$_SESSION[user_id];");
    $stmt_user->execute();
    $query = $stmt_user->fetch();
    $user_infos = $query;
}
?>
<script>
var userId = <?php echo $user_infos["id"]; ?>;
</script>
<link rel="stylesheet" href="/css/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin="">
</script>
<body class="bodyProfile">
    <div class="container-fluid" style="margin-top: 56px;">
        <div class="title" >Profile de <div class="nameUser"><?php echo $user_infos["first_name"]; ?></div>
        
            <?php
            $online = false;
            $current_date = new DateTime(date('m/d/Y h:i:s a', time()));
            $target_date = new DateTime($user_infos["last_activity"], new DateTimeZone('Europe/Paris'));

            $diff = $current_date->diff($target_date);

            if ($diff->y == 0 &&
                $diff->m == 0 &&
                $diff->d == 0 &&
                $diff->h == 0 &&
                $diff->i == 0) {
                    $online = true;
                }
            
            if ($online) { 
                echo '<div class="connected" style="font-size: 12px; color: #28a745; margin-top: auto; margin-bottom: auto; margin-left: 10px;"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><circle cx="8" cy="8" r="8"></circle></svg></div>';
            }
            else {
                echo '<div class="disconnected" style="font-size: 12px; color: #28a745; margin-top: auto; margin-bottom: auto; margin-left: 10px; color: lightgrey;"><svg style="color: black;" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
              </svg> Last connected '.get_relative_time($user_infos["last_activity"]).'</div>';
            }
            ?>
        </div>
        <div class="title" style="color:red;">
            <?php
            if ($user_infos["under_investigation"] == 1) {
                echo "Ce profil est en cours d'investigation";
            }
            ?>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-12 py-2 d-flex align-items-center justify-content-center fixed-top"  id="left" >
                <div class="card">
                    <img class="card-img-top" src="<?php echo $user_infos["image1"] ?>" alt="Card image cap">
                    <div class="card-body">
                        <div class="nomAge"><?php echo $user_infos["first_name"]." ".$user_infos["last_name"].", ".$user_infos["age"]." ans"; ?></div>
                        <div>
                            <?php
                            if ($user_infos["id"] != $_SESSION["user_id"] && isset($_SESSION["distances"][$user_infos["id"]])) {
                                echo $_SESSION["distances"][$user_infos["id"]]." km";
                            }
                            ?>
                        </div>
                        <div class="genre"><?php echo $sexual_orientation_french[$user_infos["sexual_orientation"]]; ?></div>
                        <div class="rating" style="margin: auto; padding-bottom: 5px;">
                            <?php
                            for ($i = 0; $i < 5; $i++) {
                                if ($user_infos["popularity"] > $i) {
                                    echo '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-star-fill" fill="#dbb718" xmlns="http://www.w3.org/2000/svg">';
                                        echo '<path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>';
                                    echo '</svg>';
                                } else {
                                    echo '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-star" fill="currentColor" xmlns="http://www.w3.org/2000/svg">';
                                        echo '<path fill-rule="evenodd" d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>';
                                    echo '</svg>';
                                }
                            }
                            ?>
                        </div>                        
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                        <?php
                            $interests = explode(",", $user_infos["interests"]);
                            foreach ($interests as &$interest) {
                                echo '<span class="badge badge-pill badge-primary">'.$interest.'</span>';
                            }
                        ?>
                        </li>
                    </ul>
                    
                    <div <?php echo ($user_infos["id"] == $_SESSION["user_id"] ? 'style="display:none;"' : ''); ?>>
                        <div class="row align-items-center justify-content-center">
                            <button onclick="blockUser(this);" style="width:49%; margin: 2px;" id="bloquer" type="button" class="btn btn-danger">
                                <?php
                                    if (in_array($user_infos["id"], $_SESSION["blocked_users"])) {
                                        echo "Débloquer";
                                    } else {
                                        echo "Bloquer";
                                    }
                                ?>
                            </button>
                        </div>
                        <div class="row align-items-center justify-content-center">
                            <button style="width:49%; margin: 2px;" id="signaler" type="button" class="btn btn-warning">Signaler</button>
                        </div>
                    </div>
                </div>
                <div class="report">
                    <dialog id="favDialog" style="border: 1px solid lightgray; margin: auto; font-family: inherit;">
                        <form method="dialog">
                            <p><label>Motif du signalement :
                            <select>
                                <?php
                                foreach ($report_list as &$value) {
                                    echo '<option>'.$value.'</option>';
                                }
                                ?>
                            </select>
                            </label></p>
                            <menu>
                            <button class="btn btn-danger" value="cancel">Annuler</button>
                            <button onclick="reportUser(this);" class="btn btn-primary" id="confirmBtn" value="default">Confirmer</button>
                            </menu>
                        </form>
                    </dialog>
                </div>
                <script>
                        (function() {
                        var updateButton = document.getElementById('signaler');
                        var favDialog = document.getElementById('favDialog');
                        var outputBox = document.getElementsByTagName('output')[0];
                        var selectEl = document.getElementsByTagName('select')[0];
                        var confirmBtn = document.getElementById('confirmBtn');

                        // Le bouton "mettre à jour les détails" ouvre la boîte de dialogue
                        updateButton.addEventListener('click', function onOpen() {
                            if (typeof favDialog.showModal === "function") {
                            favDialog.showModal();
                            } else {
                            console.error("L'API dialog n'est pas prise en charge par votre navigateur");
                            }
                        });
                        // Le champ "animal préféré" définit la valeur pour le bouton submit
                        selectEl.addEventListener('change', function onSelect(e) {
                            confirmBtn.value = selectEl.value;
                        });
                        // Le bouton "Confirmer" déclenche l'évènement "close" sur le dialog avec [method="dialog"]
                        favDialog.addEventListener('close', function onClose() {
                            if (outputBox != undefined) {
                                outputBox.value = "Vous avez cliqué sur le bouton " + favDialog.returnValue + " !";
                            }
                        });
                        })();
                </script>
            </div>
            <div class="col-md-9 offset-md-3 offset-sm-12 py-2" id="main">
                <div id="carouselExampleIndicators" class="carousel slide carousselMedia" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                    </ol>
                    <div class="carousel-inner" style="margin: auto;">
                        <div class="carousel-item active">
                            <img src="<?php echo $user_infos["image1"]; ?>" alt="..." class="img-thumbnail" style="margin: auto; width: auto;">
                            <!--<img src="..." class="d-block w-100" alt="...">-->
                        </div>
                        <div class="carousel-item">
                            <img src="<?php echo $user_infos["image2"]; ?>" alt="..." class="img-thumbnail" style="margin: auto; width: auto;">
                            <!--<img src="..." class="d-block w-100" alt="...">-->
                        </div>
                        <div class="carousel-item">
                            <img src="<?php echo $user_infos["image3"]; ?>" alt="..." class="img-thumbnail" style="margin: auto; width: auto;">
                            <!--<img src="..." class="d-block w-100" alt="...">-->
                        </div>
                        <div class="carousel-item">
                            <img src="<?php echo $user_infos["image4"]; ?>" alt="..." class="img-thumbnail" style="margin: auto; width: auto;">
                            <!--<img src="..." class="d-block w-100" alt="...">-->
                        </div>
                        <div class="carousel-item">
                            <img src="<?php echo $user_infos["image5"]; ?>" alt="..." class="img-thumbnail" style="margin: auto; width: auto;">
                            <!--<img src="..." class="d-block w-100" alt="...">-->
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <div class="rating" style="margin: auto; padding-bottom: 5px; text-align: center;">
                    <?php
                    for ($i = 0; $i < 5; $i++) {
                        if ($user_infos["popularity"] > $i) {
                            echo '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-star-fill" fill="#dbb718" xmlns="http://www.w3.org/2000/svg">';
                                echo '<path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>';
                            echo '</svg>';
                        } else {
                            echo '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-star" fill="currentColor" xmlns="http://www.w3.org/2000/svg">';
                                echo '<path fill-rule="evenodd" d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>';
                            echo '</svg>';
                        }
                    }
                    ?>
                </div>
                <br >
                <div style="border-bottom:1px solid rgba(0,0,0,.125);"></div>
                <br >
                <div class="row text-center" <?php echo (!isset($user_infos["matched"]) || !$user_infos["matched"] ? 'style="display:none;"' : 'style="font-weight: bold;"'); ?>>
                    <div class="col">
                        C'est un match!
                    </div>
                </div>
                <div class="row text-center" <?php echo ($user_infos["id"] == $_SESSION["user_id"] ? 'style="display:none;"' : ''); ?>>
                    <div id="likeButton" class="col" <?php echo (!isset($user_infos["liked"]) || $user_infos["liked"] ? 'style="display:none;"' : ''); ?>>
                        <button  type="button" onclick="likeProfile();" class="btn btn-primary">Like</button>
                    </div>
                    <div id="removeLikeButton" class="col" <?php echo (!isset($user_infos["liked"]) || !$user_infos["liked"] ? 'style="display:none;"' : ''); ?>>
                        <button type="button" onclick="unlikeProfile();" class="btn btn-primary">Remove Like</button>
                    </div>
                    <div class="col" <?php echo (!isset($user_infos["matched"]) || !$user_infos["matched"] ? 'style="display:none;"' : ''); ?>>
                        <a href="/php/redirections/chat_conv.php?conv_id=<?php echo $user_infos["id"]; ?>">
                            <button type="button" class="btn btn-primary">Chat</button>
                        </a>
                    </div>
                </div>
                <br >
                <div style="border-bottom:1px solid rgba(0,0,0,.125);"></div>
                <br >
                <div class="">
                    <div id="mapUserProfile"></div>
                    <script>
                        var defaultLatitude = 48.8553944;
                        var defaultLongitude = 2.3542705;
                        var latitude = <?php echo ($user_infos["latitude"] == null ? 0 : $user_infos["latitude"]); ?>;
                        var longitude = <?php echo ($user_infos["longitude"] == null ? 0 : $user_infos["longitude"]); ?>;
                        var mymap = L.map('mapUserProfile').setView([latitude, longitude], 13);
                        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoiendva2Fyb3MiLCJhIjoiY2tpaXNyMzU1MGtpNTJ6bng4dnlxbXIwbiJ9.CySuMYQGv9x4ToM5s47WRg', {
                            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                            maxZoom: 18,
                            id: 'mapbox/streets-v11',
                            tileSize: 512,
                            zoomOffset: -1,
                            accessToken: 'your.mapbox.access.token'
                        }).addTo(mymap);
                        if (latitude == 0 && longitude == 0) {
                            mymap.setView([defaultLatitude, defaultLongitude], 13);
                        } else {
                            mymap.setView([latitude, longitude], 13);
                            L.circle([latitude, longitude], {radius: 400}).addTo(mymap);
                        }
                    </script>
                </div>
                <br >
                <div style="border-bottom:1px solid rgba(0,0,0,.125);"></div>
                <br >
                <div class="">
                    <h5>Bio : </h5>
                    <p class="font-weight-lighter"><?php echo $user_infos["bio"]; ?></p>
                </div>
                <br >
                <div style="border-bottom:1px solid rgba(0,0,0,.125);"></div>
                <br >
                <div class="">
                    <h5>Age : </h5>
                    <p class="font-weight-lighter"><?php echo $user_infos["age"]; ?> ans.</p>
                </div>
                <br >
                <div style="border-bottom:1px solid rgba(0,0,0,.125);"></div>
                <br >
                <div class="">
                    <h5>Genre : </h5>
                    <p class="font-weight-lighter"><?php echo $gender_french[$user_infos["gender"]]; ?></p>
                </div>
                <br >
                <div style="border-bottom:1px solid rgba(0,0,0,.125);"></div>
                <br >
                <div class="">
                    <h5>Orientation sexuelle : </h5>
                    <p class="font-weight-lighter"><?php echo $sexual_orientation_french[$user_infos["sexual_orientation"]]; ?></p>
                </div>
                <br >
                <div style="border-bottom:1px solid rgba(0,0,0,.125);"></div>
                <br >
                <div class="">
                    <h5>Tags : </h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <?php
                                $interests = explode(",", $user_infos["interests"]);
                                foreach ($interests as &$interest) {
                                    echo '<span class="badge badge-pill badge-primary">'.$interest.'</span>';
                                }
                            ?>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <script>
        function reportUser(button) {
            console.log(button);
            if (userId != undefined) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'http://localhost/php/interactions/report_user.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function () {
                    console.log(this.responseText);
                };
                xhr.send('user_id=' + userId + '&reason=' + button.value);
            }
        }
        function unlikeProfile() {
            if (userId != undefined) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'http://localhost/php/interactions/remove_like_user.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function () {
                    document.getElementById("likeButton").style.display = "";
                    document.getElementById("removeLikeButton").style.display = "none";
                };
                xhr.send('user_id=' + userId);
            }
        }
        function likeProfile() {
            if (userId != undefined) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'http://localhost/php/interactions/like_user.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function () {
                    var result = JSON.parse(this.responseText);
                    console.log(result);
                    if (result.liked) {

                        document.getElementById("likeButton").style.display = "none";
                        document.getElementById("removeLikeButton").style.display = "";
                    }
                };
                xhr.send('user_id=' + userId);
            }
        }
        function blockUser(blockButton) {
            if (blockButton.innerText == "Bloquer") {
                if (userId != undefined) {
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'http://localhost/php/interactions/block_user.php', true);
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.onload = function () {
                        var result = JSON.parse(this.responseText);
                        if (result.blocked) {
                            blockButton.innerText = "Débloquer";
                        }
                    };
                    xhr.send('user_id=' + userId);
                }
            } else if (blockButton.innerText == "Débloquer") {
                if (userId != undefined) {
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'http://localhost/php/interactions/unblock_user.php', true);
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.onload = function () {
                        var result = JSON.parse(this.responseText);
                        if (!result.blocked) {
                            blockButton.innerText = "Bloquer";
                        }
                    };
                    xhr.send('user_id=' + userId);
                }
            }
        }
    </script>
</body>