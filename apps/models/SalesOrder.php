<?php 

class SalesOrder {
    private $table = 'reception';
    private $conn;

    public function __construct()
    {
        $this->conn = new Database;
    }

    public function getOrders($request)
    {
        $query = "SELECT * FROM reception WHERE no_nota = '$request[nota]'";
        $this->conn->query($query);
        return $this->conn->resultAll();
    }
    
}