<?php
class Post {
    static function upload(string $tempFilename, string $title = "") {
        $targetDir = "img/";

        $imageInfo = getimagesize($tempFilename);
            
        if (!is_array($imageInfo)) {
            die("BŁĄD: Nieprawidłowy format obrazu");
        }
        $randomSeed = rand(10000,99999) . hrtime(true);
        $hash = hash("sha256", $randomSeed);

        $targetFileName = $targetDir . $hash . ".webp";
        if(file_exists($targetFileName)) {
            die("BŁĄD: Plik o tej nazwie już istnieje");
        }

        $imageString = file_get_contents($tempFilename);

        $gdImage = @imagecreatefromstring($imageString);

        imagewebp($gdImage, $targetFileName);

        global $db;

        $q = "INSERT post (id, timestamp, filename, ip, title) VALUES (NULL, ?, ?, ?, ?)";
        $preparedQ = $db->prepare($q);

        $date = date('Y-m-d H:i:s');
        $preparedQ->bind_param('ssss', $date, $targetFileName, $_SERVER['REMOTE_ADDR'], $title);
        $result = $preparedQ->execute();
        if (!$result) {
            die("Błąd bazy danych");
        }
    }
}

?>