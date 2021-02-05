<div class="navigbar fixed-top">
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle navbar-brand text-danger" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Matcha
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color: #343a40;">
                        <a class="dropdown-item" href="../accueil" style="color: red; border-bottom: 1px solid;">Accueil</a>
                        <a class="dropdown-item" href="../notify" style="color: red; border-bottom: 1px solid;">Mes notifs</a>
                        <a class="dropdown-item" href="../profile" style="color: red; border-bottom: 1px solid;">Mon profil</a>
                        <a class="dropdown-item" href="../chat" style="color: red; border-bottom: 1px solid;">Chat</a>
                    </div>
                </li>
                <li class="nav-item dropdown dropdown-mega">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye text-primary" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 0 1.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0 0 14.828 8a13.133 13.133 0 0 0-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 0 0 1.172 8z"/>
                            <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                        </svg>
                        <span id="spanViewCount" class="badge badge-light"></span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="dropdown-column mb-2 mb-lg-0">
                            <h5 class="dropdown-header">Vues</h5>
                                <div id="listeVue">
                                    
                                </div>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-justify" href="/php/redirections/all_profile_views.php">Voir tout</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown dropdown-mega">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-heart-half text-danger" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 1.314C3.562-3.248-7.534 4.735 8 15V1.314z"/>
                            <path fill-rule="evenodd" d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                        </svg>
                        <span id="spanLikeCount" class="badge badge-light"></span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="dropdown-column mb-2 mb-lg-0">
                            <h5 class="dropdown-header">Likes</h5>
                                <div id="listeLikes">
                                    
                                </div>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-justify" href="/php/redirections/all_likes.php">Voir tout</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown dropdown-mega">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bookmark-heart-fill text-secondary" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4 0a2 2 0 0 0-2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4zm4 4.41c1.387-1.425 4.854 1.07 0 4.277C3.146 5.48 6.613 2.986 8 4.412z"/>
                        </svg>
                        <span id="spanMatchCount" class="badge badge-light"></span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="dropdown-column mb-2 mb-lg-0">
                            <h5 class="dropdown-header">Matchs</h5>
                                <div id="listeMatchs">
                                    
                                </div>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-justify" href="/php/redirections/all_matches.php">Voir tout</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown dropdown-mega">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chat-dots-fill text-success" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                        </svg>
                        <span id="spanChatCount" class="badge badge-light"></span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="dropdown-column mb-2 mb-lg-0">
                            <h5 class="dropdown-header">Chat</h5>
                                <div id="listeChat">
                                    
                                </div>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-justify" href="/chat">Voir tout</a>
                        </div>
                    </div>
                </li>
                    
            </ul>
            <div class="d-flex align-items-end flex-column " style="flex: auto;">
                <a class="nav-link" href="/php/account/logout.php">Se déconnecter 
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-box-arrow-in-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                        <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                    </svg>
                </a>
            </div>
        </div>
    </nav>
</div>
<script>

var lastNotif;

function nbToSpanCount(nb) {
    var ret = "";

    if (nb > 0 && nb < 10) {
        ret = nb.toString();
    } else if (nb > 9) {
        ret = "9+";
    }
    return (ret);
}

function profileViews(data) {
    document.getElementById("spanViewCount").innerText = nbToSpanCount(data.total);
    
    var html = "";
    for (var i = 0; i < data.list.length; i++) {
        html += '<a class="dropdown-item" href="/php/redirections/single_profile_view.php?notif_id=' + data.list[i].id + '">';
        html +=     '<img class="image-circle" alt="100x100" src="' + data.list[i].img + '" data-holder-rendered="true">';
        html +=     data.list[i].from + ' (' + data.list[i].relative_date + ')';
        html += '</a>';
    }
    document.getElementById("listeVue").innerHTML = html;
}

