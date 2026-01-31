<?php
session_start();
require "../app/config/db.php";

$username = $_POST["username"] ?? "";
$password = $_POST["password"] ?? "";

// Récupère l'utilisateur
$stmt = $pdo->prepare("SELECT * FROM user WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user["Password"])) {
    $_SESSION["admin"] = true;
    $_SESSION["username"] = $user["username"];
    header("Location: admin.php");
    exit;
} else {
    header("Location: index.php?error=1");
    exit;
}