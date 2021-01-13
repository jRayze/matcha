<link rel="stylesheet" href="/css/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin="">
</script>
<body class="bodyProfile">
    <div class="container-fluid" style="margin-top: 56px;">
        <div class="title">
            Profile de <div class="nameUser"><?=$_SESSION["user"]?></div>
        </div>
        <div class="col missing-infos">
            <?php
            if (isset($_SESSION["missing_profile_infos"]) && count($_SESSION["missing_profile_infos"]) > 0) {
                echo '<div class="row missing-info-title">Informations manquantes:</div>';
                foreach ($_SESSION["missing_profile_infos"] as &$value) {
                    echo '<div class="row missing-info-item">• '.$value.'</div>';
                }
            }
            ?>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-12 py-2 d-flex align-items-center justify-content-center fixed-top"  id="left" >
                <div class="card">
                    <img class="card-img-top" src="<?php echo $_SESSION["db_infos"]["image1"];?>" alt="Card image cap">
                    <div class="card-body">
                        <div class="nomAge"><?php echo $_SESSION["db_infos"]["first_name"]." ".$_SESSION["db_infos"]["last_name"].", ".$_SESSION["db_infos"]["age"]." ans";?></div>
                        <div class="genre"><?php echo $_SESSION["db_infos"]["sexual_orientation"]; ?></div>
                        <div class="rating" style="margin: auto; padding-bottom: 5px;">
                            <?php
                            for ($i = 0; $i < 5; $i++) {
                                if ($_SESSION["db_infos"]["popularity"] > $i) {
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
                                $interests = explode(",", $_SESSION["db_infos"]["interests"]);
                                foreach ($interests as &$interest) {
                                    echo '<span class="badge badge-pill badge-primary">'.$interest.'</span>';
                                }
                            ?>
                        </li>
                    </ul>
                </div>
                <div id="mapid"></div>
                <script>
                    var defaultLatitude = 48.8553944;
                    var defaultLongitude = 2.3542705;
                    var latitude = <?php echo ($_SESSION["db_infos"]["latitude"] == null ? 0 : $_SESSION["db_infos"]["latitude"]); ?>;
                    var longitude = <?php echo ($_SESSION["db_infos"]["longitude"] == null ? 0 : $_SESSION["db_infos"]["longitude"]); ?>;
                    var mymap = L.map('mapid').setView([latitude, longitude], 13);
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
                        L.marker([latitude, longitude]).addTo(mymap);
                    }
                    
                </script>
            </div>
            <div class="col-md-9 offset-md-3 offset-sm-12 py-2" id="main" >
                <h5>Sécurité</h5>
                <div class="form-group">
                    <label for="exampleInputEmail1">Adresse email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" disabled value="<?php echo $_SESSION["db_infos"]["email"]; ?>">
                    <a href="#">
                        <button style="margin-top:5px;" type="submit" class="btn btn-primary">Changer adresse email</button>
                    </a>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Mot de passe</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" aria-describedby="emailHelp" disabled value="**********">
                    <a href="#">
                        <button style="margin-top:5px;" type="submit" class="btn btn-primary">Changer mot de passe</button>
                    </a>
                </div>
                <br >
                <div style="border-bottom:solid 1px grey;"></div>
                <br >
                <h5>Vos coordonnées</h5>                
                <form class="">
                    <div class="form-row">
                        <div class="col">
                            <label for="prenom">Prénom</label>
                            <input type="text" class="form-control" id="prenom" placeholder="First name" value="<?php echo $_SESSION["db_infos"]["first_name"]; ?>">
                        </div>
                        <div class="col">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control" id="nom" placeholder="Last name" value="<?php echo $_SESSION["db_infos"]["last_name"]; ?>">
                        </div>
                    </div>
                    <button style="margin-top:5px;" type="submit" class="btn btn-primary">Valider</button>
                </form>
                <br >
                <div style="border-bottom:solid 1px grey;"></div>
                <br >
                <h5>Votre profil</h5>
                <br >
                <label for="validateCustomFile">Vos photos : </label>
                <div class="col">
                    <div class="col">
                        <img src="<?php echo $_SESSION["db_infos"]["image1"]; ?>" id="img1" alt="Image 1" class="img-thumbnail img-thumbnail-selected" style="width: 300px; margin-bottom: 10px;">
                        <img src="<?php echo $_SESSION["db_infos"]["image2"]; ?>" id="img2" alt="Image 2" class="img-thumbnail" style="width: 200px; margin-bottom: 10px;">
                        <img src="<?php echo $_SESSION["db_infos"]["image3"]; ?>" id="img3" alt="Image 3" class="img-thumbnail" style="width: 200px; margin-bottom: 10px;">
                        <img src="<?php echo $_SESSION["db_infos"]["image4"]; ?>" id="img4" alt="Image 4" class="img-thumbnail" style="width: 200px; margin-bottom: 10px;">
                        <img src="<?php echo $_SESSION["db_infos"]["image5"]; ?>" id="img5" alt="Image 5" class="img-thumbnail" style="width: 200px; margin-bottom: 10px;">
                    </div>
                    <form action="/php/account/upload_picture.php" method="POST" enctype="multipart/form-data">
                        <div class="col">
                            <select name='imageSelect' onchange="imgSelectChanged(this);" class="form-select" aria-label="Default select example">
                                <option selected value="1">Image1</option>
                                <option value="2">Image2</option>
                                <option value="3">Image3</option>
                                <option value="4">Image4</option>
                                <option value="5">Image5</option>
                            </select>
                        </div>
                        <div class="custom-file mb-3">
                            <input name="image" type="file" class="custom-file-input" id="validatedCustomFile" required>
                            <label class="custom-file-label" for="validatedCustomFile">Selectionnez une photo...</label>
                            <div class="invalid-feedback">Selectionnez des photos au format .jpeg, .png, .gif.</div>
                        </div>
                        <button style="margin-top:5px;" type="submit" class="btn btn-primary">Valider</button>
                    </form>

                    <label for="customControlValidation2" for="customControlValidation3" for="customControlValidation1">Orientation Sexuelle</label>
                    <div class="custom-control custom-radio">
                        <input <?php echo ($_SESSION["db_infos"]["sexual_orientation"] == "heterosexual" ? "checked" : ""); ?> type="radio" class="custom-control-input" id="customControlValidation2" name="radio-stacked" required>
                        <label class="custom-control-label" for="customControlValidation2">Hétérosexuel</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input <?php echo ($_SESSION["db_infos"]["sexual_orientation"] == "homosexual" ? "checked" : ""); ?> type="radio" class="custom-control-input" id="customControlValidation3" name="radio-stacked" required>
                        <label class="custom-control-label" for="customControlValidation3">Homosexuel</label>
                    </div>
                    <div class="custom-control custom-radio mb-3">
                        <input <?php echo ($_SESSION["db_infos"]["sexual_orientation"] == "bisexual" ? "checked" : ""); ?> type="radio" class="custom-control-input" id="customControlValidation1" name="radio-stacked" required>
                        <label class="custom-control-label" for="customControlValidation1">Bisexuel</label>
                        <div class="invalid-feedback">Selectionnez votre orientation sexuelle.</div>
                    </div>

                    <label for="custom-select">Age</label>
                    <div class="mb-3">
                        <select class="custom-select" required>
                        <option></option> 
                        <?php
                        for ($x = 18; $x <= 100; $x++) {
                            $selected = "";
                            if ($_SESSION["db_infos"]["age"] == $x) {
                                $selected = 'selected="selected"';
                            }
                            echo '<option '.$selected.' value="'.$x.'">'.$x.'</option>';
                          }
                        ?>

                        </select>
                        <div class="invalid-feedback">Selectionnez votre genre.</div>
                    </div>

                    <label for="custom-select">Genre</label>
                    <div class="mb-3">
                        <select class="custom-select" required>
                        <option></option> 
                        <option  <?php echo ($_SESSION["db_infos"]["gender"] == "male" ? 'selected="selected"' : ""); ?>  value="1">Homme</option>
                        <option  <?php echo ($_SESSION["db_infos"]["gender"] == "female" ? 'selected="selected"' : ""); ?>  value="2">Femme</option>
                        </select>
                        <div class="invalid-feedback">Selectionnez votre genre.</div>
                    </div>

                    <div class="mb-3">
                        <label for="validationTextarea">Bio</label>
                        <textarea class="form-control is-invalid" id="validationTextarea" placeholder="Présentez-vous en quelque mots" required><?php echo $_SESSION["db_infos"]["bio"]; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="formControlRange" class="labelForm">Centre d'intérêts :</label>
                        <div class="tagsHobby" id="tagFilters">
                            <span onclick="tagClicked(this);" class="badge badge-pill badge-primary badge-item-<?php echo (strpos($_SESSION["db_infos"]["interests"], "Sport", 0) !== false ? "active" : "inactive"); ?>">Sport</span>
                            <span onclick="tagClicked(this);" class="badge badge-pill badge-primary badge-item-<?php echo (strpos($_SESSION["db_infos"]["interests"], "Voyage", 0) !== false ? "active" : "inactive"); ?>">Voyage</span>
                            <span onclick="tagClicked(this);" class="badge badge-pill badge-primary badge-item-<?php echo (strpos($_SESSION["db_infos"]["interests"], "Cinema", 0) !== false ? "active" : "inactive"); ?>">Cinéma</span>
                            <span onclick="tagClicked(this);" class="badge badge-pill badge-primary badge-item-<?php echo (strpos($_SESSION["db_infos"]["interests"], "Jeux , 0video") ? "active" : "inactive"); ?>">Jeux video</span>
                            <span onclick="tagClicked(this);" class="badge badge-pill badge-primary badge-item-<?php echo (strpos($_SESSION["db_infos"]["interests"], "Litterature", 0) !== false ? "active" : "inactive"); ?>">Litterature</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

function imgSelectChanged(select) {
    var imgId = parseInt(select.value);
    for (var i = 1; i < 6; i++) {
        document.getElementById("img" + i).classList.remove("img-thumbnail-selected");
    }
    document.getElementById("img" + imgId).classList.add("img-thumbnail-selected");
}

function tagClicked(span) {
    var tag = span.innerText;
    if (tag != undefined) {
        console.log(span.classList);
        var newClass = "badge-item-active";
        if (span.classList.contains("badge-item-active")) {
            span.classList.remove("badge-item-active");
            newClass = "badge-item-inactive";
        } else {
            span.classList.remove("badge-item-inactive");
        }
        span.classList.add(newClass);
    }
}
    </script>
</body>