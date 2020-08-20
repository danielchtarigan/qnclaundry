<?php 

class Langganan {
    private $table = 'langganan';
    private $conn;

    public function __construct()
    {
        $this->conn = new Database;
    }

    public function langgananByOutlet($outlet, $request) {
        $customer = 'customer';
        $query = "SELECT b.nama_customer AS name, b.no_telp AS telp, a.kilo_cks AS kiloan, a.potongan AS potongan, a.tgl_join AS join_at, a.tgl_expire AS end_at 
                    FROM $this->table AS a LEFT JOIN $customer AS b ON a.id_customer = b.id 
                    WHERE b.outlet = :outlet AND a.tgl_join BETWEEN :start_at AND :end_at";
        $this->conn->query($query);
        $this->conn->bind('outlet', $outlet);
        $this->conn->bind('start_at', $request['start_at']);
        $this->conn->bind('end_at', $request['end_at']);
        return $this->conn->all();
    }

    public function show($id)
    {
        $query = "SELECT * FROM $this->table WHERE id = :id";
        $this->conn->query($query);
        $this->conn->bind('id', $id);
        return $this->conn->single();
    }
}