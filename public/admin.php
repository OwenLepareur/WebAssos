<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/Dashboard.css">
    <title>Document</title>
</head>
<body>
    <?php
    session_start();
    if (!isset($_SESSION["admin"])) {
        header("Location: index.php");
        exit;
    }
    ?>
	<?php include_once __DIR__ . "/../app/includes/header.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div id = "Analytics">
        <canvas id="visitsChart" width="80vh"></canvas>
    </div>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/AdminHomePage.js"></script>
</body>
<?php include_once __DIR__ . '/../app/includes/footer.php'; ?>
</html>