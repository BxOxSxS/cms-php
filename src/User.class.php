<?php
class User {
    //id użytkownika w bazie danych
    private int $id;
    //login / email użytkownika w bazie danych
    private string $email;

    //konstruktor
    public function __construct(int $id, string $email) {
        $this->id = $id;
        $this->email = $email;

    }

    //gettery
    public function getId() : int {
        return $this->id;
    }
    public function getName() : string {
        return $this->email;
    }
    //pobieranie nazwy użytkownika według jego id - potrzebne do wyświetlania autorów postów
    public static function getNameById(int $userId) : string {
        global $db;
        $query = $db->prepare("SELECT email FROM user WHERE id = ? LIMIT 1");
        $query->bind_param('i', $userId);
        $query->execute();
        $result = $query->get_result();
        $row = $result->fetch_assoc();
        return $row['email'];
    }
    //zarejestrowanie nowego użytkownika
    public static function register(string $email, string $password) : bool {
        global $db;
        $query = $db->prepare("INSERT INTO user VALUES (NULL, ?, ?)");
        $passwordHash = password_hash($password, PASSWORD_ARGON2I);
        $query->bind_param('ss', $email, $passwordHash);
        return $query->execute();
    }
    //zalogowanie istniejącego użytkownika
    public static function login(string $email, string $password) : bool {
        global $db;
        $query = $db->prepare("SELECT * FROM user WHERE email = ? LIMIT 1");
        $query->bind_param('s', $email);
        $query->execute();
        $result = $query->get_result();
        $row = $result->fetch_assoc();
        if ($result->num_rows == 0) {
            return false;
        }
        $passwordHash = $row['password'];
        //jeżeli autoryzacja się powiedzie to zapisz użytkownika jako obiekt w sesji
        if(password_verify($password, $passwordHash)) {
            //hasła są zgodne - możemy zalogować użytkownika
            $u = new User($row['id'], $email);
            $_SESSION['user'] = $u;
            return true;
        } else {
            return false;
        }
    }

    public static function isAuth() : bool {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] instanceof User) {
                return true;
            }
        }
        return false;
    }
}
?>