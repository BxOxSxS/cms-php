<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="uploadfileinput">
            Wybierz obraz do wgrania na serwer: 
        </label>
        <input type="file" name="uploadFile" id="uploadfileinput">
        <br>
        <input type="submit" value="Wyślij obraz" name="submit">
    </form>
    <h1>Posty</h1>
    <?php
        $db = new mysqli("localhost", "root", "", "cms_bs");
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

            $filename = $targetFile . ".webp";

            $targetUrl = $targetDir . $filename;

            if(file_exists($targetUrl)) {
                die("BŁĄD: Plik o tej nazwie już istnieje");
            }
            // move_uploaded_file($tmpFileUrl, $targetUrl);
            imagewebp($gdImage, $targetUrl);

            $q = "INSERT post (id, timestamp, filename, ip) VALUES (NULL, ?, ?, ?)";
            $preparedQ = $db->prepare($q);

            $date = date('Y-m-d H:i:s');
            $preparedQ->bind_param('sss', $date, $filename, $_SERVER['REMOTE_ADDR']);
            $result = $preparedQ->execute();
            if (!$result) {
                die("Błąd bazy danych");
            }
        }

        $q = "SELECT * from post ORDER BY timestamp DESC";
        $preparedQ = $db->prepare($q);

        $preparedQ->execute();

        $result = $preparedQ->get_result();

        while ($row = $result->fetch_assoc()) {
            echo "<div class='post'>
                <button type='button' class='comment'>
                    💬
                </button> 
                <div class='vote'>
                    <button class='upvote' type='button'>▲</button>
                    <div class='votecounter'>69</div>
                    <button class='downvote' type='button'>▼</button>
                    
                </div>
                <div class='title'>
                    <h2>Tytuł coś tam</h2> " 
                    . $row['ip'] . " " . $row['timestamp'] . "<br>
                </div>
                
            ";
            echo "<img class='img' src='img/" . $row['filename'] . "'><br></div>";
        }
    ?>
</body>
</html>