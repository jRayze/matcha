<?php
print_r($_SERVER);
echo getenv('REMOTE_ADDR');
/*
var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
        }
    };
    xhttp.open("GET", 'https://www.cloudflare.com/cdn-cgi/trace', true);
    xhttp.send();
    */
?>
