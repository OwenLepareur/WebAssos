<?php
try {
    $pdo = new PDO(
        "mysql:host=sql208.yzz.me;dbname=yzzme_40864960_admins;charset=utf8mb4",
        "yzzme_40864960",
        "dakota01",
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die("Erreur connexion BDD : " . $e->getMessage());
}