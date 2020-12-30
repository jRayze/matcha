<div class="navigbar fixed-top">
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle navbar-brand text-danger" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    LoveStation
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
        html +=     data.list[i].from + ' (' + data.list[i].relative_date + ')';
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