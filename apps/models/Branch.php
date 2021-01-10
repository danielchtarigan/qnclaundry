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

    public function getBranches()
    {
        $query = "SELECT id, cabang AS branch, city, active AS status FROM $this->table";
        $this->conn->query($query);
        return $this->conn->all();
    }

    public function getBranchOutlet()
    {
        $query = "SELECT a.id AS branch_id, cabang AS branch, city, b.id_outlet AS outlet_id, b.nama_outlet AS outlet FROM $this->table a RIGHT JOIN outlet b ON a.cabang = b.Kota 
                    WHERE a.active = true AND b.active = true";
        $this->conn->query($query);
        return $this->conn->all();
    }

    public function insertBranch($data)
    {
        $query = "INSERT INTO $this->table (cabang, city, active) 
                    VALUES (:name, :city, :active)";
        $this->conn->query($query);
        $this->conn->bind('name', $data->name);
        $this->conn->bind('city', $data->city);
        $this->conn->bind('active', $data->active);

        $this->conn->execute();
        return $this->conn->rowCount();
    }

    public function updateBranch($data, $branchId)
    {
        $query = "UPDATE $this->table SET cabang = :name, city = :city, active = :active WHERE id = :branchId";
        $this->conn->query($query);
        $this->conn->bind('name', $data->name);
        $this->conn->bind('city', $data->city);
        $this->conn->bind('active', $data->active);
        $this->conn->bind('branchId', $branchId);

        $this->conn->execute();
        return $this->conn->rowCount();
    }
}