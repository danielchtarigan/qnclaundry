<?php 

class Authorize {
    private $table = 'users';
    private $conn;

    public function __construct()
    {
        $this->conn = new Database;
    }

    public static function accessGranted()
    {
        return self::getUser($userId);
    }

    public function getUser($userId)
    {
        $query = "SELECT * FROM users WHERE id = :id AND aktif = 'Ya'";
        $this->conn->query($query);
        $this->conn->bind('id', $userId);

        return $this->conn->execute();
    }

    public static function message()
    {

    }
}

