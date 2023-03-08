<?php
require("./../src/config.php");

use Steampixel\Route;

Route::add('/', function() {
    global $twig;
    $twig->display("index.html");
});

Route::add('/upload', function() {
    global $twig;
    $twig->display("upload.html");
});

Route::run('/bsadowski/pub');
?>