<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/NewsStyle.css">
</head>
<body>
	<?php include_once __DIR__ . "/../app/includes/header.php"; ?>
    <div id="news">
        <h1 id="newsTitle"></h1>
        <div id="NewsContainer"></div>
        <div id="newsSlider"></div>
    </div>
    <script src="assets/js/scriptForNews.js"></script>
    <script src="assets/js/main.js"></script>
</body>
<?php include_once __DIR__ . '/../app/includes/footer.php'; ?>
</html>