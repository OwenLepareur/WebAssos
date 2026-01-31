<?php
session_start();
// Si déjà connecté, on renvoie direct vers l'admin
if (isset($_SESSION["admin"]) && $_SESSION["admin"] === true) {
    header("Location: admin.php");
    exit;
}
$error = isset($_GET["error"]);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin</title>
    <link rel="stylesheet" href="assets/css/Login.css">
</head>
<body>

    <div id="LoginContainer">
        <div class="logo-container">
            <img src="assets/img/ui/GNLogo.jpg" alt="Logo GN">
        </div>

        <h2>Espace Admin</h2>

        <?php if ($error): ?>
            <div class="error-msg">Identifiants incorrects !</div>
        <?php endif; ?>

        <form method="POST" action="../app/controllers/auth.php"> 
        <div class="input-group">
                <input type="text" name="username" placeholder="Nom d'utilisateur" required>
            </div>

            <div class="input-group">
                <input type="password" name="password" placeholder="Mot de passe" required>
            </div>

            <button type="submit">Se connecter</button>
        </form>

        <a href="index.html" class="back-link">← Retour au site</a>
    </div>

</body>
</html>