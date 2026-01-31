<?php
$dir = "../../public/uploads/newsTemp";
$id = $_POST['valeur'] ?? null;

if (!$id) {
    echo "";
    exit;
}

$extensions = ["jpg", "jpeg", "png", "gif", "webp"];
$found = "";

foreach ($extensions as $ext) {
    $path = $dir . $id . "." . $ext;
    if (file_exists($path)) {
        $found = $path;
        break;
    }
}

echo $found;
?>