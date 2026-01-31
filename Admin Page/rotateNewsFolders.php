<?php
session_start();
if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true) {
    http_response_code(403); // Interdit
    echo json_encode(['error' => 'Accès refusé']);
    exit;
}
ini_set('display_errors', 1);
error_reporting(E_ALL);

function rrmdir($dir) {
    if (!is_dir($dir)) return;
    foreach (array_diff(scandir($dir), ['.', '..']) as $file) {
        $path = $dir . DIRECTORY_SEPARATOR . $file;
        is_dir($path) ? rrmdir($path) : unlink($path);
    }
}

function copyDir($src, $dst) {
    if (!is_dir($src)) return;
    if (!is_dir($dst)) mkdir($dst, 0755, true);

    foreach (glob($src . DIRECTORY_SEPARATOR . "*") as $file) {
        copy($file, $dst . DIRECTORY_SEPARATOR . basename($file));
    }
}

// 🔥 NORMALISATION CRITIQUE
$baseDir = realpath(__DIR__ . "/uploads");
if (!$baseDir) {
    die("uploads introuvable");
}
$baseDir = rtrim($baseDir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;

// 1️⃣ news3
if (is_dir($baseDir . "news3")) {
    rrmdir($baseDir . "news3");
    rmdir($baseDir . "news3");
}

// 2️⃣ news2 → news3
if (is_dir($baseDir . "news2")) {
    copyDir($baseDir . "news2", $baseDir . "news3");
    rrmdir($baseDir . "news2");
    rmdir($baseDir . "news2");
}

// 3️⃣ news1 → news2
if (is_dir($baseDir . "news1")) {
    copyDir($baseDir . "news1", $baseDir . "news2");
    rrmdir($baseDir . "news1");
    rmdir($baseDir . "news1");
}

// 4️⃣ newsTemp → news1
if (is_dir($baseDir . "newsTemp")) {
    copyDir($baseDir . "newsTemp", $baseDir . "news1");
    rrmdir($baseDir . "newsTemp");
    rmdir($baseDir . "newsTemp");
}

// 5️⃣ recrée newsTemp
mkdir($baseDir . "newsTemp", 0755, true);

echo "Rotation OK";
