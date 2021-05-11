<?php 

class NewLangganan {
    private $table = 'bs_langganan';
    private $conn;
    private $count = 0;

    public function __construct()
    {
        $this->conn = new Database;
    }

    public function cekLanggananCustomer($id, $branch)
    {
        $outlet = 'outlet';
        $query = "SELECT a.kiloan, a.potongan, a.valid_date, b.Kota AS branch FROM $this->table A LEFT JOIN $outlet B ON a.outlet_id = b.id_outlet WHERE a.customer_id = :customer_id AND Kota = :branch";
        $this->conn->query($query);
        $this->conn->bind('customer_id', $id);
        $this->conn->bind('branch', $branch);
        return $this->conn->all();
    }

}