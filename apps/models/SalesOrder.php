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
        return $this->conn->single();
    }

    public function OrderByDate($request)
    {
        $query = "SELECT * FROM $this->table WHERE nama_outlet = :outlet AND DATE(tgl_input) BETWEEN :start_at AND :end_at ORDER BY tgl_input ASC";
        $this->conn->query($query);
        $this->conn->bind('outlet', $request['outlet']);
        $this->conn->bind('start_at', $request['start_at']);
        $this->conn->bind('end_at', $request['end_at']);
        return $this->conn->all();
    }
    
}