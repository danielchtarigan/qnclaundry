<?php 

class Authorize {
    private $table = 'user';
    private $conn;

    public function __construct()
    {
        $this->conn = new Database;
    }

    public static function accessGranted($userId)
    {
        return (new self)->getUser($userId);
    }

    public function getUser($userId)
    {
        $query = "SELECT * FROM $this->table WHERE user_id = :id AND aktif = 'Ya'";
        $this->conn->query($query);
        $this->conn->bind('id', $userId);
        $this->conn->execute();

        return $this->conn->rowCount();
    }


}