function likes(data) {
    document.getElementById("spanLikeCount").innerText = nbToSpanCount(data.total);
    var html = "";
    for (var i = 0; i < data.list.length; i++) {
        html += '<a class="dropdown-item" href="/php/redirections/single_like.php?notif_id=' + data.list[i].id + '">';
        html +=     '<img class="image-circle" alt="100x100" src="' + data.list[i].img + '" data-holder-rendered="true">';
        if (data.list[i].active == 1) {
            html += '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#db7a82" class="bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16"><path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.964.22.817.533 2.512.062 4.51a9.84 9.84 0 0 1 .443-.05c.713-.065 1.669-.072 2.516.21.518.173.994.68 1.2 1.273.184.532.16 1.162-.234 1.733.058.119.103.242.138.363.077.27.113.567.113.856 0 .289-.036.586-.113.856-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.162 3.162 0 0 1-.488.9c.054.153.076.313.076.465 0 .306-.089.626-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.826 4.826 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.616.849-.231 1.574-.786 2.132-1.41.56-.626.914-1.279 1.039-1.638.199-.575.356-1.54.428-2.59z"/></svg>' + data.list[i].from + ' (' + data.list[i].relative_date + ')';
        } else {
            html += '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-down" viewBox="0 0 16 16">  <path d="M8.864 15.674c-.956.24-1.843-.484-1.908-1.42-.072-1.05-.23-2.015-.428-2.59-.125-.36-.479-1.012-1.04-1.638-.557-.624-1.282-1.179-2.131-1.41C2.685 8.432 2 7.85 2 7V3c0-.845.682-1.464 1.448-1.546 1.07-.113 1.564-.415 2.068-.723l.048-.029c.272-.166.578-.349.97-.484C6.931.08 7.395 0 8 0h3.5c.937 0 1.599.478 1.934 1.064.164.287.254.607.254.913 0 .152-.023.312-.077.464.201.262.38.577.488.9.11.33.172.762.004 1.15.069.13.12.268.159.403.077.27.113.567.113.856 0 .289-.036.586-.113.856-.035.12-.08.244-.138.363.394.571.418 1.2.234 1.733-.206.592-.682 1.1-1.2 1.272-.847.283-1.803.276-2.516.211a9.877 9.877 0 0 1-.443-.05 9.364 9.364 0 0 1-.062 4.51c-.138.508-.55.848-1.012.964l-.261.065zM11.5 1H8c-.51 0-.863.068-1.14.163-.281.097-.506.229-.776.393l-.04.025c-.555.338-1.198.73-2.49.868-.333.035-.554.29-.554.55V7c0 .255.226.543.62.65 1.095.3 1.977.997 2.614 1.709.635.71 1.064 1.475 1.238 1.977.243.7.407 1.768.482 2.85.025.362.36.595.667.518l.262-.065c.16-.04.258-.144.288-.255a8.34 8.34 0 0 0-.145-4.726.5.5 0 0 1 .595-.643h.003l.014.004.058.013a8.912 8.912 0 0 0 1.036.157c.663.06 1.457.054 2.11-.163.175-.059.45-.301.57-.651.107-.308.087-.67-.266-1.021L12.793 7l.353-.354c.043-.042.105-.14.154-.315.048-.167.075-.37.075-.581 0-.211-.027-.414-.075-.581-.05-.174-.111-.273-.154-.315l-.353-.354.353-.354c.047-.047.109-.176.005-.488a2.224 2.224 0 0 0-.505-.804l-.353-.354.353-.354c.006-.005.041-.05.041-.17a.866.866 0 0 0-.121-.415C12.4 1.272 12.063 1 11.5 1z"/></svg>' + data.list[i].from + ' (' + data.list[i].relative_date + ')';
        }
        html += '</a>';
    }
    document.getElementById("listeLikes").innerHTML = html;
}

function matches(data) {
    document.getElementById("spanMatchCount").innerText = nbToSpanCount(data.total);
    var html = "";
    for (var i = 0; i < data.list.length; i++) {
        html += '<a class="dropdown-item" href="/php/redirections/single_match.php?notif_id=' + data.list[i].id + '">';
        html +=     '<img class="image-circle" alt="100x100" src="' + data.list[i].img + '" data-holder-rendered="true">';
        html +=     data.list[i].from + ' (' + data.list[i].relative_date + ')';
        html += '</a>';
    }
    document.getElementById("listeMatchs").innerHTML = html;
}

function chat(data) {
    document.getElementById("spanChatCount").innerText = nbToSpanCount(data.total);
    var html = "";
    for (var i = 0; i < data.list.length; i++) {
        html += '<a class="dropdown-item" href="/php/redirections/chat_conv.php?conv_id=' + data.list[i].conv_id + '">';
        html +=     '<img class="image-circle" alt="100x100" src="' + data.list[i].img + '" data-holder-rendered="true">';
        html +=     data.list[i].message + ' (' + data.list[i].relative_date + ')';
        html += '</a>';
    }
    document.getElementById("listeChat").innerHTML = html;
}

function reloadNotifs() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var result = JSON.parse(this.responseText);

            //console.log(result);

            profileViews(result.profile_views);
            likes(result.likes);
            matches(result.matches);
            chat(result.chat);
            lastNotif = result;
        }
    };
    xhttp.open("GET", "http://localhost/php/notifications/get_notifications.php", true);
    xhttp.send();
}

reloadNotifs();

setInterval(function(){
    reloadNotifs();
}, 1000);
</script>