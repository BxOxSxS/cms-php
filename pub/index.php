<?php
require('./../src/config.php');

if(isset($_POST['submit'])) {
    Post::upload($_FILES["uploadFile"]["tmp_name"], $_POST['title']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="title">Tytuł: </label>
        <input type="text" id="titleInput" name="title"><br>
        <label for="uploadfileinput">
            Wybierz obraz do wgrania na serwer: 
        </label>
        <input type="file" name="uploadFile" id="uploadfileinput">
        <br>
        <input type="submit" value="Wyślij obraz" name="submit">
    </form>
</body>
</html>