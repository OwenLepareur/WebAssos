<?php
session_start();

if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true) {
    exit("Accès refusé");
}

$targetDir = __DIR__ . '/../../public/uploads/newsTemp/';
$allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

if (isset($_FILES['fileToUpload'])) {
    $file = $_FILES['fileToUpload'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed)) {
        echo "Format non supporté";
        exit;
    }

    if ($file['size'] > 2097152) {
        echo "Image trop lourde (max 2Mo)";
        exit;
    }

    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    array_map('unlink', glob($targetDir . "resumeImg.*"));

    $newName = "resumeImg." . $ext;
    
    if (move_uploaded_file($file['tmp_name'], $targetDir . $newName)) {
        echo "uploads/newsTemp/" . $newName . "?t=" . time();
    } else {
        echo "Erreur serveur";
    }
}
?>