<?php
session_start();

if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true) {
    exit("Accès refusé");
}

$targetDir = "../../public/uploads/newsTemp/";
if(!is_dir($targetDir)) mkdir($targetDir, 0755, true);

if (isset($_FILES['fileToUpload'])) {
    $file = $_FILES['fileToUpload'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
if (file_exists("../../public/uploads/newsTemp/resumeImg.". pathinfo($fileName, PATHINFO_EXTENSION))) {
    unlink("../../public/uploads/newsTemp/resumeImg.". pathinfo($fileName, PATHINFO_EXTENSION));
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