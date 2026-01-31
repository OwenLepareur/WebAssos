const urlNews1 = "News1.html"
const urlNews2 = "News2.html"
const urlNews3 = "News3.html"

function sendToPage(NewsPage) {
    if (NewsPage == 1)
        window.open(urlNews1, "_self")
    if (NewsPage == 2)
        window.open(urlNews2, "_self")
    if (NewsPage == 3)
        window.open(urlNews3, "_self")
}

function Connexion() {
    window.location.href = "index.php";
}

function Accueil() {
    window.location.href = "index.html";
}

