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
        $query = "SELECT * FROM $this->table WHERE no_nota = :nota";
        $this->conn->query($query);
        $this->conn->bind('nota', $request['nota']);
        return $this->conn->resultAll();
    }
    
}