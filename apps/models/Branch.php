<?php 

class Branch {
    private $table = "cabang";
    private $conn;

    public function __construct()
    {
        $this->conn = new Database;
    }

    public function getBranchId($branch)
    {
        $this->conn->query("SELECT id FROM $this->table WHERE cabang = :branch");
        $this->conn->bind('branch', $branch);
        return $this->conn->single();
    }
}