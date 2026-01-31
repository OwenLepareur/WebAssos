document.addEventListener("DOMContentLoaded", () => {
    News_Load();
    trackVisit();
});

async function getImagePath(basePath) {
    const extensions = ["jpg", "jpeg", "png", "webp", "gif"];

    for (const ext of extensions) {
        const path = `${basePath}.${ext}`;
        try {
            const res = await fetch(path, { method: "HEAD" });
            if (res.ok) return path;
        } catch (e) {}
    }
    return null;
}

async function trackVisit() {
    try {
        const res = await fetch("../app/controllers/visitPerDay.php"); // chemin vers ton PHP
        const text = await res.text(); // récupère le message du PHP
        console.log(text);
    } catch (err) {
        console.error("Erreur lors du suivi des visites :", err);
    }
}

async function News_Load() {
    try {
        // Récupération des données
        const News1List = await (await fetch("../app/controllers/getNews.php")).json();
        const News2List = await (await fetch("../app/controllers/getNews2.php")).json();
        const News3List = await (await fetch("../app/controllers/getNews3.php")).json();

        // Sélection de la première news si elle existe
        const News1 = News1List[0] || null;
        const News2 = News2List[0] || null;
        const News3 = News3List[0] || null;

        // Fonction utilitaire pour obtenir chemin complet avec cache-buster
        const getImgUrl = (folder, img) => img ? `uploads/${folder}/${img}?t=${Date.now()}` : "";

        // Couleur moyenne
        const color1 = News1 ? await getAverageColor(getImgUrl("news1", News1.imgpath)) : {r:255,g:255,b:255};
        const color2 = News2 ? await getAverageColor(getImgUrl("news2", News2.imgpath)) : {r:255,g:255,b:255};
        const color3 = News3 ? await getAverageColor(getImgUrl("news3", News3.imgpath)) : {r:255,g:255,b:255};

        // Appliquer les couleurs
        document.getElementById("Info1").style.backgroundColor = `rgb(${color1.r}, ${color1.g}, ${color1.b})`;
        document.getElementById("Info2").style.backgroundColor = `rgb(${color2.r}, ${color2.g}, ${color2.b})`;
        document.getElementById("Info3").style.backgroundColor = `rgb(${color3.r}, ${color3.g}, ${color3.b})`;

        // Appliquer les images
        document.getElementById("Info1").style.backgroundImage = News1 ? `url("${getImgUrl("news1", News1.imgpath)}")` : "none";
        document.getElementById("Info2").style.backgroundImage = News2 ? `url("${getImgUrl("news2", News2.imgpath)}")` : "none";
        document.getElementById("Info3").style.backgroundImage = News3 ? `url("${getImgUrl("news3", News3.imgpath)}")` : "none";

        // Titre et résumé
        document.getElementById("NewsTitle1").textContent = News1 ? News1.type : "";
        document.getElementById("NewsTitle2").textContent = News2 ? News2.type : "";
        document.getElementById("NewsTitle3").textContent = News3 ? News3.type : "";

        document.getElementById("NewsResume1").textContent = News1 ? News1.content : "";
        document.getElementById("NewsResume2").textContent = News2 ? News2.content : "";
        document.getElementById("NewsResume3").textContent = News3 ? News3.content : "";

    } catch (err) {
        console.error("Erreur lors du chargement des news :", err);
    }
}

function getAverageColor(imagePath) {
    return new Promise(resolve => {
        const img = new Image();
        img.src = imagePath;

        img.onload = () => {
            const canvas = document.createElement("canvas");
            const ctx = canvas.getContext("2d");

            canvas.width = canvas.height = 50;
            ctx.drawImage(img, 0, 0, 50, 50);

            const data = ctx.getImageData(0, 0, 50, 50).data;

            let r = 0, g = 0, b = 0;
            for (let i = 0; i < data.length; i += 4) {
                r += data[i];
                g += data[i + 1];
                b += data[i + 2];
            }

            const pixels = data.length / 4;
            resolve({
                r: Math.round(r / pixels),
                g: Math.round(g / pixels),
                b: Math.round(b / pixels)
            });
        };
    });
}

async function trackVisit() {
    try {
        await fetch("../app/controllers/visitPerDay.php");
        console.log("Visite enregistrée !");
    } catch (e) {
        console.error("Erreur lors du tracking :", e);
    }
}

// Appelle dès que la page est chargée
document.addEventListener('DOMContentLoaded', trackVisit);