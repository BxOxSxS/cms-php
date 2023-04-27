<?php
require("./../vendor/autoload.php");
require('./../src/Post.class.php');
require('./../src/User.class.php');
require('./../src/Likes.class.php');

$db = new mysqli("localhost", "root", "", "fb");

$loader = new Twig\Loader\FilesystemLoader('./../src/templates');
$twig = new Twig\Environment($loader);

?>