<?php
session_start();
if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true) {
    http_response_code(403); // Interdit
    echo json_encode(['error' => 'Accès refusé']);
    exit;
}
// Afficher les erreurs pour le debug (à enlever en prod)
ini_set('display_errors', 1);
error_reporting(E_ALL);

try {
    // Connexion à la BDD
    $pdo = new PDO(
        "mysql:host=sql208.yzz.me;dbname=yzzme_40864960_admins;charset=utf8mb4",
        "yzzme_40864960",
        "dakota01",
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );

    // Fonction pour vérifier si une table existe
    function tableExists(PDO $pdo, $tableName) {
        $stmt = $pdo->prepare("SHOW TABLES LIKE ?");
        $stmt->execute([$tableName]);
        return $stmt->rowCount() > 0;
    }

    // 1️⃣ Supprimer News3 si elle existe
    if (tableExists($pdo, "News3")) {
        $pdo->exec("DROP TABLE News3");
        echo "News3 supprimée.\n";
    }

    // 2️⃣ Renommer News2 → News3 si News2 existe
    if (tableExists($pdo, "News2")) {
        $pdo->exec("RENAME TABLE News2 TO News3");
        echo "News2 renommée en News3.\n";
    }

    // 3️⃣ Renommer News1 → News2 si News1 existe
    if (tableExists($pdo, "News1")) {
        $pdo->exec("RENAME TABLE News1 TO News2");
        echo "News1 renommée en News2.\n";
    }

    $pdo->exec("
        CREATE TABLE News1 (
            id INT AUTO_INCREMENT PRIMARY KEY,
            type TEXT NOT NULL,
            content TEXT NOT NULL,
            imgpath TEXT
        )
    ");

    echo "Rotation des tables terminée.";

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}