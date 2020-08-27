<?php 

class Authorize {
    private $table = 'user';
    private $response = 0;
    private $conn;

    public function __construct()
    {
        $this->conn = new Database;
    }

    public static function accessGranted($token)
    {
        return (new self)->tokenChecked($token);
    }

    public function tokenChecked($token)
    {
        $password = "qnclaundrycabang";
        if (password_verify($password, $token)) {
            $this->response = 1;
        }
        else {
            $this->response = 0;
        }

        return $this->response;
    }


}

