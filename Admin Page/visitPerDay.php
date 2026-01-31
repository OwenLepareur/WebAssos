<?php
try {
    $pdo = new PDO(
        "mysql:host=sql208.yzz.me;dbname=yzzme_40864960_admins;charset=utf8mb4",
        "yzzme_40864960",
        "dakota01",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
    );

    // Crée la table si elle n'existe pas
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS DailyVisits (
            day DATE PRIMARY KEY,
            visites INT NOT NULL DEFAULT 0
        )
    ");

    // Jour actuel
    $today = date('Y-m-d');

    // Ajoute 1 visite pour aujourd'hui
    $stmt = $pdo->prepare("
        INSERT INTO DailyVisits(day, visites)
        VALUES (:today, 1)
        ON DUPLICATE KEY UPDATE visites = visites + 1
    ");
    $stmt->execute(['today' => $today]);

    // Supprime les jours de plus d'un mois
    $pdo->exec("DELETE FROM DailyVisits WHERE day < CURDATE() - INTERVAL 30 DAY");

    echo json_encode(['success' => true]);

} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['error' => true, 'message' => $e->getMessage()]);
}
?>