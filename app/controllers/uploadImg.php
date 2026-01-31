<?php
session_start();
if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true) {
    http_response_code(403); // Interdit
    echo json_encode(['error' => 'Accès refusé']);
    exit;
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$targetDir = "uploads/newsTemp/";
if(!is_dir($targetDir) && !mkdir($targetDir, 0755, true)) {
    http_response_code(500);
    exit("Impossible de créer le dossier");
}

$fileName = $_FILES['fileToUpload']['name'] ?? null;
$tmpName  = $_FILES['fileToUpload']['tmp_name'] ?? null;
$id       = $_POST['valeur'] ?? null;

if(!$fileName || !$tmpName || !$id) {
    http_response_code(400);
    exit("Paramètre manquant");
}

$ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
$allowed = ['jpg','jpeg','png','webp'];
if(!in_array($ext, $allowed)) {
    http_response_code(400);
    exit("Type de fichier interdit");
}

// Nouveau nom
$newName = $id . "." . $ext;
$targetFile = $targetDir . $newName;

if(!move_uploaded_file($tmpName, $targetFile)) {
    http_response_code(500);
    exit("Erreur lors de l'upload");
}

echo $targetFile;