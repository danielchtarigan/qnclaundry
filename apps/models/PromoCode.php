<?php 

class PromoCode {
    private $table = "telemarketer_kode_promo";
    private $conn;

    public function __construct()
    {
        $this->conn = new Database;
    }

    public function getCode($code)
    {
        $query = "SELECT * FROM $this->table WHERE kode_promo = :code AND berlaku_sampai <= CURDATE()";
        $this->conn->query($query);
        $this->conn->bind('code', $code);
        return $this->conn->single();
    }
}