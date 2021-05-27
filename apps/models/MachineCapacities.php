<?php 

class MachineCapacities {
    private $table = 'bs_machine_capacities';
    private $conn;

    public function __construct()
    {
        $this->conn = new Database;
    }

    public function getCapacity($workshop)
    {
        $query = "SELECT linen FROM $this->table WHERE workshop_id = :workshop";
        $this->conn->query($query);
        $this->conn->bind('workshop', $workshop);
        return $this->conn->single();
    }

    public function insert($workshop, $user, $linen)
    {
        $query = "INSERT INTO $this->table (linen, workshop_id, created_by, updated_by) VALUES (:linen, :workshop, :created, :updated)";
        $this->conn->query($query);
        $this->conn->bind('linen', $linen);
        $this->conn->bind('workshop', $workshop);
        $this->conn->bind('created', $user);
        $this->conn->bind('updated', $user);
        $this->conn->execute();
        return $this->conn->rowCount();
    }

    public function update($workshop, $user, $linen)
    {
        $query = "UPDATE $this->table SET linen = :linen, updated_by = :updated WHERE workshop_id = :workshop";
        $this->conn->query($query);
        $this->conn->bind('linen', $linen);
        $this->conn->bind('workshop', $workshop);
        $this->conn->bind('updated', $user);
        $this->conn->execute();
        return $this->conn->rowCount();
    }
}