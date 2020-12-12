<?php
include "../php/database/sql.php";
include "../php/utils/relative_time.php";

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
    $stmt_user = $bdd->prepare("SELECT * FROM users WHERE id=$user_id_secure;");
    $stmt_user->execute();

    if (($query = $stmt_user->fetch())) {
        $user_infos = $query;
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
              </svg>Last connected '.get_relative_time($user_infos["last_activity"]).'</div>';
            }
            ?>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-12 py-2 d-flex align-items-center justify-content-center fixed-top"  id="left" >
                <div class="card">
                    <img class="card-img-top" src="<?php echo $user_infos["image1"] ?>" alt="Card image cap">
                    <div class="card-body">
                        <div class="nomAge"><?php echo $user_infos["first_name"]." ".$user_infos["last_name"].", ".$user_infos["age"]." ans"; ?></div>
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
                </div>
                <div id="mapid"></div>
                <script>
                    var latitude = <?php echo $user_infos["latitude"]; ?>;
                    var longitude = <?php echo $user_infos["longitude"]; ?>;
                    var mymap = L.map('mapid').setView([latitude, longitude], 13);
                    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoiendva2Fyb3MiLCJhIjoiY2tpaXNyMzU1MGtpNTJ6bng4dnlxbXIwbiJ9.CySuMYQGv9x4ToM5s47WRg', {
                        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                        maxZoom: 18,
                        id: 'mapbox/streets-v11',
                        tileSize: 512,
                        zoomOffset: -1,
                        accessToken: 'your.mapbox.access.token'
                    }).addTo(mymap);

                    if ("geolocation" in navigator) {
                        navigator.geolocation.getCurrentPosition(function(position) {
                            mymap.setView([latitude, longitude], 13);
                            L.marker([latitude, longitude]).addTo(mymap);
                        });
                    } else {
                    /* la géolocalisation n'est pas disponible */
                    }
                    
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
                <div class="">
                    <h5>Bio : </h5>
                    <p class="font-weight-lighter"><?php echo $user_infos["bio"]; ?></p>
                </div>
                <br >
                <div style="border-bottom:1px solid rgba(0,0,0,.125);"></div>
                <br >
                <div class="">
                    <h5>Intéressé par : </h5>
                    <p class="font-weight-lighter">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
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
</body>