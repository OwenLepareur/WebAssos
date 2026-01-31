<?php
session_start();
if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true) {
    http_response_code(403); // Interdit
    echo json_encode(['error' => 'Accès refusé']);
    exit;
}
require "db.php";

$user = $pdo->query("SELECT * FROM user WHERE username='Coulapic'")->fetch();
var_dump($user);
var_dump(password_verify("dakota*", $user['Password']));