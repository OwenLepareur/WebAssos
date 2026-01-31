<?php
session_start();
if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true) {
    http_response_code(403); // Interdit
    echo json_encode(['error' => 'Accès refusé']);
    exit;
}
if(isset($_FILES['fileToUpload'])){
    $fileName = $_FILES['fileToUpload']['name'];
    $tmpName  = $_FILES['fileToUpload']['tmp_name'];
    $id = $_POST['valeur'];
    $ref = $_POST['ref'];

    $targetDir = "../../public/uploads/newsTemp/";
    if(!is_dir($targetDir)) mkdir($targetDir, 0755, true);

    // Pour éviter écrasement
    $newName = $id . $ref . "." . pathinfo($fileName, PATHINFO_EXTENSION);
    $targetFile = $targetDir . $newName;

    if(move_uploaded_file($tmpName, $targetFile)){
        echo "Fichier uploadé : <a href='$targetFile' target='_blank'>$newName</a>";
    } else {
        echo "Erreur lors de l'upload.";
    }
} else {
    echo "Aucun fichier reçu.";
}
?>
