<?php
session_start();
if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true) {
    http_response_code(403); // Interdit
    echo json_encode(['error' => 'Accès refusé']);
    exit;
}
session_start();
if (!isset($_SESSION['admin'])) {
    http_response_code(403);
    exit("Accès refusé");
}

$dir = 'uploads/newsTemp';

if (is_dir($dir)) {
    $files = glob($dir . '*');
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file);
        }
    }
}
?>