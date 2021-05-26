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
        $query = "SELECT capacity FROM $this->table WHERE workshop_id = :workshop";
        $this->conn->query($query);
        $this->conn->bind('workshop', $workshop);
        return $this->conn->single();
    }
}