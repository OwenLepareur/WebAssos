<?php
$dir = "uploads/newsTemp";
$files = glob($dir . "*.{jpg,jpeg,png,gif,webp}", GLOB_BRACE);

if (!empty($files)) {
    echo $files[0]; // retourne le chemin de la première image
} else {
    echo ""; // pas d'image
}
?>
