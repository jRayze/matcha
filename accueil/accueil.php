<?php
$_SESSION["max_results"] = 12;
?>
<body class="bodyAccueil">
    <div class="container-fluid" style="margin-top: 56px;">
        <div id="resultCount" class="title">0 Résultats</div></div>
        <div class="row" >
            <div class="col-md-3 col-sm-12 py-2 d-flex align-items-center justify-content-center fixed-top" id="left" >
                <div class="card mx-auto text-center" >
                    <!-- Liste des filtres (par défaut) : 
                        1 .orientation sexuelle(bouton radio) : bisexuel(par défaut), hétérosexuel, homosexuel  | 2. distance en km (range line)  | 3. centres d'intéret (bouton tag) | 4. score de popularité (5 étoiles cliquables)
                        Liste de filtes ajustable :
                        1.interval d'age (range line) | 2. score de popularité (5 étoiles cliquables) | 3. distance en km (range line) | 4. centres d'intéret (bouton tag)  -->
                    <div class="card-body">
                        <form>
                            <h5> Afinez votre recherche</h4>
                            <div class="form-group">
                                <label class="labelForm">Age :</label><br >
                                <div id="ageMin"></div>
                                <div id="ageMax"></div>
                                <div>
                                    <div class="middle">
                                        <div class="multi-range-slider">
                                            <input title="25" type="range" id="input-left" min="18" max="100" value="25" style="-webkit-appearance: none;">
                                            <input title="50" type="range" id="input-right" min="18" max="100" value="50" style="-webkit-appearance: none;">
                                            <div class="slider">
                                                <div class="track"></div>
                                                <div class="range"></div>
                                                <div class="thumb left"></div>
                                                <div class="thumb right"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="align-text: left; display: inline-block; float: left;margin: 2px;">
                                        <div style="font-size: 12px; color: lightslategrey;">
                                            18 
                                        </div>
                                    </div>
                                    <div style="align-text: right;display: inline-block; float: right;margin: 2px;">
                                        <div style="font-size: 12px; color:lightslategrey;">
                                            100
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="labelForm">Distance (en km) :</label>
                                <div></div>
                                <input type="range" class="custom-range" min="1" max="350" id="customRange2">
                                <div style="align-text: left; display: inline-block; float: left;">
                                    <div style="font-size: 12px; color: lightslategrey;">
                                        1  
                                    </div>
                                </div>
                                <div style="align-text: right;display: inline-block; float: right;">
                                    <div style="font-size: 12px; color: lightslategrey;">
                                        >= 350
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="formControlRange" class="labelForm">Orientation Sexuelle :</label><br >
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioInline1">Bisexuel</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioInline2">Hétérosexuel</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline3" name="customRadioInline1" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioInline3">Homosexuel</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="formControlRange" class="labelForm">Centre d'intérêts :</label>
                                <div class="tagsHobby" id="tagFilters">
                                    <span class="badge badge-pill badge-primary badge-item-active">Sport</span>
                                    <span class="badge badge-pill badge-primary badge-item-active">Voyage</span>
                                    <span class="badge badge-pill badge-primary badge-item-active">Cinema</span>
                                    <span class="badge badge-pill badge-primary badge-item-active">Jeux video</span>
                                    <span class="badge badge-pill badge-primary badge-item-active">Litterature</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="formControlRange" class="labelForm">Popularité :</label>
                                <div class="d-flex">
                                    <div class="rating" style="margin: auto; padding-bottom: 5px; ">
                                        <svg width="1em" height="1em" id="star-rating-1" onclick="updateRating(this);" viewBox="0 0 16 16" class="bi bi-star star-rating" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                                        </svg>
                                        <svg width="1em" height="1em"  id="star-rating-2" onclick="updateRating(this);" viewBox="0 0 16 16" class="bi bi-star star-rating" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                                        </svg>
                                        <svg width="1em" height="1em"  id="star-rating-3" onclick="updateRating(this);" viewBox="0 0 16 16" class="bi bi-star star-rating" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                                        </svg>
                                        <svg width="1em" height="1em"  id="star-rating-4" onclick="updateRating(this);" viewBox="0 0 16 16" class="bi bi-star star-rating" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                                        </svg>
                                        <svg width="1em" height="1em"  id="star-rating-5" onclick="updateRating(this);" viewBox="0 0 16 16" class="bi bi-star star-rating" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-m btn-primary rounded-pill btn-block" id="marge-bot" onclick="applyFilters(false);" type="button">Appliquer les filtres</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-9 offset-md-3 offset-sm-12 py-2" id="main">
                <div class="row" id="userCards" style="margin: 10px;">
                    
                </div>
                <button id="displayMoreButton" style="display:none;" class="btn btn-m btn-primary rounded-pill btn-block" id="marge-bot" onclick="applyFilters(true);" type="button">Afficher plus</button>
            </div>
        </div>
    </div>
    <script>

