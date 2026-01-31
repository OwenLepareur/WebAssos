<?php
$dir = "../../public/uploads/newsTemp";
$id = $_POST['valeur'] ?? null;
$ref = $_POST['ref'] ?? null;

if (!$id || !$ref) {
    echo "";
    exit;
}

$extensions = ["jpg", "jpeg", "png", "gif", "webp"];
$found = "";

foreach ($extensions as $ext) {
    $path = $dir . $id . $ref . "." . $ext;
    if (file_exists($path)) {
        $found = $path;
        break;
    }
}

echo $found;
?>