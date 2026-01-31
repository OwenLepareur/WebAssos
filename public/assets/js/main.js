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

function scrollToElement(id, offset = 0) {
    const el = document.getElementById(id);
    if (!el) return;

    const y = el.getBoundingClientRect().top + window.pageYOffset + offset;

    window.scrollTo({
        top: y,
        behavior: 'smooth'
    });
}