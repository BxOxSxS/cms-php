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

Route::add('/upload', function() {
    global $twig;

    $tempFileName = $_FILES['uploadFile']['tmp_name'];
    $title = $_POST['title'];
    Post::upload($tempFileName, $title);

    $twig->display("index.html");
}, 'post');

Route::run('/bsadowski/pub');
?>