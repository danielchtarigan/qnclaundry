<?php

class LinenGramasi {
    private $table = 'bs_linen_gramasi';
    private $conn;

    public function __construct()
    {
        $this->conn = new Database;
    }

    public function getItems($id)
    {
        $query = "SELECT * FROM $this->table WHERE bs_adjustment_price_id = :id";
        $this->conn->query($query);
        $this->conn->bind('id', $id);
        return $this->conn->all();
    }
}