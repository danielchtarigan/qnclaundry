<?php 

class Driver {
    private $table = 'user_driver';
    private $conn;

    public function __construct()
    {
        $this->conn = new Database;
    }

    public function getDriverLogin($branchId) 
    {
        $query = "SELECT id, name, lokasiform, lokasi, keterangan FROM $this->table WHERE branch_id = :branch_id AND status = true";
        $this->conn->query($query);
        $this->conn->bind('branch_id', $branchId);
        return $this->conn->all();
    }

    public function update($driverId)
    {
        $query = "UPDATE $this->table SET status = '0', lokasiform = '', lokasi = '', keterangan = '' WHERE id = :driver_id";
        $this->conn->query($query);

        $this->conn->bind('driver_id', $driverId);
        $this->conn->execute();

        return $this->conn->rowCount(); 
    }
}