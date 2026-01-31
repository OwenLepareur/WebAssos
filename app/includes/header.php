<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$isAdmin = isset($_SESSION['admin']) && $_SESSION['admin'] === true;
?>

<style>
    :root {
        --primary-color: rgb(97, 0, 0);
        --text-white: #fff;
    }

    #header {
        background-color: var(--primary-color);
        height: 120px;
        padding: 0 5vh;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 2vh;
        font-family: Arial, sans-serif;
    }

    .header-left {
        display: flex;
        align-items: center;
        height: 100%;
    }

    #MainLogo {
        height: 90%;
        width: auto;
    }

    #MainTitle {
        color: var(--text-white);
        margin: 0;
        font-size: 50px;
        padding-left: 20px;
        font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
    }

    .header_element {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .header_button {
        height: 40px;
        padding: 0 20px;
        background-color: var(--primary-color);
        border: 2px solid white;
        border-radius: 20px;
        color: white;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s;
        font-family: Arial, sans-serif;
    }

    .header_button:hover {
        background-color: white;
        color: var(--primary-color);
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        right: 0;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1000;
        border-radius: 5px;
        overflow: hidden;
    }

    .dropdown-content a {
        color: var(--primary-color);
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        text-align: left;
		font-weight: bold;
    }

	.dropdown-content a:hover {
		background-color: var(--primary-color);
		color: white;
	}

    .dropdown-content a:hover {
        background-color: #ddd;
        color: var(--primary-color);
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    @media (max-width: 768px) {
        #header {
            height: auto;
            flex-direction: column;
            padding: 15px;
            align-items: center;
        }

        .header-left {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 15px;
        }

        #MainLogo {
            height: 60px;
            width: auto;
        }

        #MainTitle {
            display: block;
            font-size: 20px;
            margin-left: 10px;
            padding: 0;
            text-align: left;
            color: var(--text-white);
        }

        .header_element {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
        }

        .header_button {
            width: auto;
            padding: 5px 15px;
            font-size: 14px;
        }
    }
</style>

<div id="header">
    <div class="header-left">
        <img src="assets/img/ui/viking.png" id="MainLogo" alt="Logo Viking">
        <p id="MainTitle">Les Géocacheurs Normands</p>
    </div>

    <div class="header_element">

        <?php if ($isAdmin): ?>
            <button class="header_button" onclick="window.location.href='index.php'">Accueil</button>
            <button class="header_button" onclick="window.location.href='index.php#Assos'">Qui sommes nous ?</button>
            <button class="header_button" onclick="window.location.href='mailto:Gcncotentin@gmail.com'">Nous Contacter</button>
            
            <div class="dropdown">
                <button class="header_button dropbtn">Paramètres ▼</button>
                <div class="dropdown-content">
                    <a href="addNews.php">Nouvelle News</a>
                    <a href="index.php">Page admin</a>
                    <a href="logout.php">Déconnexion</a>
                </div>
            </div>

        <?php else: ?>
            <button class="header_button" onclick="window.location.href='accueil.php'">Accueil</button>
            <button class="header_button" onclick="window.location.href='index.php#Assos'">Qui sommes nous ?</button>
            <button class="header_button" onclick="window.location.href='mailto:Gcncotentin@gmail.com'">Nous Contacter</button>
            <button class="header_button" onclick="window.location.href='index.php'">Connexion</button>
        <?php endif; ?>

    </div>
</div>