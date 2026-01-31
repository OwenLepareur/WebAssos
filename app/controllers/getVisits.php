<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
try {
    $pdo = new PDO(
        "mysql:host=sql208.yzz.me;dbname=yzzme_40864960_admins;charset=utf8mb4",
        "yzzme_40864960",
        "dakota01",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
    );

    // Récupère toutes les visites des 30 derniers jours
    $stmt = $pdo->prepare("
        SELECT day, visites
        FROM DailyVisits
        WHERE day >= CURDATE() - INTERVAL 30 DAY
        ORDER BY day ASC
    ");
    $stmt->execute();
    $visits = $stmt->fetchAll();

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($visits);

} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['error' => true, 'message' => $e->getMessage()]);
}
?>