<style>
    /* Pas besoin de déclarer :root si déjà chargé, mais sécurité au cas où */
    .footer-container {
        background-color: rgb(97, 0, 0); /* Ta couleur primaire */
        color: white;
        padding: 40px 20px;
        font-family: Arial, sans-serif;
        margin-top: 50px; /* Espace avec le contenu du dessus */
        border-top: 5px solid white;
    }

    .footer-content {
        display: flex;
        justify-content: space-around;
        align-items: flex-start;
        flex-wrap: wrap;
        max-width: 1200px;
        margin: 0 auto;
    }

    .footer-section {
        flex: 1;
        padding: 10px;
        min-width: 250px;
    }

    .footer-section h3 {
        font-family: Impact, sans-serif;
        font-size: 20px;
        margin-bottom: 15px;
        color: white; /* Force le blanc */
        text-align: left; /* Annule le centrage par défaut des h3 */
    }

    .footer-section p, .footer-section a {
        font-size: 16px;
        color: #f1f1f1;
        text-decoration: none;
        display: block;
        margin-bottom: 8px;
        line-height: 1.5;
        text-align: left;
    }

    .footer-section a:hover {
        color: rgb(235, 215, 205); /* Ton beige au survol */
        text-decoration: underline;
    }

    .footer-bottom {
        text-align: center;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.3);
        font-size: 14px;
        color: #ccc;
    }

    /* Mobile */
    @media (max-width: 768px) {
        .footer-content {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .footer-section {
            text-align: center;
            width: 100%;
        }

        .footer-section h3, .footer-section p, .footer-section a {
            text-align: center;
        }
    }
</style>

<footer class="footer-container">
    <div class="footer-content">
        
        <div class="footer-section">
            <h3>Les Géocacheurs Normands</h3>
            <p>Association loi 1901 dédiée à la promotion du géocaching et à la découverte du patrimoine dans le Cotentin.</p>
        </div>

        <div class="footer-section">
            <h3>Liens Utiles</h3>
            <a href="index.php">Accueil</a>
            <a href="index.php#Assos">L'Association</a>
            <a href="mailto:Gcncotentin@gmail.com">Nous contacter</a>
            <a href="login.php">Espace Admin</a>
        </div>

        <div class="footer-section">
            <h3>Informations Légales</h3>
            <a href="mentions.php">Mentions Légales</a>
            <a href="#">Politique de Confidentialité</a>
            <a href="https://www.helloasso.com/associations/les-geocacheurs-normands-du-cotentin" target="_blank">Adhérer via HelloAsso</a>
        </div>

    </div>

    <div class="footer-bottom">
        &copy; <?php echo date("Y"); ?> Les Géocacheurs Normands du Cotentin. Tous droits réservés.
    </div>
</footer>