var filterTags = new Array();
var starRating = 0;
var svgBiStarFill = "M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z";
var svgBiStar = "M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z";

var inputLeft = document.getElementById("input-left");
var inputRight = document.getElementById("input-right");

var thumbLeft = document.querySelector(".slider > .thumb.left");
var thumbRight = document.querySelector(".slider > .thumb.right");
var range = document.querySelector(".slider > .range");

function getLeftValue() {
    var _this = inputLeft;
    return (Math.min(parseInt(_this.value), parseInt(inputRight.value) - 1));
}

function getRightValue() {
    var _this = inputRight;
    return (Math.max(parseInt(_this.value), parseInt(inputLeft.value) + 1));
}

function setLeftValue() {
	var _this = inputLeft,
		min = parseInt(_this.min),
		max = parseInt(_this.max);

	_this.value = Math.min(parseInt(_this.value), parseInt(inputRight.value) - 1);

	var percent = ((_this.value - min) / (max - min)) * 99;

	thumbLeft.style.left = percent + "%";
	range.style.left = percent + "%";
    document.getElementById('ageMin').innerHTML = 'Min :'+_this.value;
}

function updateLeftValue(ageMin) {
    var _this = inputLeft,
		min = parseInt(_this.min),
		max = parseInt(_this.max);

	_this.value = ageMin;

	var percent = ((_this.value - min) / (max - min)) * 99;

	thumbLeft.style.left = percent + "%";
	range.style.left = percent + "%";
    document.getElementById('ageMin').innerHTML = 'Min :'+_this.value;
}
setLeftValue();

function setRightValue() {
	var _this = inputRight,
		min = parseInt(_this.min),
		max = parseInt(_this.max);

	_this.value = Math.max(parseInt(_this.value), parseInt(inputLeft.value) + 1);

	var percent = ((_this.value - min) / (max - min)) * 100;

	thumbRight.style.right = (100 - percent) + "%";
	range.style.right = (100 - percent) + "%";
    document.getElementById('ageMax').innerHTML = 'Max :'+_this.value;
}

function updateRightValue(ageMax) {
    var _this = inputRight,
		min = parseInt(_this.min),
		max = parseInt(_this.max);

	_this.value = ageMax;

	var percent = ((_this.value - min) / (max - min)) * 100;

	thumbRight.style.right = (100 - percent) + "%";
	range.style.right = (100 - percent) + "%";
    document.getElementById('ageMax').innerHTML = 'Max :'+_this.value;
}
setRightValue();

inputLeft.addEventListener("input", setLeftValue);
inputRight.addEventListener("input", setRightValue);

function updateRating(start) {
    var newRating = parseInt(start.id.split("rating-")[1]);
    if (newRating != starRating) {
        for (var i = 1; i < 6; i++) {
            var star = document.getElementById("star-rating-" + i);
            star.classList.remove("bi-star");
            star.classList.remove("bi-star-fill");
            star.setAttribute("fill", "currentColor")
            if (i > newRating) {
                star.classList.add("bi-star");
                star.getElementsByTagName("path")[0].setAttribute("d", svgBiStar)
            } else {
                star.classList.add("bi-star-fill");
                star.setAttribute("fill", "#dbb718")
                star.getElementsByTagName("path")[0].setAttribute("d", svgBiStarFill)
            }
        }
        starRating = newRating;
    } else {
        starRating = 0;
        for (var i = 1; i < 6; i++) {
            var star = document.getElementById("star-rating-" + i);
            star.classList.remove("bi-star");
            star.classList.remove("bi-star-fill");
            star.setAttribute("fill", "currentColor")
            star.classList.add("bi-star");
            star.getElementsByTagName("path")[0].setAttribute("d", svgBiStar)
        }
    }
    
}

