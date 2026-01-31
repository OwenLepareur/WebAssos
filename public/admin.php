<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Assets/CSS/Dashboard.css">
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
            <button class = "header_button" onclick="Accueil()">Accueil</button>
            <button class = "header_button">En Savoir Plus</button>
            <button class = "header_button">Nous Contacter</button>
            <div class="dropdown">
                <button class="dropbtn">Paramètres</button>
                <div class="dropdown-content">
                    <a href="addNews.php">Nouvelle News</a>
                    <a href="../Blog Page/index.html">Retour au Site</a>
                    <a href="logout.php">Déconnexion</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div id = "Analytics">
        <canvas id="visitsChart" width="80vh"></canvas>
    </div>
    <script src="../Main Assets/script.js"></script>
    <script src="Assets/JS/AdminHomePage.js"></script>
</body>
</html>