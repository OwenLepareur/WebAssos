<?php
session_start();
if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true) {
    http_response_code(403); // Interdit
    echo json_encode(['error' => 'Accès refusé']);
    exit;
}
try {
    $pdo = new PDO(
        "mysql:host=sql208.yzz.me;dbname=yzzme_40864960_admins;charset=utf8mb4",
        "yzzme_40864960",
        "dakota01",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    $type    = $_POST['type'] ?? null;
    $content = $_POST['content'] ?? null;
    $imgpath = $_POST['imgpath'] ?? null;

    if (!$type) {
        http_response_code(400);
        exit("Type manquant");
    }

    $stmt = $pdo->prepare("
        INSERT INTO News1 (type, content, imgpath)
        VALUES (?, ?, ?)
    ");

    $stmt->execute([$type, $content, $imgpath]);

    echo "OK";

} catch (PDOException $e) {
    http_response_code(500);
    echo $e->getMessage();
}