function userCard(user) {
    var html = "";
    html += '<div class="col-xl-3 col-md-4 col-sm-12" style="margin: 0px; padding-bottom: 15px;">';
        html += '<div class="card" style="height: 100%;">';
            html += '<a href="/usersProfiles/index.php?user_id=' + user.id + '"><img class="card-img-top" src="' + user.image + '" alt="Card image cap"></a>';
            html += '<div class="card-body">';
                html += '<div class="nomAge">' + user.fullname + ', ' + user.age + ' ans</div>';
                html += '<div>' + user.distance + ' km</div>';
                html += '<div class="genre">' + user.sexualOrientation + '</div>';
                html += '<div class="rating" style="margin: auto; padding-bottom: 5px;">';
                    for (var i = 0; i < 5; i++) {
                        if (user.popularity > i) {
                            html += '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-star-fill" fill="#dbb718" xmlns="http://www.w3.org/2000/svg">';
                                html += '<path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>';
                            html += '</svg>';
                        } else {
                            html += '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-star" fill="currentColor" xmlns="http://www.w3.org/2000/svg">';
                                html += '<path fill-rule="evenodd" d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>';
                            html += '</svg>';
                        }
                    }
                html += '</div>';
                //html += '<p class="card-text" style="font-size: 15px;">' + user.bio + '</p>';
            html += '</div>';
            html += '<ul class="list-group list-group-flush">';
                html += '<li class="list-group-item">';
                    user.interests.forEach(el => {
                        html += '<span class="badge badge-pill badge-primary">' + el + '</span>';
                    });
                html += '</li>';
            html += '</ul>';
        html += '</div>';
    html += '</div>';
    return (html);
}

function applyFilters(expand) {
    var _sexualOrientation = "heterosexual";

    if (document.getElementById("customRadioInline1").checked) {
        _sexualOrientation = "bisexual";
    } else if (document.getElementById("customRadioInline3").checked) {
        _sexualOrientation = "homosexual";
    }

    var filter = {
        ageMin: getLeftValue(),
        ageMax: getRightValue(),
        distanceMax: document.getElementById("customRange2").value,
        sexualOrientation: _sexualOrientation
    }
    //console.log(filter);
    var activeFilters = new Array();
    filterTags.forEach(el => {
        if (el.active) {
            activeFilters.push(el.name);
        }
    });

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://localhost/php/search/apply_filters.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        //console.log(this.responseText);
        reload_search_list();
    };
    xhr.send('filter_age_min=' + filter.ageMin +
            '&filter_age_max=' + filter.ageMax +
            '&filter_distance_max=' + filter.distanceMax +
            '&sexual_orientation=' + filter.sexualOrientation +
            '&tags=' + activeFilters.join(",") +
            '&popularity=' + starRating +
            '&expand_list=' + expand);
}

function reloadFilterTags() {
    var html = "";
    filterTags.forEach(el => {
        if (el.active) {
            html += '<span onclick="tagClicked(this);" class="badge badge-pill badge-primary badge-item-active">' + el.name + '</span>';
        } else {
            html += '<span onclick="tagClicked(this);" class="badge badge-pill badge-primary badge-item-inactive">' + el.name + '</span>';
        }
        
    });
    document.getElementById("tagFilters").innerHTML = html;
}

function load_filters(filters) {
    updateLeftValue(filters.filter_age_min);
    updateRightValue(filters.filter_age_max);
    document.getElementById("customRange2").value = filters.filter_distance_km;

    if (filters.sexual_orientation_filter == "bisexual") {
        document.getElementById("customRadioInline1").checked = true;
    } else if (filters.sexual_orientation_filter == "heterosexual") {
        document.getElementById("customRadioInline2").checked = true;
    } else {
        document.getElementById("customRadioInline3").checked = true;
    }
    reloadFilterTags();
}

function tagClicked(span) {
    var tag = filterTags.find(x => x.name == span.innerText);
    if (tag != undefined) {
        tag.active = !tag.active;
    }
    reloadFilterTags();
}

function reload_search_list() {
    document.getElementById("userCards").innerHTML = "";
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var result = JSON.parse(this.responseText);
            document.getElementById("resultCount").innerText = result.result_count + " Résultats";
            if (result.result_count > result.max_results) {
                document.getElementById("displayMoreButton").style.display = "";
            } else {
                document.getElementById("displayMoreButton").style.display = "none";
            }
            if (filterTags.length == 0) {
                result.tags.forEach(el => {
                    filterTags.push({
                        name: el,
                        active: result.user_filter_tags.find(x => x == el) != undefined
                    });
                });
            }
            load_filters(result.filters);
            result.results.forEach(el => {
                document.getElementById("userCards").innerHTML += userCard(el);
            });
        }
    };
    xhttp.open("GET", "http://localhost/php/search/search_users.php", true);
    xhttp.send();
}
reload_search_list();
</script>
</body>