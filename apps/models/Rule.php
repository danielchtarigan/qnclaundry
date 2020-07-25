<?php
class Rule {
    private $table = 'laundry_rules';
    private $conn;

    public function __construct()
    {
        $this->conn = new Database;
    }

    public function getAllrules()
    {
        $this->conn->query("SELECT * FROM ". $this->table.' WHERE id <> 1');
        return $this->conn->resultAll();
    }

    public function getRuleById($id)
    {
        $this->conn->query('SELECT * FROM '.$this->table.' WHERE id=:id');
        $this->conn->bind('id', $id);
        return $this->conn->single();
    }
}