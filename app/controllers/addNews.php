<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Assets/CSS/AddNews.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <?php
    session_start();
    if (!isset($_SESSION["admin"])) {
        header("Location: index.php");
        exit;
    }
    ?>
    <div id = "header">
        <div class = "header_element">

        </div>
        <div class = "header_element">
            <button class = "header_button" onclick="GiveUpNews()">Abandonner la News</button>
            <button class = "header_button" onclick="sendNewsFromDivs()">Publier</button>
        </div>
    </div>
    <div id = "NewsResume">
        <div id = "ResumeParam">
            <p>Donnez un titre à cette News :</p>
            <input id = "TitreInput" placeholder="Titre" required></input>
            <p>Faites un court résumé de cette News :</p>
            <input id = "ResumeInput" placeholder="Résumé" required></input>
            <p>Choisissez un image pour la News.</p>
            <input type="file" id="fileToUpload" accept="image/*">
            <button onclick="uploadImage()">Uploader</button>
        </div>
        <div id = "ResumePreview">
            <div class = "Info" id = "Info1" onclick=sendToPage(1)>
                <div class = "News_Content">
                    <div class = "News_Text">
                        <h1 class = "News_Title" id = "TitrePreview">Titre</h1>
                        <p class = "News_Resume" id = "ResumePreviewRight">Ceci est un résumé de la dernière info !</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class = "HorizontalSep"></div>
    <div id = "NewsMaking">
        <div id = "TitleDiv">
            <p id = "Title">Titre</p>
        </div>
        <div class = "HorizontalSep"></div>
        <div class = "LastElement">

        </div>
        <div id = "AddPartDiv">
            <button id = "AddPart" onclick="openPopup()">Ajouter une Partie</div>
        </div>
        <div id="popup" class="popup">
            <div class="popup-content">
                <h2>Choisissez une option</h2>

                <button onclick="chooseOption(1)">Image sur la Gauche</button>
                <button onclick="chooseOption(2)">Image sur la Droite</button>
                <button onclick="chooseOption(3)">Images Défilantes</button>
                <button onclick="chooseOption(0)">Supprimer la Dernière Partie</button>

                <button class="close" onclick="closePopup()">Annuler</button>
            </div>
        </div>
        <div id="SelectNbDisplay" class="popup">
            <div class="popup-content">
                <h2>Selectionnez le nombre d'Images souhaitées</h2>
                <input id = "ImgNb" type="number" min=1 max=9 value=1>
                <button onclick="AddImgDisplay()">Images Défilantes</button>
            </div>
        </div>
    </div>
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <script src="Assets/JS/AdminNews.js"></script>
</body>
</html>