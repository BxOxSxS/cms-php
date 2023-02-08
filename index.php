<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="uploadfileinput">
            Wybierz obraz do wgrania na serwer: 
        </label>
        <input type="file" name="uploadFile" id="uploadfileinput">
        <input type="submit" value="Wyślij obraz" name="submit">
    </form>
    <?php
        if(isset($_POST['submit'])) {
            $tmpFileUrl = $_FILES["uploadFile"]["tmp_name"];
            $imageInfo = getimagesize($tmpFileUrl);
            if (!is_array($imageInfo)) {
                die("BŁĄD: Nieprawidłowy format obrazu");
            }

            $imgString = file_get_contents($tmpFileUrl);
            $gdImage = imagecreatefromstring($imgString);


            $filename = $_FILES['uploadFile']['name'];
            $targetDir = "img/";
            $targetExtension = pathinfo($filename, PATHINFO_EXTENSION);
            $targetExtension = strtolower($targetExtension);


            $targetFile = $filename . hrtime(true);
            $targetFile = hash("sha256", $targetFile) . $targetExtension;

            $targetUrl = $targetDir . $targetFile . ".webp";

            if(file_exists($targetUrl)) {
                die("BŁĄD: Plik o tej nazwie już istnieje");
            }
            // move_uploaded_file($tmpFileUrl, $targetUrl);
            imagewebp($gdImage, $targetUrl);
        }
    ?>
</body>
</html>