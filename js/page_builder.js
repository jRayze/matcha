function ajxDivContent(url) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var result = JSON.parse(this.responseText);
            result.results.forEach(el => {
                document.getElementById(el.DivId).innerHTML = el.Content;
            })
        }
    };
    xhttp.open("GET", url, true);
    xhttp.send();
}