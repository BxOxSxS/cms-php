<?php
require("./../src/config.php");

use Steampixel\Route;

Route::add('/', function() {
    echo "działa";
});

Route::run('/bsadowski/pub');
?>