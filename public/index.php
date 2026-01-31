<?php
session_start();
if (isset($_SESSION["admin"])) {
    header("Location: admin.php");
    exit;
}
$error = isset($_GET["error"]);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Admin</title>
    <link rel="stylesheet" href="Assets/CSS/Login.css">
</head>
<body>
    <div id = "LoginFrame">
        <h2>Connexion Admin</h2>

        <?php if ($error): ?>
            <p>Identifiants incorrects</p>
        <?php endif; ?>

        <form method="POST" action="login.php">
            <input type="text" name="username" placeholder="Nom d'utilisateur" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button>Se connecter</button>
        </form>
    </div>
</body>
</html>