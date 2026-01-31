function GiveUpNews() {
    fetch('delete.php', { method: 'POST' });
    window.location.href = "../Admin Page/index.php";
}

function displayImage(event) {
    event.preventDefault(); // empêche l'envoi immédiat pour tester
    const input = document.getElementById('fileToUpload');
    if(input.files.length > 0){
        const fileName = input.files[0].name;
    }
    let img = document.createElement("../uploads" . fileName);
    img.src = src;
    img.width = width;
    img.height = height;
    img.alt = alt;
    document.body.appendChild(img);
}

function wait(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

async function uploadImage() {
    fetch('delete.php', { method: 'POST' });
    const input = document.getElementById('fileToUpload');
    const frame = document.getElementById('Info1');

    if (!input || input.files.length === 0) {
        alert("Veuillez choisir un fichier !");
        return;
    }

    const file = input.files[0];

    const formData = new FormData();
    formData.append("fileToUpload", file);

    try {
        // Upload du fichier
        const response = await fetch("upload.php", {
            method: "POST",
            body: formData
        });

        // Après upload, récupérer la première image et mettre en background
        const imagePath = await response.text();

        if (frame && imagePath) {
            frame.style.backgroundImage = `url(${imagePath}?t=${new Date().getTime()})`;
            const color1 = await getAverageColor(imagePath + "?t=" + Date.now());
            document.getElementById("Info1").style.backgroundColor = `rgb(${color1.r}, ${color1.g}, ${color1.b})`;
        }
    } catch (err) {
        console.error(err);
        if (statusEl) statusEl.innerHTML = "Erreur lors de l'upload.";
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

const TitreInput = document.getElementById('TitreInput')
const ResumeInput = document.getElementById('ResumeInput')
const TitrePreview = document.getElementById('TitrePreview')
const TitreNews = document.getElementById('Title')
const ResumePreview = document.getElementById('ResumePreviewRight')


TitreInput.addEventListener('input', (event) => {
    // event.target.value contient le texte actuel
    TitrePreview.textContent = event.target.value;
    TitreNews.textContent = event.target.value;
});

ResumeInput.addEventListener('input', (event) => {
    // event.target.value contient le texte actuel
    ResumePreview.textContent = event.target.value;
});

function openPopup() {
    if (countDiv == 10) {
        alert("Maximum de Parties atteinte")
        return;
    }
    document.getElementById('popup').style.display = 'flex';
}

function closePopup() {
    document.getElementById('popup').style.display = 'none';
}

function chooseOption(option) {
    console.log("Option choisie :", option);
    
    // EXEMPLE d'action selon le choix
    if (option == 0 && document.getElementsByClassName('LastElement')[1]) {
        const allDivs = document.getElementsByClassName('LastElement');
        if (allDivs.length > 0) {
            const lastDiv = allDivs[allDivs.length - 1];
            lastDiv.remove();
            console.log("Dernier div supprimé !");
            countDiv--;
        } else {
            console.log("Aucun div à supprimer");
        }
    }
    if (option === 1) {
        AddImgOnLeft();
    }
    if (option === 2) {
        AddImgOnRight();
    }
    if (option === 3) {
        Soon();
    }
    
    console.log("Div Count : ", countDiv);
    closePopup();
}

function Soon() {
    alert("Cette fonctionalité n'est pas encore implémentée...")
}

document.getElementById('popup').addEventListener('click', (e) => {
    if (e.target.id === 'popup') closePopup();
});

function SelectNbDisplay() {
    document.getElementById('SelectNbDisplay').style.display = 'flex';
}

document.getElementById('SelectNbDisplay').addEventListener('click', (e) => {
    if (e.target.id === 'SelectNbDisplay') closeNbDisplay();
});

function closeNbDisplay() {
    document.getElementById('SelectNbDisplay').style.display = 'none';
}

async function ChangeImg(value) {
    const input = document.getElementById("upload" + value);
    const frame = document.getElementById(value + "Display");

    if (!input || !frame) {
        console.error("Input ou frame introuvable");
        return;
    }

    input.onchange = async () => {
        if (!input.files || !input.files[0]) return;

        const file = input.files[0];

        const formData = new FormData();
        formData.append("fileToUpload", file);
        formData.append("valeur", value);

        try {
            const res = await fetch("uploadImg.php", {
                method: "POST",
                body: formData
            });

            let imagePath = null;
            const txt = await res.text();
            if (txt == "Erreur lors de l'upload." || txt == "Aucun fichier reçu.") throw txt;
            else {
                imagePath = txt;
                frame.src = imagePath + "?t=" + Date.now();
                console.log("Image affichée :", imagePath);
            }

        } catch (err) {
            console.error("Erreur upload :", err);
        }

        input.value = "";
    };

    input.click();
}

function initQuillEditors() {
    document.querySelectorAll('.Textarea').forEach(el => {
        if (el.__quill) return; // évite double init

        el.__quill = new Quill(el, {
            theme: 'snow',
            placeholder: 'Écris ici...',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline'],
                    [{ list: 'ordered' }, { list: 'bullet' }],
                    ['link']
                ]
            }
        });
    });
}

let countDiv = 0;

function AddImgOnLeft() {
    if (countDiv == 9) {
        alert("Nombre de Partie max atteinte");
        return;
    }
    countDiv++;
    const allDivs = document.getElementsByClassName('LastElement');
    const referenceDiv = document.getElementsByClassName('LastElement')[allDivs.length -1];
    const newDiv = document.createElement('div');

    newDiv.className = "LastElement ImgOnLeft";
    newDiv.id = String(countDiv);

    const text = document.createElement('div');
    text.className = "Textarea";
    text.id = "textarea" + String(countDiv);

    const textContain = document.createElement('div');
    textContain.className = "DivText";

    textContain.append(text)
    
    const HoriSep = document.createElement('div');
    HoriSep.className = "HoriSep";

    const img = document.createElement('img');
    img.src = "../Blog Page/Assets/Images/News1.jpg";
    img.id = String(countDiv) + "Display";
    img.className = "BlogImg"
    img.onclick= () => ChangeImg(parseInt(img.id, 10));

    const ImgContain = document.createElement('div');
    ImgContain.className = "DivImg";

    ImgContain.append(img)

    const uploadinput = document.createElement('input');
    uploadinput.type = "file";
    uploadinput.id = "upload" + String(countDiv);
    uploadinput.accept = "image/*";
    uploadinput.style = "display:none;";

    newDiv.appendChild(textContain);
    newDiv.appendChild(HoriSep);
    newDiv.appendChild(ImgContain);
    newDiv.appendChild(uploadinput);

    // insérer après le div existant
    referenceDiv.parentNode.insertBefore(newDiv, referenceDiv.nextSibling);
    initQuillEditors();
}

function AddImgOnRight() {
    if (countDiv == 9) {
        alert("Nombre de Partie max atteinte");
        return;
    }
    countDiv++;
    const allDivs = document.getElementsByClassName('LastElement');
    const referenceDiv = document.getElementsByClassName('LastElement')[allDivs.length -1];
    const newDiv = document.createElement('div');

    newDiv.className = "LastElement ImgOnRight";
    newDiv.id = String(countDiv);

    const text = document.createElement('div');
    text.className = "Textarea";
    text.id = "textarea" + String(countDiv);

    const textContain = document.createElement('div');
    textContain.className = "DivText";

    textContain.append(text)
    
    const HoriSep = document.createElement('div');
    HoriSep.className = "HoriSep";

    const img = document.createElement('img');
    img.src = "../Blog Page/Assets/Images/News1.jpg";
    img.id = String(countDiv) + "Display";
    img.className = "BlogImg"
    img.onclick= () => ChangeImg(parseInt(img.id, 10));

    const ImgContain = document.createElement('div');
    ImgContain.className = "DivImg";

    ImgContain.append(img);

    const uploadinput = document.createElement('input');
    uploadinput.type = "file";
    uploadinput.id = "upload" + String(countDiv);
    uploadinput.accept = "image/*";
    uploadinput.style = "display:none;";

    newDiv.appendChild(ImgContain);
    newDiv.appendChild(HoriSep);
    newDiv.appendChild(textContain);
    newDiv.appendChild(uploadinput);

    // insérer après le div existant
    referenceDiv.parentNode.insertBefore(newDiv, referenceDiv.nextSibling);
    initQuillEditors();
}

function AddImgDisplay() {
    if (countDiv == 9) {
        alert("Nombre de Partie max atteinte");
        return;
    }
    countDiv++;
    const allDivs = document.getElementsByClassName('LastElement');
    const referenceDiv = document.getElementsByClassName('LastElement')[allDivs.length -1];
    const value = document.getElementById("ImgNb").value;
    if (value < 1) value = 1;
    if (value > 9) value = 9;
    closeNbDisplay();

    const newDiv = document.createElement('div');
    newDiv.id = String(countDiv)
    newDiv.className = "LastElement ImgDisplayer";

    const uploadinput = document.createElement('input');
    uploadinput.type = "file";
    uploadinput.id = "upload" + String(countDiv);
    uploadinput.accept = "image/*";
    uploadinput.style = "display:none;";
    
    const ImgDisplay = document.createElement('img');
    ImgDisplay.className = "ImgDisplay";
    ImgDisplay.id = String(countDiv) + "Display";
    ImgDisplay.dataset.value = 1;
    ImgDisplay.onclick = () => uploadImgDisplay(parseInt(newDiv.id, 10), ImgDisplay, value);

    const GoLeft = document.createElement('div');
    GoLeft.className = "GoLeft";
    GoLeft.onclick =  () => DowngradeRef(parseInt(newDiv.id, 10), ImgDisplay , value);

    const GoRight = document.createElement('div');
    GoRight.className = "GoRight";
    GoRight.onclick = () => UpgradeRef(parseInt(newDiv.id, 10), ImgDisplay , value);

    newDiv.appendChild(GoLeft);
    newDiv.appendChild(ImgDisplay);
    newDiv.appendChild(GoRight);
    newDiv.appendChild(uploadinput);

    referenceDiv.parentNode.insertBefore(newDiv, referenceDiv.nextSibling);
}

function DowngradeRef(id, ImgDisplay, max) {
    ImgDisplay.dataset.value--;
    if (ImgDisplay.dataset.value < 1) {
        ImgDisplay.dataset.value = max;
    }
}

function UpgradeRef(id, ImgDisplay, max) {
    ImgDisplay.dataset.value++;
    if (ImgDisplay.dataset.value > max) {
        ImgDisplay.dataset.value = 1;
    }

    ImgDisplay.src = "uploads/" + id + ImgDisplay.dataset.value + ".png";
}

function uploadImgDisplay(value, div, max) {
    console.log(div.dataset.value);
    console.log(max)

    const input = document.getElementById("upload" + value);
    const frame = document.getElementById(String(value) + "Display");

    console.log("frame =", frame); // DEBUG

    if (!input || !frame) {
        console.error("Input ou frame introuvable");
        return;
    }

    // Nettoie l'ancien listener
    input.onchange = null;

    input.onchange = async () => {
        if (input.files.length === 0) return;

        const file = input.files[0];

        const formData = new FormData();
        formData.append("fileToUpload", file);
        formData.append("valeur", value);
        formData.append("ref", div.dataset.value);

        try {
            await fetch("uploadDisplayImg.php", {
                method: "POST",
                body: formData
            });

            const valueIdData = new FormData();
            valueIdData.append("valeur", value);
            valueIdData.append("ref", div.dataset.value);

            const res = await fetch("getUploadedImgDisplay.php", {
                method: "POST",
                body: valueIdData
            });

            const imagePath = (await res.text()).trim();

            if (!imagePath) {
                console.error("imagePath vide");
                return;
            }

            // 🔥 CACHE BUSTER
            const finalPath = imagePath + "?t=" + Date.now();

            frame.src = finalPath;

            console.log("Background appliqué :", finalPath);

        } catch (err) {
            console.error(err);
        }

        input.value = ""; // permet de re-sélectionner le même fichier
    };

    input.click();
}

async function rotateNewsTables() {
    try {
        const response = await fetch("rotateNewsTables.php");
        const text = await response.text();
        console.log("Résultat :", text);
        return true;
    } catch (err) {
        console.error("Erreur lors de la rotation :", err);
        throw err;
    }
}

async function sendElement(type, content = null, imgpath = null) {
    const formData = new FormData();
    formData.append("type", type);
    if (content) formData.append("content", content);
    if (imgpath) formData.append("imgpath", imgpath);

    const res = await fetch("saveNews.php", {
        method: "POST",
        body: formData
    });

    const txt = await res.text();
    if (txt !== "OK") throw txt;
    console.log(txt);
}

function getImgNameFromBg(bg) {
    if (!bg) return null;

    // Supprime url() et guillemets
    bg = bg.replace(/^url\(["']?/, '').replace(/["']?\)$/, '');

    // bg maintenant = "../Admin Page/uploads/news1/1.jpg?t=12345"
    // On split par '/' et prend le dernier élément
    const parts = bg.split('/');
    let fileName = parts.pop();

    // On enlève le query string si présent
    fileName = fileName.split('?')[0];

    return fileName;
}

async function sendNewsFromDivs() {
    try {

        await rotateNewsTables()

        const title = document.getElementById('TitreInput').value;
        const resume = document.getElementById('ResumeInput').value;

        // Extraire juste le nom du fichier de backgroundImage
        const bg = document.getElementById('Info1').style.backgroundImage;
        const imgName = getImgNameFromBg(bg);

        console.log("Premier sendElement:", title, resume, imgName);

        await sendElement(title, resume, imgName);

        // 1️⃣ Récupère toutes les divs avec un id numérique
        const allDivs = Array.from(document.querySelectorAll('div[id]'))
            .filter(d => !isNaN(d.id))
            .sort((a, b) => parseInt(a.id) - parseInt(b.id)); // tri 1, 2, 3...

        // 2️⃣ Parcours chaque div
        for (const div of allDivs) {
            const nb = div.id;

            // type = première classe
            const type = div.className.split(' ')[1];

            // content = valeur de l'input correspondant
            const quillDiv = div.querySelector('.Textarea');
            const content = quillDiv?.__quill?.root.innerHTML ?? null;

            // imgpath = src de l'image correspondante
            const imgEl = document.getElementById(nb + "Display");
            let imgpath = null;
            if (imgEl && imgEl.src) {
                const fullName = imgEl.src.split('/').pop();  // ex: "1.jpg?t=1769786460362"
                imgpath = fullName.split('?')[0];             // "1.jpg" seulement
                console.log(imgpath);
            }

            // 3️⃣ Appel de la fonction existante sendElement()
            await sendElement(type, content, imgpath);
        }

        await fetch("rotateNewsFolders.php");

        alert("Toutes les news ont été envoyées !");
        window.location.href = "admin.php";
    } catch (e) {
        console.error("Erreur dans sendNewsFromDivs :", e);
        alert("Erreur lors de l'envoi des news !");
    }
}