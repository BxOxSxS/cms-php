<?php
class Post {
    private string $title;
    private string $imageUrl;
    private string $timeStamp;

    function __construct(string $title, string $imageUrl, string $timeStamp) {
        $this->title = $title;
        $this->imageUrl = $imageUrl;
        $this->timeStamp = $timeStamp;
    }

    public function getFilename() {
        return $this->imageUrl;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getTimestamp() {
        return $this->timeStamp;
    }

    static function get(int $id) : Post {
        global $db;

        $q = $db->prepare("SELECT * FROM post WHERE id = ?");
        $q->bind_param('i', $id);
        $q->execute();
        $result = $q->get_result();
        $resultArray = $result->fetch_array();
        return new Post($resultArray['title'], $resultArray['filename'], $result['timestamp']);
    }

    static function getLast() : Post {
        global $db;
        $query = $db->prepare("SELECT * FROM post ORDER BY timestamp DESC LIMIT 1");
        $query->execute();
        $result = $query->get_result();
        $row = $result->fetch_assoc();
        $p = new Post($row['id'], $row['filename'], $row['timestamp']);
        return $p;
    }

    static function getPage(int $pageNumber = 1, int $postsPerPage = 10) : array {
        global $db;

        $q = $db->prepare("SELECT * FROM post ORDER BY timestamp DESC LIMIT ? OFFSET ?");
        $offset = ($pageNumber -1) * $postsPerPage;
        $q->bind_param('ii', $postsPerPage, $offset);
        $q->execute();
        $result = $q->get_result();
        $postArray = array();
        while($row = $result->fetch_array()) {
            $post = new Post($row['title'], $row['filename'], $row['timestamp']);
            array_push($postArray, $post);
        }
        return $postArray;
    }

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