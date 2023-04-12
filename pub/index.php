<?php
require("./../src/config.php");
session_start();

use Steampixel\Route;

Route::add('/', function() {
    global $twig;
    
    $posts = Post::getPage();
    $t = array("posts" => $posts);
    if(isset($_SESSION['user'])) {
        $t['user'] = $_SESSION['user'];
    }
    
    $twig->display("index.html", $t);
});

Route::add('/upload', function() {
    global $twig;

    if(User::isAuth()) {
        $t['user'] = $_SESSION['user'];
        $twig->display("upload.html", $t);
    } else {
        http_response_code(403);
    }
});

Route::add('/upload', function() {
    global $twig;

    $tempFileName = $_FILES['uploadedFile']['tmp_name'];
    $title = $_POST['title'];
    Post::upload($tempFileName, $title, $_POST['userId']);

    // $twig->display("index.html");
    header('Location: /bsadowski/pub');
    die();
}, 'post');

Route::add('/register', function() {
    global $twig;
    $twigData = array("pageTitle" => "Zarejestruj użytkownika");
    $twig->display("register.html", $twigData);
});

Route::add('/register', function(){
    global $twig;
    if(isset($_POST['submit'])) {
        User::register($_POST['email'], $_POST['password']);
        header("Location: /bsadowski/pub");
    }
}, 'post');

Route::add('/login', function(){
    global $twig;
    $twigData = array("pageTitle" => "Zaloguj użytkownika");
    $twig->display("login.html", $twigData);
});

Route::add('/login', function() {
    global $twig;
    if(isset($_POST['submit'])) {
        if (User::login($_POST['email'], $_POST['password'])) {
            header("Location: /bsadowski/pub");
        } else {
            $t = array("message" => "Nieprawidłowy użytkownik lub hasło");
            $twig->display("login.html", $t);
        }
    }

}, 'post');

Route::add('/admin', function() {
    global $twig;
    if(User::isAuth()) {
        $t = array( "postList" => Post::getPage(1, 100));
        $twig->display("admin.html", $t);

    } else {
        http_response_code(403);
    }
});

Route::add('/admin/remove/([0-9]*)', function($id) {
    if(User::isAuth()) {
        Post::remove($id);
        header("Location: /bsadowski/pub/admin");
    } else {
        http_response_code(403);
    }
});

Route::add('/like/([0-9]*)', function($post_id) {
    if(!User::isAuth()) {
        http_response_code(403);
    }
    $user_id = $_SESSION['user']->getId();
    $like = new Likes($post_id, $user_id, 1);
    header("Location: /bsadowski/pub");
});

Route::add('/dislike/([0-9]*)', function($post_id) {
    if(!User::isAuth()) {
        http_response_code(403);
    }
    $user_id = $_SESSION['user']->getId();
    $like = new Likes($post_id, $user_id, -1);
    header("Location: /bsadowski/pub");
});

Route::run('/bsadowski/pub');
?>