<?php
session_start();
if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true) {
    http_response_code(403); // Interdit
    echo json_encode(['error' => 'Accès refusé']);
    exit;
}
echo password_hash("dakota*", PASSWORD_DEFAULT);