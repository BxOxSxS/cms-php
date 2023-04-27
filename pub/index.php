<?php
require("./../src/config.php");
session_start();

use Steampixel\Route;

Route::add('/', function() {
    global $twig;
    
    $posts = Post::getPage();
    $t = array("posts" => $posts);
    // if(isset($_SESSION['user'])) {
    //     $t['user'] = $_SESSION['user'];
    // }
    
    $twig->display("index.html", $t);
});

Route::add('/user/([0-9]*)', function($user_id) {
    global $twig;

    $user = User::getUserById($user_id);

    $posts = Post::getUserPosts($user_id);

    $t = array("user" => $user, "posts" => $posts);

    $twig->display("user.html", $t);
});

Route::run('/fb/pub');
?>