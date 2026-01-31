<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Vérifie si on est connecté en tant qu'admin
$isAdmin = isset($_SESSION['admin']) && $_SESSION['admin'] === true;
?>

<div id="header">
    <div class="header-left">
        <img src="assets/img/ui/viking.png" id="MainLogo" alt="Logo Viking">
        <p id="MainTitle">Les Géocacheurs Normands</p>
    </div>

    <div class="header_element">

        <?php if ($isAdmin): ?>
            <button class="header_button" onclick="window.location.href='index.php'">Accueil</button>
            <button class="header_button">En Savoir Plus</button>
            <button class="header_button" onclick="window.location.href='mailto:Gcncotentin@gmail.com'">Nous Contacter</button>
            
            <div class="dropdown">
                <button class="header_button dropbtn">Paramètres ▼</button>
                <div class="dropdown-content">
                    <a href="addNews.php">Nouvelle News</a>
                    <a href="index.php">Retour au Site</a>
                    <a href="logout.php">Déconnexion</a>
                </div>
            </div>

        <?php else: ?>
            <button class="header_button" onclick="window.location.href='index.php'">Accueil</button>
            <button class="header_button" onclick="window.location.href='index.php#Assos'">Qui sommes nous ?</button>
            <button class="header_button" onclick="window.location.href='mailto:Gcncotentin@gmail.com'">Nous Contacter</button>
            <button class="header_button" onclick="window.location.href='login.php'">Connexion</button>
        <?php endif; ?>

    </div>
</div>