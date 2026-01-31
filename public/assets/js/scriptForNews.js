document.addEventListener("DOMContentLoaded", () => {
    const page = location.pathname.match(/News(\d)/);
    if (page) loadNews("News" + page[1]);
});

async function loadNews(News) {
    try {
        // Fonction utilitaire pour générer le chemin complet d'une image avec cache-buster
        const getImgUrl = (folder, img) => img ? `uploads/${folder}/${img}?t=${Date.now()}` : "";

        // Choix du fichier PHP selon la news
        const fileMap = {
            News1: "../app/controllers/getNews.php",
            News2: "../app/controllers/getNews2.php",
            News3: "../app/controllers/getNews3.php"
        };

        const res = await fetch(fileMap[News]);
        const newsList = await res.json();

        if (!newsList || newsList.length === 0) {
            console.log("Aucune news disponible.");
            return;
        }

        const container = document.getElementById("NewsContainer");
        if (!container) {
            console.error("Div #NewsContainer introuvable !");
            return;
        }

        // Ajout du titre de la première news
        const Title = document.createElement('h1');
        Title.textContent = newsList[0].type;
        Title.id = "Title";
        container.appendChild(Title);

        // Parcours des éléments
        newsList.forEach(item => {
            const div = document.createElement("div");
            div.id = item.id;
            div.className = item.type;

            const content = document.createElement("div");
            content.innerHTML = item.content;
            content.style.width = "80vh";

            const img = document.createElement("img");
            img.src = getImgUrl(News.toLowerCase(), item.imgpath);
            img.className = "BlogImg";

            const ImgContain = document.createElement('div');
            ImgContain.className = "DivImg";
            ImgContain.append(img);

            if (item.type === "ImgOnLeft") {
                div.appendChild(content);
                div.appendChild(ImgContain);
            } else if (item.type === "ImgOnRight") {
                div.appendChild(ImgContain);
                div.appendChild(content);
            }

            const sep = document.createElement("div");
            sep.className = "HorizontalSep";

            container.appendChild(sep);
            container.appendChild(div);
        });

    } catch (e) {
        console.error("Erreur lors du chargement des news :", e);
    }
}