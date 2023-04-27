<?php
class User {
    //id użytkownika w bazie danych
    private int $id;
    //login / email użytkownika w bazie danych
    private string $firstname;
    private string $lastname;
    private string $email;
    private string $gender;
    private string $bio;

    //konstruktor
    public function __construct(int $id, string $email, string $firstname, string $lastname, string $gender, string $bio) {
        $this->id = $id;
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->gender = $gender;
        $this->bio = $bio;

    }

    //gettery
    public function getId() : int {
        return $this->id;
    }
    public function getName() : string {
        return $this->firstname . " " . $this->lastname;
    }

    public function getBio() : string {
        return $this->bio;
    }

    public function getEmail() : string {
        return $this->email;
    }

    public function getGender() : string {
        return $this->gender;
    }

    //pobieranie nazwy użytkownika według jego id - potrzebne do wyświetlania autorów postów
    public static function getNameById(int $userId) : string {
        global $db;
        $queryFirst = $db->prepare("SELECT first_name FROM users_firstname WHERE id = ? LIMIT 1");
        $queryFirst->bind_param('i', $userId);
        $queryFirst->execute();
        $resultFirst = $queryFirst->get_result();
        $rowFirst = $resultFirst->fetch_assoc();

        $queryLast = $db->prepare("SELECT last_name FROM users_lastname WHERE id = ? LIMIT 1");
        $queryLast->bind_param('i', $userId);
        $queryLast->execute();
        $resultLast = $queryLast->get_result();
        $rowLast = $resultLast->fetch_assoc();

        return $rowFirst['first_name'] . " " . $rowLast['last_name'];
    }

    public static function getUserById(int $userId) : User {
        global $db;
        $q = $db->prepare("SELECT first_name FROM users_firstname WHERE id = ? LIMIT 1");
        $q->bind_param('i', $userId);
        $q->execute();
        $r = $q->get_result();
        $row = $r->fetch_assoc();
        $firstname = $row['first_name'];

        $q = $db->prepare("SELECT last_name FROM users_lastname WHERE id = ? LIMIT 1");
        $q->bind_param('i', $userId);
        $q->execute();
        $r = $q->get_result();
        $row = $r->fetch_assoc();
        $lastname = $row['last_name'];

        $q = $db->prepare("SELECT email FROM users_email WHERE id = ? LIMIT 1");
        $q->bind_param('i', $userId);
        $q->execute();
        $r = $q->get_result();
        $row = $r->fetch_assoc();
        $email = $row['email'];

        $q = $db->prepare("SELECT bio FROM users_bio WHERE id = ? LIMIT 1");
        $q->bind_param('i', $userId);
        $q->execute();
        $r = $q->get_result();
        $row = $r->fetch_assoc();
        $bio = $row['bio'];

        $q = $db->prepare("SELECT gender FROM users_gender WHERE id = ? LIMIT 1");
        $q->bind_param('i', $userId);
        $q->execute();
        $r = $q->get_result();
        $row = $r->fetch_assoc();
        $gender = $row['gender'];

        // $a = array();

        // $a['firstname'] = $firstname;
        // $a['lastname'] = $lastname;
        // $a['email'] = $email;
        // $a['bio'] = $bio;
        // $a['gender'] = $gender;

        $user = new User($userId, $email, $firstname, $lastname, $gender, $bio);


        return $user;
    }
    //zarejestrowanie nowego użytkownika
    // public static function register(string $email, string $password) : bool {
    //     global $db;
    //     $query = $db->prepare("INSERT INTO user VALUES (NULL, ?, ?)");
    //     $passwordHash = password_hash($password, PASSWORD_ARGON2I);
    //     $query->bind_param('ss', $email, $passwordHash);
    //     return $query->execute();
    // }
    //zalogowanie istniejącego użytkownika
    // public static function login(string $email, string $password) : bool {
    //     global $db;
    //     $query = $db->prepare("SELECT * FROM user WHERE email = ? LIMIT 1");
    //     $query->bind_param('s', $email);
    //     $query->execute();
    //     $result = $query->get_result();
    //     $row = $result->fetch_assoc();
    //     if ($result->num_rows == 0) {
    //         return false;
    //     }
    //     $passwordHash = $row['password'];
    //     //jeżeli autoryzacja się powiedzie to zapisz użytkownika jako obiekt w sesji
    //     if(password_verify($password, $passwordHash)) {
    //         //hasła są zgodne - możemy zalogować użytkownika
    //         $u = new User($row['id'], $email);
    //         $_SESSION['user'] = $u;
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    // public static function isAuth() : bool {
    //     if (isset($_SESSION['user'])) {
    //         if ($_SESSION['user'] instanceof User) {
    //             return true;
    //         }
    //     }
    //     return false;
    // }
}
?>