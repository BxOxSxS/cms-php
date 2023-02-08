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
            Wybierz plik do wgrania na serwer: 
        </label>
        <input type="file" name="uploadFile" id="uploadfileinput">
        <input type="submit" value="Wyślij plik" name="submit">
    </form>
    <?php
        if(isset($_POST['submit'])) {
            $filename = $_FILES['uploadFile']['name'];
            $targetDir = "img/";
            $targetExtension = pathinfo($filename, PATHINFO_EXTENSION);
            $targetExtension = strtolower($targetExtension);


            $targetFile = $filename . hrtime(true);
            $targetFile = hash("sha256", $targetFile) . $targetExtension;

            $targetUrl = $targetDir . $targetFile . "." . $targetExtension;

            if(file_exists($targetUrl)) {
                die("BŁĄD: Plik o tej nazwie już istnieje");
            }
            move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $targetUrl);
        }
    ?>
</body>
</html>