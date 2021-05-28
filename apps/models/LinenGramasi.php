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

    public function getItemByPriceId($id)
    {
        $query = "SELECT * FROM $this->table WHERE bs_adjustment_price_id = :id";
        $this->conn->query($query);
        $this->conn->bind('id', $id);
        return $this->conn->single();
    }

    public function insert($adjustmenId, $gramasi)
    {
        $query = "INSERT INTO $this->table (bs_adjustment_price_id, gramasi) VALUES (:adjustmentId, :gramasi)";
        $this->conn->query($query);
        $this->conn->bind('adjustmentId', $adjustmenId);
        $this->conn->bind('gramasi', $gramasi);
        $this->conn->execute();

        return $this->conn->rowCount();
    }

    public function update($adjustmenId, $gramasi)
    {
        $query = "UPDATE $this->table SET gramasi = :gramasi WHERE bs_adjustment_price_id = :adjustmentId";
        $this->conn->query($query);
        $this->conn->bind('adjustmentId', $adjustmenId);
        $this->conn->bind('gramasi', $gramasi);
        $this->conn->execute();

        return $this->conn->rowCount();
    }
}